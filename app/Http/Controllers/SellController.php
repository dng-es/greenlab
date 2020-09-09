<?php

namespace App\Http\Controllers;

use App\Credit;
use App\Member;
use App\Product;
use App\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Member $member)
    {
        if ($member->active == 0) {
            return abort(403, __('app.Members_inactive_alert'));
        } else {
            $products = Product::select('products.*', 'categories.name AS category', 'categories.bar AS bar', 'categories.color AS color')
                        ->leftJoin('categories', 'categories.id', 'products.category_id')
                        ->where('menu', 1)
                        ->orderBy('categories.bar')
                        ->orderBy('categories.name')
                        ->orderBy('products.name')
                        ->get();

            $total_month = $member->warehouses()
                        ->leftJoin('products', 'products.id', 'warehouses.product_id')
                        ->leftJoin('categories', 'categories.id', 'products.category_id')
                        ->where('categories.bar', 0)
                        ->where('type', 'S')
                        ->whereMonth('warehouses.created_at', Carbon::now()->format('m'))
                        ->whereYear('warehouses.created_at', Carbon::now()->format('Y'))
                        ->sum('amount_real');


            return view('sells.new', ['member' => $member, 'products' => $products, 'total_month' => $total_month]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function store(Request $request, Member $member)
    {
        $total_amount = 0;
        $total_price = 0;
        foreach ($request->input() as $key => $value) :
            $amount = floatval($value);
        if ((substr($key, 0, 4) == 'prod') && $amount != 0) {
            $product_id = str_replace('prod', '', $key);
            $product = Product::findOrFail($product_id);
            $price = floatval($request->input('money'.$product_id));
            $total_price += $price;
            $total_amount += $amount;
            if (! $warehouse = Warehouse::create([
                        'user_id'     => Auth::user()->id,
                        'member_id'    => $member->id,
                        'product_id'    => $product->id,
                        'supplier_id'    => 0,
                        'price'    => $product->price,
                        'amount'    => $amount,
                        'amount_real'    => $amount,
                        'total'    => $price,
                        'type'    => 'S',
                    ])) {
                return response()->json(['error'=> __('general.ErrorMessage')]);
            }
        }
        endforeach;

        $total_month = $member->warehouses()
                    ->leftJoin('products', 'products.id', 'warehouses.product_id')
                    ->leftJoin('categories', 'categories.id', 'products.category_id')
                    ->where('categories.bar', 0)
                    ->where('type', 'S')
                    ->whereMonth('warehouses.created_at', Carbon::now()->format('m'))
                    ->whereYear('warehouses.created_at', Carbon::now()->format('Y'))
                    ->sum('amount_real');

        if ($request->input('credit') == "true") {
            Credit::create([
                'user_id' => Auth::user()->id,
                'member_id' => $member->id,
                'credit' => -$total_price,
                'notes' => '',
            ]);

            $member = Member::find($member->id);
        }

        $credit = $member->credit;

        $message = __('app.Sell_finish_ok'). '<br><b>' . __('app.Sell_total') . ': ' . $total_price . __('app.Coin') . '</b>';
        return response()->json(['success'=> $message, 'member' => $member, 'total_month' => $total_month, 'credit' => $credit]);
    }
}

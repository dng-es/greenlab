<?php

namespace App\Http\Controllers;


use App\Exports\WarehousesExport;
use App\Http\Requests\WarehouseRequest;
use App\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class WarehouseController extends Controller
{  
    public function index(Request $request, $type)
    {
        $warehouses = Warehouse::when($type == 'S', function($query){
                        return $query->select('warehouses.*', DB::raw("CONCAT(members.name,' ',members.last_name)  AS fullname"), 'products.name AS product', 'categories.name AS category', 'categories.bar AS bar')
                                ->leftJoin('members', 'members.id', 'warehouses.member_id');
                    }, function($query){
                        return $query->select('warehouses.*', 'suppliers.name AS fullname', 'products.name AS product', 'categories.name AS category', 'categories.bar AS bar')
                                ->leftJoin('suppliers', 'suppliers.id', 'warehouses.supplier_id');

                    })
            ->leftJoin('products', 'products.id', 'warehouses.product_id')
            ->leftJoin('categories', 'categories.id', 'products.category_id')
            ->where('warehouses.type', $type);

        //busquedas
        $search =  $request->input("search", '');
        //if ($search != "") $warehouses = $warehouses->where('last_name', 'like', '%'.$search.'%');


        //ordernacion del listado
        $order =  $request->input("order", 'DESC');
        $orderby =  $request->input("orderby", 'warehouses.created_at');
        

        $warehouses = $warehouses->orderBy($orderby, $order)->paginate(15);
        //dd($warehouses);

        return view('warehouses.index', ['warehouses' => $warehouses, 'search' => $search, 'orderby' => $orderby, 'order' => $order, 'type' => $type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function store(WarehouseRequest $request)
    {
        if ($warehouse = Warehouse::create([
                'user_id'     => Auth::user()->id,
                'member_id'    => 0,
                'product_id'    => $request->input('product_id'),
                'supplier_id'    => $request->input('supplier_id'),
                'price'    => $request->input('price'),
                'amount'    => $request->input('amount'),
                'amount_real'    => $request->input('amount_real'),
                'total'    => $request->input('total'),
                'type'    => 'E',
            ])){    
            $message = __('general.InsertOkMessage');
        }
        else $message =  __('general.ErrorMessage');

        return redirect()->back()->with('status', $message);
    }

    /**
     * Export data to the specified format.
     *
     * @param  $exportOption
     * @param  \Illuminate\Http\Request  $request
     * @return Document XLSX, XLS, CSV
     */
    public function export($type, $exportOption = "xlsx", Request $request)
    {
        return Excel::download(new WarehousesExport($type, $request), __('app.Warehouses'). '.'.$exportOption);
    }

}

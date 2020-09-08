<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $suppliers = Supplier::select('*')->with('warehouses');

        //busquedas
        $search =  $request->input("search", '');
        if ($search != "") {
            $suppliers = $suppliers->where('name', 'like', '%'.$search.'%');
        }

        //ordernacion del listado
        $order =  $request->input("order", 'DESC');
        $orderby =  $request->input("orderby", 'name');
        
        $suppliers = $suppliers->orderBy($orderby, $order)->paginate(15);

        return view('suppliers.index', ['suppliers' => $suppliers, 'search' => $search, 'orderby' => $orderby, 'order' => $order]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('suppliers.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function store(SupplierRequest $request)
    {
        if ($supplier = Supplier::create([
                'name'     => $request->input('name'),
                'notes'    => $request->input('notes'),
            ])) {
            $status = __('general.InsertOkMessage');
        } else {
            $status = __('general.ErrorMessage');
        }

        return redirect()->route('supplier.edit', ['supplier' => $supplier->id])->with('status', $status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $warehouses = $supplier->warehouses()
            ->select('warehouses.amount', 'warehouses.amount_real', 'warehouses.price', 'warehouses.total', 'products.name AS product', 'categories.name AS category', 'warehouses.created_at', 'categories.bar AS bar')
            ->leftJoin('products', 'products.id', 'warehouses.product_id')
            ->leftJoin('categories', 'categories.id', 'products.category_id')
            ->where('warehouses.type', 'E')
            ->orderBy('warehouses.created_at', 'DESC')
            ->paginate(10);

        return view('suppliers.edit', [
            'supplier' => $supplier,
            'warehouses' => $warehouses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Supplier $supplier, SupplierRequest $request)
    {
        $supplier->name = $request->input('name');
        $supplier->notes = $request->input('notes');
        $supplier->save();
        return redirect()->back()->with('status', __('general.UpdateOkMessage'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @param  $destino
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->back()->with('status', __('general.DeleteOkMessage'));
    }
}

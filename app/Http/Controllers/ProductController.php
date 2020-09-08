<?php

namespace App\Http\Controllers;

use App\Category;
use App\Exports\ProductsExport;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index(Request $request, $bar=0)
    {
        $products = Product::select('products.*')
                    ->leftJoin('categories', 'categories.id', 'products.category_id')
                    ->where('categories.bar', $bar)
                    ->with('category');

        //busquedas
        $search =  $request->input("search", '');
        if ($search != "") {
            $products = $products->where('name', 'like', '%'.$search.'%');
        }

        //ordernacion del listado
        $order =  $request->input("order", 'ASC');
        $orderby =  $request->input("orderby", 'name');
        
        $products = $products->orderBy($orderby, $order)->paginate(15);

        return view('products.index', ['products' => $products, 'search' => $search, 'orderby' => $orderby, 'order' => $order, 'bar' => $bar]);
    }

    public function bar(Request $request)
    {
        return $this->index($request, 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $bar=0)
    {
        $categories = Category::where('bar', $bar)->get();
        return view('products.new', [
            'categories' => $categories,
            'bar' => $bar
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function store(ProductRequest $request)
    {
        if ($product = Product::create([
                'name'     => $request->input('name'),
                'category_id'    => $request->input('category_id'),
                'price'    => $request->input('price'),
                'menu'    => ($request->has('menu') ? $request->input('menu') : 0),
            ])) {
            $status = __('general.InsertOkMessage');
        } else {
            $status = __('general.ErrorMessage');
        }

        $bar = $product->category()->first()->bar;

        return redirect()->route('product.edit', ['product' => $product->id, 'bar' => $bar])->with('status', $status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, $bar=0, Request $request)
    {

        //Entradas del producto
        $warehouses = Warehouse::select('warehouses.*', 'suppliers.name AS fullname', 'products.name AS product', 'categories.name AS category', 'categories.bar AS bar')
            ->leftJoin('suppliers', 'suppliers.id', 'warehouses.supplier_id')
            ->leftJoin('products', 'products.id', 'warehouses.product_id')
            ->leftJoin('categories', 'categories.id', 'products.category_id')
            ->where('warehouses.type', 'E')
            ->where('warehouses.product_id', $product->id);

        //busquedas
        $search =  $request->input("search", '');
        //if ($search != "") $warehouses = $warehouses->where('last_name', 'like', '%'.$search.'%');

        //ordernacion del listado
        $order =  $request->input("order", 'DESC');
        $orderby =  $request->input("orderby", 'warehouses.created_at');
        $warehouses = $warehouses->orderBy($orderby, $order)->paginate(5);

        //Salidas del producto
        $warehouses_out = Warehouse::select('warehouses.*', DB::raw("CONCAT(members.name,' ',members.last_name)  AS fullname"), 'products.name AS product', 'categories.name AS category', 'categories.bar AS bar')
            ->leftJoin('members', 'members.id', 'warehouses.member_id')
            ->leftJoin('products', 'products.id', 'warehouses.product_id')
            ->leftJoin('categories', 'categories.id', 'products.category_id')
            ->where('warehouses.type', 'S')
            ->where('warehouses.product_id', $product->id);

        //busquedas
        $search_out =  $request->input("search-out", '');
        //if ($search != "") $warehouses = $warehouses->where('last_name', 'like', '%'.$search.'%');

        //ordernacion del listado
        $order_out =  $request->input("order-out", 'DESC');
        $orderby_out =  $request->input("orderby-out", 'warehouses.created_at');
        $warehouses_out = $warehouses_out->orderBy($orderby_out, $order_out)->paginate(5);

        $categories = Category::where('bar', $bar)->get();
        $tab =  $request->input("tab", '');

        return view('products.edit', [
            'product' => $product,
            'categories' => $categories,
            'warehouses' => $warehouses,
            'order' => $order,
            'orderby' => $orderby,
            'search' => $search,
            'warehouses_out' => $warehouses_out,
            'order_out' => $order_out,
            'orderby_out' => $orderby_out,
            'search_out' => $search_out,
            'bar' => $bar,
            'tab' => $tab,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, ProductRequest $request)
    {
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->price = $request->input('price');
        $product->menu = ($request->has('menu') ? $request->input('menu') : 0);
        $product->save();
        return redirect()->back()->with('status', __('general.UpdateOkMessage'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @param  $destino
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('status', __('general.DeleteOkMessage'));
    }

    /**
     * Export data to the specified format.
     *
     * @param  $exportOption
     * @param  \Illuminate\Http\Request  $request
     * @return Document XLSX, XLS, CSV
     */
    public function export($exportOption = "xlsx", Request $request)
    {
        return Excel::download(new ProductsExport($request), 'products.'.$exportOption);
    }
}

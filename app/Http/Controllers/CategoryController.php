<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    public function index(Request $request, $bar=0)
    {
        $category = Category::select('*')->where('bar', $bar)->with('products');

        //busquedas
        $search =  $request->input("search", '');
        if ($search != "") {
            $category = $category->where('name', 'like', '%'.$search.'%');
        }

        //ordernacion del listado
        $order =  $request->input("order", 'DESC');
        $orderby =  $request->input("orderby", 'name');
        
        $category = $category->orderBy($orderby, $order)->paginate(15);

        return view('categories.index', ['category' => $category, 'search' => $search, 'orderby' => $orderby, 'order' => $order, 'bar' => $bar]);
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
        return view('categories.new', ['bar' => $bar]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function store(CategoryRequest $request)
    {
        if ($category = Category::create([
                'name'     => $request->input('name'),
                'color'     => $request->input('color'),
                'bar'     => $request->input('bar'),
                'notes'    => $request->input('notes'),
            ])) {
            $status = __('general.InsertOkMessage');
        } else {
            $status = __('general.ErrorMessage');
        }

        return redirect()->route('category.edit', ['category' => $category->id])->with('status', $status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $products = Product::select('products.*')
                    ->leftJoin('categories', 'categories.id', 'products.category_id')
                    ->where('products.category_id', $category->id)
                    ->with('category');
        
        $products = $products->orderBy('name', 'ASC')->paginate(10);

        return view('categories.edit', ['category' => $category, 'products' => $products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category, CategoryRequest $request)
    {
        $category->name = $request->input('name');
        $category->color = $request->input('color');
        $category->notes = $request->input('notes');
        $category->save();
        return redirect()->back()->with('status', __('general.UpdateOkMessage'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @param  $destino
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('status', __('general.DeleteOkMessage'));
    }
}

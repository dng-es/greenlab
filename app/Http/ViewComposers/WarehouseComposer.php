<?php

namespace App\Http\ViewComposers;

use App\Product;
use App\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WarehouseComposer
{
    /**
    * Devuelve a la vista los banners activos
    *
    * @param  View  $view
    */
    public static function show(View $view)
    {
        $products = Product::select('products.*', 'categories.bar')
                    ->leftJoin('categories', 'categories.id', 'products.category_id')
                    ->orderBy('name', 'ASC')->get();
        $suppliers = Supplier::orderBy('name', 'ASC')->get();
        $view->with('products', $products)->with('suppliers', $suppliers);
    }
}

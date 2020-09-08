<?php

namespace App\Http\ViewComposers;

use App\Product;
use App\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ExpenseComposer
{
    /**
    * Devuelve a la vista los banners activos
    *
    * @param  View  $view
    */
    public static function show(View $view)
    {
        $suppliers = Supplier::orderBy('name', 'ASC')->get();
        $view->with('suppliers', $suppliers);
    }
}

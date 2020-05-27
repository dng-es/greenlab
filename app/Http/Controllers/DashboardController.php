<?php

namespace App\Http\Controllers;


use App\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request)
    {
    	$stock = Product::where('amount', '>', 0)
            ->with('category')
            ->orderBy('name')
            ->get();
        return view('dashboard', ['stock' => $stock]);

    }
}

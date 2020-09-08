<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //warehouse new
        $this->app['view']->composer('warehouses.partials.new', 'App\Http\ViewComposers\WarehouseComposer@show');

        //expense new
        $this->app['view']->composer('expenses.partials.new', 'App\Http\ViewComposers\ExpenseComposer@show');
    }
}

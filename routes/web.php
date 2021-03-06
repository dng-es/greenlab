<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes(['register' => false]);
Auth::routes(['verify' => false]);

Route::get('/validation', function(){
	return view('validation')->with('status','Usuario pendiente de validación');
})->name('validation');


// Localization
Route::get('/js/lang.js', function () {
    Cache::flush();
    Cache::forget('lang.js');
    $strings = Cache::rememberForever('lang.js', function () {
        $lang = app()->getLocale();

        $files   = glob(resource_path('lang/' . $lang . '/*.php'));
        $strings = [];

        foreach ($files as $file) {
            $name           = basename($file, '.php');
            $strings[$name] = require $file;
        }

        return $strings;
    });
    echo('window.i18n = ' . json_encode($strings) . ';');
    exit();
})->name('assets.lang');

Route::get('/lang/{lang}', function ($lang) {
    session()->put('locale', $lang);
    app()->setLocale($lang);
    // echo "Routes 1: ".app()->getLocale()."<br>";
    // die;
    return redirect()->back();
})->name("lang");


Route::middleware(['auth', 'verified'])->group(function () {
	Route::get('/profile', 'ProfileController@show')->name('profile');
	Route::post('/profile', 'ProfileController@update')->name('profile.update');
	Route::post('/changePassword','ProfileController@changePassword')->name('profile.changePassword');

	Route::get('/home', 'HomeController@show')->name('home');

    Route::group([
        'middleware' => 'role:admin seller',
    ], function () {
        Route::get('/menu', 'MenuController@show')->name('menu');
        
        Route::get('/members/search/{search?}', 'MemberController@search')->name('members.search');
        Route::get('/members', 'MemberController@index')->name('members');     
        Route::post('/member/edit/{member}', 'MemberController@update')->name('members.update');        
        Route::get('/member/edit/{member}', 'MemberController@edit')->name('member.edit');
        Route::get('/member/new', 'MemberController@create')->name('member.new');
        Route::post('/member/new', 'MemberController@store')->name('member.create');
        Route::post('/member/edit/', 'MemberController@update');        
        Route::get('/members/warehouses/{member}', 'MemberController@warehouses')->name('members.warehouses');
        Route::get('/members/credits/{member}', 'MemberController@credits')->name('members.credits');
        Route::get('/credit/new', 'CreditController@create')->name('credits.new');
        Route::post('/credit/new', 'CreditController@store')->name('credits.create');
        Route::get('/members/fees/{member}', 'MemberController@fees')->name('members.fees');
        Route::get('/fee/new', 'FeeController@create')->name('fees.new');
        Route::post('/fee/new', 'FeeController@store')->name('fees.create');        
        Route::post('/member/document/new/{member}', 'DocumentController@store')->name('member.document.new');
        Route::get('/member/document/destroy/{document}', 'DocumentController@destroy')->name('member.document.destroy');
        Route::get('/sell/{member?}', 'SellController@create')->name('sell');
        Route::post('/sell/{member}', 'SellController@store'); 
    });

	Route::group([
        'middleware' => 'role:admin'
    ], function () {
		Route::get('/dashboard', 'DashboardController@show')->name('dashboard');
        

        Route::get('/backup', 'BackupController@generate')->name('backup');
        
        // Route::get('/backup', function () {

        //     \Illuminate\Support\Facades\Artisan::call('backup:run');

        //     return 'Successful backup!';

        // })->name('backup');

        Route::get('/sites/edit/{site}', 'SiteController@edit')->name('site.edit');
        Route::post('/sites/edit/{site}', 'SiteController@update');

        Route::get('/menu/edit/{menu}', 'MenuController@edit')->name('menu.edit');
        Route::post('/menu/edit/{menu}', 'MenuController@update');
        
        Route::get('/users', 'UserController@index')->name('users');
		Route::get('/users/destroy/{user}', 'UserController@destroy')->name('users.destroy');
        Route::get('/users/new', 'UserController@create')->name('users.new');
        Route::post('/users/new', 'UserController@store');
        Route::get('/users/edit/{user}', 'UserController@edit')->name('users.edit');
        Route::post('/users/edit/{user}', 'UserController@update');
        Route::get('/users/export/{exportOption?}', 'UserController@export')->name('users.export');

        Route::get('/supplier', 'SupplierController@index')->name('suppliers');
        Route::get('/supplier/destroy/{supplier}', 'SupplierController@destroy')->name('supplier.destroy');
        Route::get('/supplier/new', 'SupplierController@create')->name('supplier.new');
        Route::post('/supplier/new', 'SupplierController@store');
        Route::get('/supplier/edit/{supplier}', 'SupplierController@edit')->name('supplier.edit');
        Route::post('/supplier/edit/{supplier}', 'SupplierController@update');

		Route::get('/bar', 'CategoryController@bar')->name('bar');
        
        Route::get('/category', 'CategoryController@index')->name('categories');
		Route::get('/category/destroy/{category}', 'CategoryController@destroy')->name('category.destroy');
        Route::get('/category/new/{bar?}', 'CategoryController@create')->name('category.new');
        Route::post('/category/new/{bar?}', 'CategoryController@store');
        Route::get('/category/edit/{category}', 'CategoryController@edit')->name('category.edit');
        Route::post('/category/edit/{category}', 'CategoryController@update');

        Route::get('/members/export/{exportOption?}/{credit?}', 'MemberController@export')->name('members.export');
        Route::post('/members/import', 'MemberController@import')->name('members.import');   

		Route::get('/productsbar', 'ProductController@bar')->name('products.bar');
        Route::get('/products', 'ProductController@index')->name('products');
		
        Route::get('/product/destroy/{product}', 'ProductController@destroy')->name('product.destroy');
        
        Route::get('/product/new/{bar?}', 'ProductController@create')->name('product.new');
        Route::post('/product/new/{bar?}', 'ProductController@store');
        Route::get('/product/edit/{product}/{bar?}', 'ProductController@edit')->name('product.edit');
        Route::post('/product/edit/{product}/{bar?}', 'ProductController@update');        
        Route::get('/products/export/{exportOption?}', 'ProductController@export')->name('products.export');       

        Route::get('/locales', 'LocaleFileController@show')->name('locales');
        Route::post('/locales', 'LocaleFileController@changeLang');        
        
        Route::get('reports/count/members', 'ReportController@countMembers')->name('reports.count.members');
        Route::get('reports/count/ie', 'ReportController@countIE')->name('reports.count.ie');
        Route::get('reports/count/products', 'ReportController@countProducts')->name('reports.count.products');
        Route::get('reports/count/today', 'ReportController@countToday')->name('reports.count.today');
        Route::get('/reports/{type}', 'ReportController@show')->name('reports');
        
        Route::get('/warehouses/{type?}', 'WarehouseController@index')->name('warehouses');
        Route::get('/warehouse/export/{type}/{exportOption?}', 'WarehouseController@export')->name('warehouses.export');
        Route::post('/warehouse/', 'WarehouseController@store')->name('warehouse.new'); 
        Route::get('/warehouse/destroy/{warehouse}', 'WarehouseController@destroy')->name('warehouse.destroy');

        Route::get('/expenses', 'ExpenseController@index')->name('expenses');
        Route::post('/expense/', 'ExpenseController@store')->name('expenses.new'); 
        Route::get('/expense/destroy/{expense}', 'ExpenseController@destroy')->name('expense.destroy');
        Route::get('/expenses/export/{exportOption?}', 'ExpenseController@export')->name('expenses.export');

    });

});
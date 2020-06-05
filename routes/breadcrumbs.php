<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push(__('general.Home'), route('home'));
});

// Home > Users
Breadcrumbs::for('profile', function ($trail) {
    $trail->parent('home');
    $trail->push(__('general.Profile'), route('profile'));
});

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push(__('general.Dashboard'), route('dashboard'));
});

// Dashboard > Reports
Breadcrumbs::for('reports', function ($trail, $type) {
    $trail->parent('dashboard');
    $trail->push( __('general.Statistics'), route('reports',['type' => $type]));
});

// Dashboard > Site
Breadcrumbs::for('site', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('general.Site_config'), route('site.edit', ['site' => 1]));
});

// Dashboard > Menu
Breadcrumbs::for('menu', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('app.Menu'), route('menu'));
});

// Dashboard > Locales
Breadcrumbs::for('locales', function ($trail) {
    $trail->parent('dashboard');
    $trail->push( __('general.Locales_change'), route('menu'));
});

// Dashboard > Users
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('general.Users'), route('users'));
});

// Dashboard > Users > New
Breadcrumbs::register('users_new', function ($breadcrumbs) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push(__('general.New'), route('users.new'));
});

// Dashboard > Users > Edit
Breadcrumbs::register('users_edit', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push($user->first_name.' '.$user->last_name, route('users.edit', $user->id));
});

// Dashboard > Warehouses
Breadcrumbs::for('warehouses', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('app.Warehouses'), route('warehouses'));
});

// Dashboard > Expenses
Breadcrumbs::for('expenses', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('app.Expenses_other'), route('expenses'));
});

// Dashboard > Suppliers
Breadcrumbs::for('suppliers', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('app.Suppliers'), route('suppliers'));
});

// Dashboard > Suppliers > New
Breadcrumbs::register('supplier_new', function ($breadcrumbs) {
    $breadcrumbs->parent('suppliers');
    $breadcrumbs->push(__('general.New'), route('supplier.new'));
});

// Dashboard > Suppliers > Edit
Breadcrumbs::register('supplier_edit', function ($breadcrumbs, $supplier) {
    $breadcrumbs->parent('suppliers');
    $breadcrumbs->push($supplier->name, route('supplier.edit', $supplier->id));
});

// Dashboard > Bar
Breadcrumbs::for('bar', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('app.Bar').' '.__('app.Categories'), route('bar'));
});

// Dashboard > Bar > New
Breadcrumbs::register('bar_new', function ($breadcrumbs) {
    $breadcrumbs->parent('bar');
    $breadcrumbs->push(__('general.New'), route('category.new', 1));
});

// Dashboard > Bar > Edit
Breadcrumbs::register('bar_edit', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('bar');
    $breadcrumbs->push($category->name, route('category.edit', $category->id));
});

// Dashboard > Bar Products
Breadcrumbs::for('products_bar', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('app.Bar').' '.__('app.Products'), route('products.bar'));
});

// Dashboard > Bar Products > New
Breadcrumbs::register('product_bar_new', function ($breadcrumbs) {
    $breadcrumbs->parent('products_bar');
    $breadcrumbs->push(__('general.New'), route('product.new', 1));
});

// Dashboard > Bar Products > Edit
Breadcrumbs::register('product_bar_edit', function ($breadcrumbs, $product) {
    $breadcrumbs->parent('products_bar');
    $breadcrumbs->push($product->name, route('product.edit', $product->id));
});

// Dashboard > Categories
Breadcrumbs::for('categories', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('app.Categories'), route('categories'));
});

// Dashboard > Categories > New
Breadcrumbs::register('category_new', function ($breadcrumbs) {
    $breadcrumbs->parent('categories');
    $breadcrumbs->push(__('general.New'), route('category.new'));
});

// Dashboard > Categories > Edit
Breadcrumbs::register('category_edit', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('categories');
    $breadcrumbs->push($category->name, route('category.edit', $category->id));
});



// Dashboard > Products
Breadcrumbs::for('products', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('app.Products'), route('products'));
});

// Dashboard > Products > New
Breadcrumbs::register('product_new', function ($breadcrumbs) {
    $breadcrumbs->parent('products');
    $breadcrumbs->push(__('general.New'), route('product.new'));
});

// Dashboard > Products > Edit
Breadcrumbs::register('product_edit', function ($breadcrumbs, $product) {
    $breadcrumbs->parent('products');
    $breadcrumbs->push($product->name, route('product.edit', $product->id));
});

// Dashboard > Members
Breadcrumbs::for('members', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('app.Members'), route('members'));
});

// Dashboard > Members > New
Breadcrumbs::register('member_new', function ($breadcrumbs) {
    $breadcrumbs->parent('members');
    $breadcrumbs->push(__('general.New'), route('member.new'));
});

// Dashboard > Members > Edit
Breadcrumbs::register('member_edit', function ($breadcrumbs, $member) {
    $breadcrumbs->parent('members');
    $breadcrumbs->push($member->name, route('member.edit', $member->id));
});
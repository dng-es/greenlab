<?php

namespace App\Http\Controllers;

use App\Category;
use App\Expense;
use App\Fee;
use App\Member;
use App\Product;
use App\Supplier;
use App\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function show(Request $request, $type)
    {
        $limit = $request->input('limit', 10);
        $order = $request->input('order', 'total');
        $month = $request->input('month', Carbon::now()->format('m'));
        $year = $request->input('year', Carbon::now()->format('Y'));
        $year_ini = substr(Warehouse::min('created_at'), 0, 4);
        $show_months = true;

        switch ($type) {
            case 'top_month':
                $title = __('app.Top_month');
                $data = Product::select(DB::raw('CONCAT(products.name, " - " , categories.name) AS name, SUM( warehouses.total ) AS total, SUM( amount_real ) AS total2'))
                        ->leftJoin('categories', 'categories.id', 'products.category_id')
                        ->leftJoin('warehouses', 'warehouses.product_id', 'products.id')
                        ->where('warehouses.type', 'S')
                        ->where('categories.bar', 0)
                        ->whereMonth('warehouses.created_at', $month)
                        ->whereYear('warehouses.created_at', $year)
                        ->groupBy('warehouses.product_id');
                break;
            case 'top_year':
                $title = __('app.Top_year');
                $show_months = false;
                $data = Product::select(DB::raw('CONCAT(products.name, " - " , categories.name) AS name,  SUM( warehouses.total ) AS total, SUM( amount_real ) AS total2'))
                        ->leftJoin('categories', 'categories.id', 'products.category_id')
                        ->leftJoin('warehouses', 'warehouses.product_id', 'products.id')
                        ->where('warehouses.type', 'S')
                        ->where('categories.bar', 0)
                        ->whereYear('warehouses.created_at', $year)
                        ->groupBy('warehouses.product_id');
                break;

            case 'top_category_month':
                $title = __('app.Top_category_month');
                $data = Category::select(DB::raw('categories.id, categories.name AS name, SUM( warehouses.total ) AS total, SUM( amount_real ) AS total2'))
                        ->Join('products', 'categories.id', 'products.category_id')
                        ->Join('warehouses', 'warehouses.product_id', 'products.id')
                        ->where('warehouses.type', 'S')
                        ->where('categories.bar', 0)
                        ->whereMonth('warehouses.created_at', $month)
                        ->whereYear('warehouses.created_at', $year)
                        ->groupBy('categories.id');
                break;

            case 'top_category_year':
                $title = __('app.Top_category_year');
                $show_months = false;
                $data = Category::select(DB::raw('categories.id, categories.name AS name,  SUM( warehouses.total ) AS total, SUM( amount_real ) AS total2'))
                        ->Join('products', 'categories.id', 'products.category_id')
                        ->Join('warehouses', 'warehouses.product_id', 'products.id')
                        ->where('warehouses.type', 'S')
                        ->where('categories.bar', 0)
                        ->whereYear('warehouses.created_at', $year)
                        ->groupBy('categories.id');
                break;

            case 'top_member_month':
                $title = __('app.Top_member_month');
                $data = Member::select(DB::raw('CONCAT(members.name, " ", members.last_name) AS name,  SUM( warehouses.total ) AS total, SUM( amount_real ) AS total2'))
                        ->leftJoin('warehouses', 'warehouses.member_id', 'members.id')
                        ->leftJoin('products', 'products.id', 'warehouses.product_id')
                        ->leftJoin('categories', 'categories.id', 'products.category_id')
                        ->where('warehouses.type', 'S')
                        ->where('categories.bar', 0)
                        ->whereMonth('warehouses.created_at', $month)
                        ->whereYear('warehouses.created_at', $year)
                        ->groupBy('warehouses.member_id');
                break;

            case 'top_member_year':
                $title = __('app.Top_member_year');
                $show_months = false;
                $data = Member::select(DB::raw('CONCAT(members.name, " ", members.last_name) AS name,  SUM( warehouses.total ) AS total, SUM( amount_real ) AS total2'))
                        ->leftJoin('warehouses', 'warehouses.member_id', 'members.id')
                        ->leftJoin('products', 'products.id', 'warehouses.product_id')
                        ->leftJoin('categories', 'categories.id', 'products.category_id')
                        ->where('warehouses.type', 'S')
                        ->where('categories.bar', 0)
                        ->whereYear('warehouses.created_at', $year)
                        ->groupBy('warehouses.member_id');
                break;
            case 'top_supplier_month':
                $title = __('app.Top_supplier_month');
                $data = Supplier::select('suppliers.*', DB::raw(' SUM( warehouses.total ) AS total, SUM( warehouses.amount ) AS total2'))
                        ->leftJoin('warehouses', 'warehouses.supplier_id', 'suppliers.id')
                        ->leftJoin('products', 'products.id', 'warehouses.product_id')
                        ->leftJoin('categories', 'categories.id', 'products.category_id')
                        ->where('warehouses.type', 'E')
                        ->where('categories.bar', 0)
                        ->whereMonth('warehouses.created_at', $month)
                        ->whereYear('warehouses.created_at', $year)
                        ->groupBy('warehouses.supplier_id');
                break;

            case 'top_supplier_year':
                $title = __('app.Top_supplier_year');
                $show_months = false;
                $data = Supplier::select('suppliers.*', DB::raw(' SUM(warehouses.total ) AS total, SUM( warehouses.amount ) AS total2'))
                        ->leftJoin('warehouses', 'warehouses.supplier_id', 'suppliers.id')
                        ->leftJoin('products', 'products.id', 'warehouses.product_id')
                        ->leftJoin('categories', 'categories.id', 'products.category_id')
                        ->where('warehouses.type', 'E')
                        ->where('categories.bar', 0)
                        ->whereYear('warehouses.created_at', $year)
                        ->groupBy('warehouses.supplier_id');
                break;
            case 'balance':
                $title =  __('app.Incomes') . ' - ' . __('app.Expenses') . ' ('. __('general.Monthly') . ')';
                return $this->balance($title, $type, $month, $year, $year_ini, true);
                break;
            case 'balance_annual':
                $title =  __('app.Incomes') . ' - ' . __('app.Expenses') . ' ('. __('general.Annual') . ')';
                return $this->balance($title, $type, $month, $year, $year_ini, false);
                break;
            default:
                $data = null;
                $title = '';
                break;
        }

        $data = $data->orderBy($order, 'DESC')
                    ->limit($limit)
                    ->get();

        return view('reports.reports', [
            'title' => $title,
            'type' => $type,
            'data' => $data,
            'limit' => $limit,
            'order' => $order,
            'month' => $month,
            'year' => $year,
            'year_ini' => $year_ini,
            'show_months' => $show_months,
        ]);
    }

    private function balance($title, $type, $month, $year, $year_ini, $show_months)
    {
        $total_incomes_products = Warehouse::leftJoin('products', 'products.id', 'warehouses.product_id')
                ->leftJoin('categories', 'categories.id', 'products.category_id')
                ->where('warehouses.type', 'S')
                ->where('categories.bar', 0)
                ->when($show_months, function ($query) use ($month) {
                    return $query->whereMonth('warehouses.created_at', $month);
                })
                ->whereYear('warehouses.created_at', $year)
                ->sum('total');

        $total_incomes_bar = Warehouse::leftJoin('products', 'products.id', 'warehouses.product_id')
                ->leftJoin('categories', 'categories.id', 'products.category_id')
                ->where('warehouses.type', 'S')
                ->where('categories.bar', 1)
                ->when($show_months, function ($query) use ($month) {
                    return $query->whereMonth('warehouses.created_at', $month);
                })
                ->whereYear('warehouses.created_at', $year)
                ->sum('total');

        $total_incomes_fees = Fee::when($show_months, function ($query) use ($month) {
            return $query->whereMonth('fees.created_at', $month);
        })
                ->whereYear('fees.created_at', $year)
                ->sum('price');

        $total_expenses_products = Warehouse::leftJoin('products', 'products.id', 'warehouses.product_id')
                ->leftJoin('categories', 'categories.id', 'products.category_id')
                ->where('warehouses.type', 'E')
                ->where('categories.bar', 0)
                ->when($show_months, function ($query) use ($month) {
                    return $query->whereMonth('warehouses.created_at', $month);
                })
                ->whereYear('warehouses.created_at', $year)
                ->sum('total');

        $total_expenses_bar = Warehouse::leftJoin('products', 'products.id', 'warehouses.product_id')
                ->leftJoin('categories', 'categories.id', 'products.category_id')
                ->where('warehouses.type', 'E')
                ->where('categories.bar', 1)
                ->when($show_months, function ($query) use ($month) {
                    return $query->whereMonth('warehouses.created_at', $month);
                })
                ->whereYear('warehouses.created_at', $year)
                ->sum('total');

        $total_expenses_other = Expense::whereYear('expenses.date_at', $year)
                        ->when($show_months, function ($query) use ($month) {
                            return $query->whereMonth('expenses.date_at', $month);
                        })
                        ->sum('total');

        return view('reports.reportBalance', [
            'title' => $title,
            'type' => $type,
            'total_incomes_products' => $total_incomes_products,
            'total_incomes_bar' => $total_incomes_bar,
            'total_incomes_fees' => $total_incomes_fees,
            'total_expenses_products' => $total_expenses_products,
            'total_expenses_bar' => $total_expenses_bar,
            'total_expenses_other' => $total_expenses_other,
            'month' => $month,
            'year' => $year,
            'year_ini' => $year_ini,
            'show_months' => $show_months,
        ]);
    }

    public function countMembers()
    {
        return Member::where('active', 1)->count();
    }

    public function countIE()
    {
        $balance = $this->balance('', '', Carbon::now()->format('m'), Carbon::now()->format('Y'), 0, true);

        $total = (
            $balance['total_incomes_products'] +
            $balance['total_incomes_bar'] +
            $balance['total_incomes_fees']
        ) - (
            $balance['total_expenses_products'] +
            $balance['total_expenses_bar'] +
            $balance['total_expenses_other']
        );
        return $total;
    }

    public function countProducts()
    {
        return Product::leftJoin('categories', 'categories.id', 'products.category_id')
                        ->where('bar', 0)
                        ->where('menu', 1)
                        ->count();
    }

    public function countToday()
    {
        $today = Carbon::now()->format('Y-m-d');
        $total_incomes = Warehouse::leftJoin('products', 'products.id', 'warehouses.product_id')
                ->where('warehouses.type', 'S')
                ->whereDate('warehouses.created_at', $today)
                ->sum('total');

        $total_incomes_fees = Fee::whereDate('fees.created_at', $today)
                ->sum('price');

        $total = $total_incomes + $total_incomes_fees;
        return $total;
    }
}

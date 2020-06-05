<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Exports\ExpensesExport;
use App\Http\Requests\ExpenseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $expenses = Expense::select('expenses.*', 'suppliers.name AS supplier')
                ->leftJoin('suppliers', 'suppliers.id', 'expenses.supplier_id');

        //busquedas
        $search =  $request->input("search", '');
        if ($search != "") $expenses = $expenses->where('expenses.notes', 'like', '%'.$search.'%')
            ->orWhere('suppliers.name', 'like', '%'.$search.'%');

        //ordernacion del listado
        $order =  $request->input("order", 'DESC');
        $orderby =  $request->input("orderby", 'expenses.date_at');
        

        $expenses = $expenses->orderBy($orderby, $order)->paginate(15);

        return view('expenses.index', ['expenses' => $expenses, 'search' => $search, 'orderby' => $orderby, 'order' => $order]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function store(ExpenseRequest $request)
    {
        if ($expense = Expense::create([
                'user_id'     => Auth::user()->id,
                'supplier_id'    => $request->input('supplier_id'),
                'price'    => $request->input('price'),
                'amount'    => $request->input('amount'),
                'total'    => $request->input('total'),
                'notes'    => $request->input('notes'),
                'date_at'    => $request->input('date_at'),
            ])){    
            $message = __('general.InsertOkMessage');
        }
        else $message =  __('general.ErrorMessage');

        return redirect()->back()->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->back()->with('status', __('general.DeleteOkMessage'));
    }

    /**
     * Export data to the specified format.
     *
     * @param  $exportOption
     * @param  \Illuminate\Http\Request  $request
     * @return Document XLSX, XLS, CSV
     */
    public function export($type, $exportOption = "xlsx", Request $request)
    {
        return Excel::download(new ExpensesExport($type, $request), __('app.Expenses'). '.'.$exportOption);
    }    
}

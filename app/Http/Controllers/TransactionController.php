<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; 
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Services\TransactionService;


class TransactionController extends Controller
{

    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }
    public function processRecurringTransactions()
    {
        // Call the recurring function from the service
        $this->transactionService->recurring();

        return redirect()->back()->with('success', 'Recurring transactions processed successfully.');
    }

    public function index()
    {
        $transactions = Transaction::where(['user_id'=> auth()->user()->id])->latest()->get();
        return view('income-expenses.index', compact('transactions'));
    }

    public function create()
    {
        $category = Category::where(['status'=>'active'])->get();
        return view('income-expenses.create', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'category_id' => 'nullable|integer',
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'type' => 'required|string',
        ]);

        Transaction::create($request->all());

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction created successfully.');
    }

    public function edit(Transaction $transaction)
    {
        $category = Category::where(['status'=>'active'])->get();
        return view('income-expenses.edit', compact ('transaction','category'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'category_id' => 'nullable|integer',
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'type' => 'required|string',
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction updated successfully');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction deleted successfully');
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    function index(){
        $totalIncome = Transaction::where(['type'=>'income', 'user_id'=> auth()->user()->id])->sum('amount');
        $totalExpense = Transaction::where(['type'=>'expense', 'user_id'=> auth()->user()->id])->sum('amount');
        $balance = $totalIncome - $totalExpense;
        // Fetch income data
        $incomeChartData = Transaction::select(DB::raw("SUM(amount) as sum"), DB::raw("MONTH(date) as month"))
        ->where(['type'=>'income', 'user_id'=> auth()->user()->id])
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("MONTH(date)"))
        ->orderBy(DB::raw("MONTH(date)"))
        ->pluck('sum', 'month');

        // Fetch expense data
        $expenseChartData = Transaction::select(DB::raw("SUM(amount) as sum"), DB::raw("MONTH(date) as month"))
        ->where(['type'=>'expense', 'user_id'=> auth()->user()->id])
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("MONTH(date)"))
        ->orderBy(DB::raw("MONTH(date)"))
        ->pluck('sum', 'month');
       
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $incomeData = [];
        $expenseData = [];

        // Initialize arrays with zeros for each month
        foreach ($months as $key => $month) {
            $incomeData[$key] = $incomeChartData[$key + 1] ?? 0;
            $expenseData[$key] = $expenseChartData[$key + 1] ?? 0;
        }

        return view('home', compact('totalIncome','totalExpense','balance', 'months', 'incomeData', 'expenseData'));
    }

    function recuring(){

     //income 
      $users = User::all();

      foreach($users as $user){
        Trasaction::create([
            'user_id'=>$user->id,
            'amount'=>20000,
            'description'=>'salary',
            'type'=>'income',
            'date'=>date('Y-m-d')

        ]);
      }
       
    }
}

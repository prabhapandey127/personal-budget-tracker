<?php

namespace App\Services;

use App\Models\User;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionService
{
    public function recurring()
    {
        // Fetch all users
        $users = User::all();

        // Iterate through each user and create a transaction
        foreach ($users as $user) {
            Transaction::create([
                'user_id' => $user->id,
                'amount' => rand(10000,50000),
                'description' => 'salary',
                'type' => 'expense',
                'date' => Carbon::now()->toDateString() // Use Carbon for date formatting
            ]);
        }
        
        // Optionally, return something or log success
        \Log::info('Recurring transactions processed successfully.');
    }
}

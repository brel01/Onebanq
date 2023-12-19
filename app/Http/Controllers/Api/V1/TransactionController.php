<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function getTransactionHistory(Request $request)
    {
        $user = auth('api')->user();

        $validatedData =  $request->all();

        // Retrieve transaction history for the authenticated user
        $transactions = Transaction::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return response()->json(['transactions' => $transactions], 200);
    }
}

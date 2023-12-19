<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Http;


use Flutterwave\Controller\PaymentController as FWPaymentController;
use Flutterwave\EventHandlers\ModalEventHandler as PaymentHandler;
use Flutterwave\Flutterwave;
use Flutterwave\Library\Modal;
use Flutterwave\Util\Currency;



class PaymentController extends Controller
{
    public function initiatePayment(Request $request)
    {
        try {
            // Validate request data
            $validatedData = $request->validate([
                'amount' => 'required|numeric',
            ]);
            
            $user = auth('api')->user();
    
            // Create a new transaction in the database 
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'amount' => $validatedData['amount'],
                'status' => 'initiated',
            ]);
    
            // Payment data
            $paymentData = [
                "amount" => $validatedData['amount'],
                "currency" => Currency::NGN,
                "tx_ref" => uniqid() . time(),
                "additionalData" => [
                    "account_details" => [
                        "account_bank" => "044",
                        "account_number" => "0690000034",
                        "country" => "NG",
                    ],
                ],
            ];
    
            // Initialize Flutterwave payment
            $accountPayment = Flutterwave::create("account");
    
            // Create customer object
            $customerObj = $accountPayment->customer->create([
                "full_name" => $user->name,
                "email" => $user->email,
                "phone" => $user->phone,
            ]);
    
            $paymentData['customer'] = $customerObj;
    
            // Create payment payload
            $payload = $accountPayment->payload->create($paymentData);
    
            // Initiate payment
            $result = $accountPayment->initiate($payload);
    
            if ($result['status'] === 'success') {
                return response()->json([
                    'message' => 'Payment successful',
                    'transaction_id' => $result['data']['id'],
                ], 200);
            } else {
                return response()->json([
                    'error' => 'Payment failed',
                    'reason' => $result['message'],
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error during payment',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}

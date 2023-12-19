<?php
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\TransactionController;
use App\Http\Controllers\Api\V1\PaymentController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->namespace('App\Http\Controllers\Api\V1')->group(function () {
    // User Registration
    Route::post('register', [UserController::class, 'register']);

    // Authentication
    Route::post('login', [AuthController::class, 'login']);
    Route::get('login', [AuthController::class, 'logout'])->name('login');

    // Payment Processing (Protected by auth.jwt)
    Route::middleware('auth.jwt')->post('payment', [PaymentController::class, 'initiatePayment']);

    // Transaction History (Protected by auth.jwt)
    Route::middleware('auth.jwt')->get('transaction-history', [TransactionController::class, 'getTransactionHistory']);

    // Logout (Protected by auth.jwt)
    Route::middleware('auth.jwt')->post('logout', [AuthController::class, 'logout']);
});

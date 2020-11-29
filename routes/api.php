<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentConfirmationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentRefundController;
use App\Http\Controllers\UserPaymentsController;

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

Route::get('/confirmation/{resourcePath}', PaymentConfirmationController::class)->name('payment.confirmation');
Route::get('/users/{id}/payments', UserPaymentsController::class)->name('user.payments');
Route::post('/payments/{id}/{code}', PaymentRefundController::class)->name('user.payment.refund');
Route::resource('/payments', PaymentController::class);

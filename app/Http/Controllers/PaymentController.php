<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {

        $paymentInfo = $request->paymentInfo;
        $user = User::findOrFail($request->userId);

        $payment = new Payment([
            'payment_code' => $paymentInfo['id'],
            'merchant_transaction_id' => $paymentInfo['merchantTransactionId'],
            'amount' => $paymentInfo['amount'],
            'ndc' => Hash::make($paymentInfo['ndc']),
            'currency' => $paymentInfo['currency'],
            'payment_type' => $paymentInfo['paymentType'],
            'payment_brand' => $paymentInfo['paymentBrand'],
            'created_at' => $paymentInfo['timestamp'],
            'refunded' => 0
        ]);

        $user->payments()->save($payment);

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

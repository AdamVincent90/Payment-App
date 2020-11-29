<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\PaymentResource;
use Illuminate\Http\Request;

class UserPaymentsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        $user = User::findOrFail($id);

        return PaymentResource::collection($user->payments()->latest()->get());
    }
}

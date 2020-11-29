<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'merchant_transaction_id' => $this->merchant_transaction_id,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
            'amount' => $this->amount,
            'payment_code' => $this->payment_code,
            'id' => $this->id,
            'refunded' => $this->refunded
        ];
    }
}

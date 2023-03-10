<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BillingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $status = 'Pending';
        if ($this->balance == 0) {
            $status = 'Paid';
        } elseif ($this->balance < $this->amount) {
            $status = 'Partial';
        }

        if (now()->diffInDays($this->created_at) > 30) {
            $status = 'Overdue';
        }
        return [
            'id' => $this->id,
            'subscription_number' => $this->subscription_number,
            'meter_number' => $this->meter_number,
            'status' => $status,
            'last_index' => $this->meterRequest->last_index,
            'balance' => $this->balance,
            'customer' => $this->meterRequest->request->customer,
            'amount' => $this->amount,
            'created_at' => optional($this->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
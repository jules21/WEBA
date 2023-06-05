<?php

namespace App\Http\Resources;

use App\Models\Billing;
use Illuminate\Http\Resources\Json\JsonResource;

class BillingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
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
        if (now()->diffInDays($this->created_at) > 30 && $this->balance >0) {
            $status = 'Overdue';
        }
        $totalAmount = Billing::query()
        ->where('subscription_number', $this->subscription_number)->sum('balance');
        $this->load('user.permissions');

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
            'comment' => $this->comment,
            'user' => $this->user,
            'total_amount' => $totalAmount,
            'operator_name' => $this->meterRequest->request->operator->name ?? null,
            'operator_address' => $this->meterRequest->request->operator->address ?? null,
        ];
    }
}

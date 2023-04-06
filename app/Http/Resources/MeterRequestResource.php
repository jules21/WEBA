<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MeterRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'subscription_number' => $this->subscription_number,
            'meter_number' => $this->meter_number,
            'status' => $this->status,
            'last_index' => $this->last_index,
            'balance' => $this->balance,
            'customer' => $this->request->customer,
        ];
    }
}

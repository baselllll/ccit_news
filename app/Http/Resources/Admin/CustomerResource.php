<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'uuid' => $this->uuid,
            'special_customer' => $this->special_customer,
            'sizes' => $this->sizes,
            'phone' => $this->phone,
            'name' => $this->name,
            'email' => $this->email,
            'customerSizes' => $this->customerSizes,
            'clothes_num' => $this->clothes_num,
            'city' => $this->city,
            'address' => $this->address,
            'additional_phone' => $this->additional_phone,
            'orders' => OrderResource::collection($this->orders),
        ];
    }
}

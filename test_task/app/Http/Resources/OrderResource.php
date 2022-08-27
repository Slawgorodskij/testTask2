<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'buyers_id' => $this->buyers_id,
            'products_id' => $this->products_id,
            'buyers_name' => $this->buyers->name,
            'products_name' => $this->products->name,
            'products_price' => $this->products->price,
            "count_product" => $this->count_product,
            "total_price" => $this->total_price,
            "order_status" => $this->order_status,
        ];
    }
}

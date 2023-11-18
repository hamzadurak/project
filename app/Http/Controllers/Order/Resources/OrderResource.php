<?php

namespace App\Http\Controllers\Order\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class OrderResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? '',
            'offerId' => $this->offer_id ?? '',
            'quantity' => $this->quantity ?? '',
            'orderDate' => $this->order_date ?? '',
        ];
    }
}

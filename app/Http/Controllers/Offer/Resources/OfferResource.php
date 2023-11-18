<?php

namespace App\Http\Controllers\Offer\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? '',
            'product' => $this->product_id ?? '',
            'seller' => $this->seller_id ?? '',
            'price' => $this->price ?? '',
            'condition' => $this->condition ?? '',
            'availability' => $this->availability ?? '',
        ];
    }
}

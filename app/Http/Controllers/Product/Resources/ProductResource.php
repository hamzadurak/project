<?php

namespace App\Http\Controllers\Product\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class ProductResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? '',
            'name' => $this->name ?? '',
            'category' => $this->category ?? '',
            'price' => $this->price ?? '',
        ];
    }
}

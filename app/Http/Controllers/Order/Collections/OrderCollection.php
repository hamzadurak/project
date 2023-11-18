<?php

namespace App\Http\Controllers\Order\Collections;

use App\Http\Controllers\Order\Resources\OrderResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    /**
     * @param $request
     * @return AnonymousResourceCollection
     */
    public function toArray($request): AnonymousResourceCollection
    {
        self::withoutWrapping();
        return OrderResource::collection($this->resource);
    }
}

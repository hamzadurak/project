<?php

namespace App\Http\Controllers\Product\Collections;

use App\Http\Controllers\Product\Resources\ProductResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * @param $request
     * @return AnonymousResourceCollection
     */
    public function toArray($request): AnonymousResourceCollection
    {
        self::withoutWrapping();
        return ProductResource::collection($this->resource);
    }
}

<?php

namespace App\Http\Controllers\Offer\Collections;

use App\Http\Controllers\Offer\Resources\OfferResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OfferCollection extends ResourceCollection
{
    /**
     * @param $request
     * @return AnonymousResourceCollection
     */
    public function toArray($request): AnonymousResourceCollection
    {
        self::withoutWrapping();
        return OfferResource::collection($this->resource);
    }
}

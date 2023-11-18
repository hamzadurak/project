<?php

namespace App\Http\Requests\Offer;

use App\Http\Requests\General\BaseFormRequest;

class OfferUpdateRequest extends BaseFormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'productId' => 'required',
            'sellerId' => 'required',
            'price' => 'required',
            'condition' => 'required|in:NEW,USED',
            'availability' => 'required|in:in stock,out of stock'
        ];
    }

}

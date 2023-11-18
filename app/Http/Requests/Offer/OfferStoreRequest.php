<?php

namespace App\Http\Requests\Offer;

use App\Http\Requests\General\BaseFormRequest;

class OfferStoreRequest extends BaseFormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'offerId' => 'required',
            'quantity' => 'required|numeric',
            'orderDate' => 'date'
        ];
    }
}

<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\General\BaseFormRequest;

class OrderUpdateRequest extends BaseFormRequest
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

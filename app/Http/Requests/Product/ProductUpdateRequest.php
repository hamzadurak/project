<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\General\BaseFormRequest;

class ProductUpdateRequest extends BaseFormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'category' => 'required|min:3'
        ];
    }

}

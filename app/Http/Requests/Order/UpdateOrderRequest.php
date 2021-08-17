<?php

namespace App\Http\Requests\Order;

use App\Rules\CheckOrderValidation;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'orderNumber' => 'numeric|between:1,100',
            'itemCount' => 'numeric|between:1,100',
            'status' => 'string',
            'note' => 'max:500|string',
            'storeId' => 'required|exists:stores,id',

            //use rule CheckOrderValidation for validation by storeId
            'products' => ['array', new CheckOrderValidation($this->storeId)],
            'products.*.productId' => 'required|exists:products,id',
            'products.*.price' => 'numeric|between:1,100000',
            'products.*.quantity' => 'numeric|between:1,100',
        ];
    }
}

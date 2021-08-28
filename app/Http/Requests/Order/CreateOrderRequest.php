<?php

namespace App\Http\Requests\Order;

use App\Rules\CheckOrderValidation;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'orderNumber' => 'required|numeric|between:1,100',
            'itemCount' => 'required|numeric|between:1,100',
            'status' => 'required|string',
            'note' => 'required|max:500|string',
            'storeId' => 'required|exists:stores,id',

            //use rule CheckOrderValidation for validation by storeId
            'products'=>['required','array',new CheckOrderValidation($this->storeId)],
            'products.*.productId'=>'required|exists:products,id',
            'products.*.price'=>'required|numeric|between:1,100000',
            'products.*.quantity'=>'required|numeric|between:1,100',
        ];
    }
}

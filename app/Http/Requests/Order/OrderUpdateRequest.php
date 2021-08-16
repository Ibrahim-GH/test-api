<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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
            'userId' => 'exists:users,id'
        ];
    }
}

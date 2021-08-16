<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
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
            'userId' => 'required|exists:users,id'
        ];
    }
}

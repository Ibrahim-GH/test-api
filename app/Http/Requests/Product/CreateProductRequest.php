<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:500',
            'categoryId' => 'required|exists:categories,id',
            'storeId' => 'required|exists:stores,id',

            'attributes' => 'required|array',
            'attributes.*.attributeId' => 'required|exists:attributes,id',
            'attributes.*.parameterId' => 'required|exists:parameters,id',
        ];
    }
}

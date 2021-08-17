<?php

namespace App\Http\Requests\Product;

use App\Rules\CheckProductValidation;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'string|max:50',
            'description' => 'string|max:500',
           //'price' => [ 'nullable', 'numeric', 'between:0,99' ]
            'price' => 'nullable|numeric|between:0,99',
            'quantity' => 'integer|between:1,100',
            'categoryId' => 'exists:categories,id',

            'attributess' => ['array', new CheckProductValidation($this->categoryId)],
            'attributess.*.attributeId' => 'exists:attributes,id',
            'attributess.*.parameterId' => 'exists:parameters,id',
        ];
    }
}

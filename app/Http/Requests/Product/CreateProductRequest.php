<?php

namespace App\Http\Requests\Product;

use App\Rules\CheckProductValidation;
use App\Rules\CheckValidation;
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
            'price' => 'required|nullable|numeric|between:1,100000',
            'quantity' => 'required|integer|between:1,100',
            'categoryId' => 'required|exists:categories,id',
            'storeId' => 'required|exists:stores,id',

            //use rule CheckProductValidation for validation by categoryId
            'attributess' => ['required', 'array', new CheckProductValidation($this->categoryId)],
            'attributess.*.attributeId' => 'required|exists:attributes,id',
            'attributess.*.parameterId' => 'required|exists:parameters,id',
        ];
    }
}

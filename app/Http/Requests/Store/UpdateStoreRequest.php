<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreRequest extends FormRequest
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
        $store = request()->route('store');
        return [
            'name' => 'string|max:30',
            'address' => 'string|max:50',
            'phoneNumber' => 'min:11|numeric|unique:stores,phone_number,' . $store->id,
        ];
    }
}

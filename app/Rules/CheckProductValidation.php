<?php

namespace App\Rules;

use App\Models\Attribute;
use App\Models\Parameter;
use Illuminate\Contracts\Validation\Rule;

class CheckProductValidation implements Rule
{
    public $categoryId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($value as $val) {

            //get the attribute object by attributeId in request attributess
            $id = $val['attributeId'];
            $attribut = Attribute::find($id);

            //get the parameter object by parameterId in request attributess
            $id = $val['parameterId'];
            $parameter = Parameter::find($id);

            //validation for all Items in attributess array in CreateProductRequest
            if (($attribut->category_id !== $this->categoryId)
                && ($parameter->attribute_id !== $attribut->id)) {

                return false;
            }

            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}

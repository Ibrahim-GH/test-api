<?php

namespace App\Rules;

use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;

class CheckAttributeValidation implements Rule
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
        //is required
        $category = Category::find($this->categoryId);
        // get all attributes from database by categoryId
        $attributes = $category->Attributes;

        foreach ($attributes as $attribute) {
            //Comparing the input items in request and the items attributes after get from database
            foreach ($value as $val) {

                $id = $val['attributeId'];
                $att = Attribute::find($id);

                //validate from failed is_required in database
                if ($attribute->is_required == 1) {
                    //if The item is not included in the request ... or...
                    // The item included(attributeId) do not equal attributeId in database
                    if (($att->id == null) || ($attribute->id !== $att->id)) {
                        return false;
                    }
                }

                return true;
            }
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

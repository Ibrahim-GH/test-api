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

        $countAttributes = $attributes->where('is_required', 1)->count();

        foreach ($value as $val) {

            $id = $val['attributeId'];
            $att = Attribute::find($id);

            if ($att->is_required == 1)
                $array[] = $att;
        }
        $countAtts = count($array);

        //validate if count(attributes) is status is_required in DataBase equal
        // count(attributes) is status is_required in request->attributes array
        if ($countAttributes == $countAtts) {
            return true;
        }

        return false;
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

<?php

namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class CheckOrderValidation implements Rule
{
    public $storeId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($storeId)
    {
        $this->storeId = $storeId;
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
        //validation for all products array in CreateOrderRequest
        foreach ($value as $val) {

            //get the product object by productId in request products
            $id = $val['productId'];
            $product = Product::find($id);

            //validation if order and product are belongs To store self
            if ($product->store_id == $this->storeId) {
                return true;
            }
            return false;
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

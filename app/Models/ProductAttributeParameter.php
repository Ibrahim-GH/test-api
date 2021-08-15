<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductAttributeParameter extends Pivot
{

    protected $fillable = [
        'product_id', 'attribute_id', 'parameter_id',
    ];

    protected $hidden = [];

}

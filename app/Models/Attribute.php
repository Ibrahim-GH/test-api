<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $table = 'attributes';

    protected $fillable = [
        'name','category_id',
    ];

    protected $hidden = [];

     public function Parameters()
     {
         return $this->hasMany(Parameter::class, 'attribute_id', 'id');
     }

}

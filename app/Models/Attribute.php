<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $table = 'attributes';

    protected $fillable = [
        'name', 'category_id',
    ];

    protected $hidden = [];


    ########################### The Relation for Attribute ###############################

    //the category has many attribute and attribute belong to one category
    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    //the attribute has many parameter and parameter belong to one attribute
    public function Parameters()
    {
        return $this->hasMany(Parameter::class, 'attribute_id', 'id');
    }

}

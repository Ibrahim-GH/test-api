<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
    ];

    protected $hidden = [];


    ########################### The Relation for Category ###############################

    //the store has many category and category belong to one store
    public function Store()
    {
        return $this->belongsTo(store::class, 'store_id', 'id');
    }

    //the category has many product and product belong to one category
    public function Products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }


    //the category has many attribute and attribute belong to one category
    public function Attributes()
    {
        return $this->hasMany(Attribute::class, 'category_id', 'id');
    }

}

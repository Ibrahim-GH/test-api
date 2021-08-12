<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;



    protected $table = 'Products';

    protected $fillable = [
        'name','store_id','category_id','description'
    ];

    protected $hidden = [];

    ########################### The Relation for Product ###############################

    //the store has many product and product belong to one store
    public function Stoer()
    {
        return $this->belongsTo(store::class, 'store_id', 'id');
    }

    //the category has many product and product belong to one category
    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
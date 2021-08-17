<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, softDeletes;


    protected $table = 'Products';

    protected $fillable = [
        'name', 'store_id', 'category_id', 'description', 'price', 'quantity'
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

    //the product belong to many order
    public function Orders()
    {
        return $this->belongsToMany(Order::class,'order_products');
    }
}

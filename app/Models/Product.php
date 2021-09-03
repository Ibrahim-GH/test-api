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
        'name', 'store_id', 'category_id', 'description', 'price', 'quantity', 'photo'
    ];

    protected $hidden = [];

    ########################### The Relation for Product ###############################

    public function Store()
    {
        return $this->belongsTo(store::class, 'store_id', 'id');
    }

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function Orders()
    {
        return $this->belongsToMany(Order::class, 'order_products');
    }

}

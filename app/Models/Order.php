<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'orders';

    protected $fillable = [
        'status', ' note', 'order_number', 'item_count', 'user_id',
    ];

    protected $hidden = [];


    //the user has many order and order belong to one user
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //the order belong to many product
    public function Products()
    {
        return $this->belongsToMany(Product::class, 'order_products');
    }

}

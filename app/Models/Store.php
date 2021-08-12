<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'stores';

    protected $fillable = [
        'name', 'address', 'phone_number'
    ];

    protected $hidden = [];


    ########################### The Relation for Store ###############################


    //the user has many store and store belong to one user
//     public function user()
//     {
//         return $this->belongsTo(User::class, 'user_id', 'id');
//     }


    //the store has many category and category belong to one store
    public function Categories()
    {
        return $this->hasMany(Category::class, 'store_id', 'id');
    }

    //the store has many product and product belong to one store
    public function Products()
    {
        return $this->hasMany(Product::class, 'store_id', 'id');
    }


}

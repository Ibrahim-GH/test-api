<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'stores';

    protected $fillable = [
        'name', 'address', 'phone_number', 'user_id'
    ];

    protected $hidden = [];


    ########################### The Relation for Store ###############################

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

    /**
     * Get the user that owns the store.
     */
    //the user has many product and product belong to one user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // this is a recommended way to declare event handlers
//    public static function boot()
//    {
//        Parent::boot();
//        self::deleting(function ($store) {// before delete() method call this
//
//            //get the store categories
//            $categories = $store->Categories;
//            foreach ($categories as $category) {
//                //get the attributes and it is belongs to category
//                $attributes = $category->Attributes;
//                foreach ($attributes as $attribute) {
//                    //delete the parameters and it is belongs to attribute
//                    $attribute->Parameters()->delete();
//                }
//                //delete the attributes and products for category
//                $category->Attributes()->delete();
//                $category->Products()->delete();
//            }
//
//            //delete a specific categories are belongs to store
//            $store->Categories()->delete();
//
//            //delete a specific Products are belongs to store
//            $store->Products()->delete();
//
//            // do the rest of the cleanup...
//        });
//    }

}

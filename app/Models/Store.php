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

    public function Categories()
    {
        return $this->hasMany(Category::class, 'store_id', 'id');
    }

    public function Products()
    {
        return $this->hasMany(Product::class, 'store_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}

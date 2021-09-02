<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'name',
    ];

    protected $hidden = [];


    ########################### The Relation for Category ###############################

    public function Store()
    {
        return $this->belongsTo(store::class, 'store_id', 'id');
    }

    public function Attributes()
    {
        return $this->hasMany(Attribute::class, 'category_id', 'id');
    }

    public function Products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
    
}

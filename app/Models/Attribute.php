<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'attributes';

    protected $fillable = [
        'name', 'category_id', 'is_required',
    ];

    protected $hidden = [];

    ########################### The Relation for Attribute ###############################

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function Parameters()
    {
        return $this->hasMany(Parameter::class, 'attribute_id', 'id');
    }

}

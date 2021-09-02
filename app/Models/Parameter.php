<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parameter extends Model
{
    use HasFactory, softDeletes;


    protected $table = 'parameters';

    protected $fillable = [
        'name', 'attribute_id',
    ];

    protected $hidden = [];

    ########################### The Relation for Parameter ###############################

    public function Attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id', 'id');
    }

}

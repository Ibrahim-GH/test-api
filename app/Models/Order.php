<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

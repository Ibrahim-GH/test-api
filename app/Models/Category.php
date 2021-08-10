<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
    ];

    protected $hidden = [];


    //the Category has many Attribute and Attribute belong to one Category
    public function Attributes()
    {
        return $this->hasMany(Attribute::class, 'category_id', 'id');
    }

    ########################### The Relation for Category ###############################

//     //the user has many posts and post belong to one user
//     public function user()
//     {
//         return $this->belongsTo(User::class, 'user_id', 'id');
//     }

//     //the post has many comment and comment belong to one post
//     public function comments()
//     {
//         return $this->hasMany(Comment::class, 'post_id', 'id');
//     }

//     //the post has many like and like belong to one post
//     public function likes()
//     {
//         return $this->hasMany(Like::class, 'post_id', 'id');
//     }


}

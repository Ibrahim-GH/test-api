<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   
    protected $table = 'categories';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];


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
// }

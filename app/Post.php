<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','desc','like','dislike','user_id'];



    //user for post
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //users for faviorite_post
    public function users()
    {
        return $this->belongsToMany(User::class,'favorite_post');
    }

    public function comments(){
        return $this->hasMany(Comment::class)->orderBy('created_at','DESC');
    }
}

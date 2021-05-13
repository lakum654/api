<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    
    protected $fillable = ['title','desc'];

    //One To Many Pholymorphic
    public function comments()
    {
        return $this->morphMany(BothComment::class, 'commentable');
    }
}

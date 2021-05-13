<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title','desc'];


    public function comments()
    {
        return $this->morphMany(BothComment::class, 'commentable');
    }
}

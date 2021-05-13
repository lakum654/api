<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BothComment extends Model
{
    protected $fillable = ['comment'];


    public function commentable()
    {
        return $this->morphTo();
    }
}

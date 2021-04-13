<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id','post_id','comment'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reply(){
        return $this->hasMany(Reply::class)->orderBy('created_at','DESC');
    }
}

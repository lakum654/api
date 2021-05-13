<?php

namespace App\Relationships;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id','name','amount'];


    public function category(){
        return $this->belongsTo(Category::class);
    }
}

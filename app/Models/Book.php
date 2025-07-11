<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        "title",
        "description",
        "available"
    ];

    public function category(){
        return $this->belongTo(Category::class);
    }
}

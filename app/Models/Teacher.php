<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    function comments(){
        return $this->morphMany(Comment::class, "commentable");
    }


    function user(){
      return   $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    function comments(){
        return $this->morphMany(Comment::class, "commentable");
    }
}

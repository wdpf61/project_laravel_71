<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    function comments(){
        return $this->morphMany(Comment::class, "commentable");
    }

    function course(){
      return $this->hasMany(Course::class);
    }


    function user(){
      return  $this->belongsTo(User::class);
    }

    function students(){
        return $this->hasManyThrough(Student::class, Course::class,"teacher_id","id","id","id");
    }
}

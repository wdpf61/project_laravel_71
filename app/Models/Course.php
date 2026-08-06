<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

  function students(){
     return $this->belongsToMany(Student::class);
  }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    function latestActivity()
    {
        return $this->morphOne(ActivityLog::class, "loggable")->latestOfMany();
    }
}

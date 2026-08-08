<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Hash;

class User extends Model
{
   use HasFactory;

   protected $fillable = [
      'name','email','password', 'role_id','status'
   ];


//accessor   
   protected function name():Attribute{
      return Attribute::make(
         get:function($value){
           return strtolower($value);
         }
      );
   }

  protected function nameEmail():Attribute{
      return Attribute::make(
         get:function($value, $attributes){
           return "{$attributes['name']}|{$attributes['email']}" ;
         }
      );
   }

//mutator
 protected function password():Attribute{
    return Attribute::make(
      set:fn($value)=> Hash::make($value)
    );
 }
// 

// scope

 public function scopeActive(Builder $query, $status="active"){
   return $query->where("status", "=", "$status");
 }

   

   function profile(){
      // return $this->hasOne(Profile::class,"user_id", "id");
      return $this->hasOne(Profile::class);
   } 

   function role(){
      return $this->belongsTo(Role::class);
   }



   // function profile(){
   //    return $this->hasOne(Profile::class);
   // }

   function latestActivity(){
       return $this->morphOne(ActivityLog::class, "loggable")->latestOfMany();
   }


}

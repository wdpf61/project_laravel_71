<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index()
    {
    //    egar loading
       $users= User::with('profile')->Active("inactive")->paginate(5);

       
    //    foreach($users as $user){
    //       echo "<pre>";
    //       print_r($user->profile?->bio);        //lazy loading
    //       echo "</pre>";
    //    }

    // return response()->json($users, 200, [], JSON_PRETTY_PRINT);
    // return  view("users.index", compact("users"));


    //  one to one relation 
    //    $profile= Profile::with("user")->get();
    //  dd($profile->toArray());


      //  one to many relation 
    //     $roles= Role::with('users')->find(4);
    //    return response()->json($roles, 200, [], JSON_PRETTY_PRINT);

    //    $user= User::with('role')->find(7);
    //    return response()->json($user, 200, [], JSON_PRETTY_PRINT);
    


    // many to many relation 
    //    $course= Course::with(["teacher", "teacher.user", "classroom", "subject", "students"])->find(1);
    //    //    dd($roles->toArray());
    //    return response()->json($course, 200, [], JSON_PRETTY_PRINT);

    //    $course= Student::with(["courses", "courses.subject", "courses.teacher.user", "courses.classroom"])->find(1);
    //    //    dd($roles->toArray());
    //    return response()->json($course, 200, [], JSON_PRETTY_PRINT);

    }

    function create()
    {
        // User::factory(5)->create();
        // dd("done");
    }
    function save()
    {
        echo " this is user save function";
    }
    function edit($id)
    {
        echo " this is user edit function $id";
    }
    function show($id)
    {
        echo " this is user edit function $id";
    }
    function update()
    {
        echo " this is user update function";
    }
    function delete()
    {
        echo " this is user delete function";
    }
}

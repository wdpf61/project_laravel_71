<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function index()
    {
        echo " this is user index function";
    }

    function create()
    {
        echo " this is user create function";
    }
    function save()
    {
        echo " this is user save function";
    }
    function edit($id)
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

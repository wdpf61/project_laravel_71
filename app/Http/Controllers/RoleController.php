<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $roles= Role::paginate(10);
       return view("roles.index", compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view("roles.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = new Role();
        $role->name= $request->name;
        $role->save();
        return redirect("/roles")->with("success", "Role has been saved successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role= Role::find($id);
        return view("roles.show", compact("role"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role= Role::find($id);
        return view("roles.edit", compact("role"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role= Role::find($id);
        $role->name= $request->name;
        $role->update();
        return redirect("/roles")->with("success", "Role has been updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::find($id)->delete();
        return redirect("/roles")->with("success", "Role has been delete successfully");
    }
    public function test()
    {
        echo "this is test method";
    }
}

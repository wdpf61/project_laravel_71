<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search= $request->input("search");
        $students = Student::query()
        ->when( $search, function($query, $search){
            $query->where(function($q)use($search){
               $q->where("id", "=","$search")
               ->orWhere('name', "like","%{$search}%")
               ->orWhere('email', "like","%{$search}%")
               ->orWhere('batch', "like","%{$search}%")
               ->orWhere('phone', "like","%{$search}%");
            });
        })
        ->paginate(10)
        ->withQueryString();
        return view("students.index", compact("students","search"));
    }


 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */


   public function deletedStudents(Request $request)
    {
        $search= $request->input("search");
        $students = Student::query()
        ->when( $search, function($query, $search){
            $query->where(function($q)use($search){
               $q->where("id", "=","$search")
               ->orWhere('name', "like","%{$search}%")
               ->orWhere('email', "like","%{$search}%")
               ->orWhere('batch', "like","%{$search}%")
               ->orWhere('phone', "like","%{$search}%");
            });
        })
        ->onlyTrashed()
        ->paginate(10)
        ->withQueryString();
        return view("students.deleted", compact("students","search"));
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->back()->with("success", "Student deleted successfully");
    }
    public function forceDelete($id)
    {
        $student = Student::withTrashed()->find($id); 
        $student->forceDelete(); 
        return redirect()->back()->with("success", "Student deleted successfully");
    }
    public function restore($id)
    {
        
        $student = Student::withTrashed()->find($id);  
        $student->restore();  
        return redirect("/students/deleted")->with("success", "Student restored successfully");
    }
}

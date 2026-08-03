<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input("search");
        $students = Student::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where("id", "=", "$search")
                        ->orWhere('name', "like", "%{$search}%")
                        ->orWhere('email', "like", "%{$search}%")
                        ->orWhere('batch', "like", "%{$search}%")
                        ->orWhere('phone', "like", "%{$search}%");
                });
            })
            ->paginate(10)
            ->withQueryString();
        return view("students.index", compact("students", "search"));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("students.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:students,email",
            "phone" => "required",
            "photo" => "required|image|mimes:png,jpg,jpeg|max:5000",
            "status" => "required",
            "batch" => "required"
        ],[
            "name.required"=>"kjfksdjfksdjfksdjfkjsd"
        ]);

        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->status = $request->status;
        if ($request->has("photo")) {
            $photo = $request->file("photo");
            $photo_name = $request->name . time() .".". $photo->getClientOriginalExtension();
            $photo->move(public_path("uploads"), $photo_name);
            $student->photo = $photo_name;
        }
        $student->save();

  

        return redirect("/students/")->with("success", "Student created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view("students.show", compact("student"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view("students.edit", compact("student"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student) {

    
    }

    /**
     * Remove the specified resource from storage.
     */


    public function deletedStudents(Request $request)
    {
        $search = $request->input("search");
        $students = Student::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where("id", "=", "$search")
                        ->orWhere('name', "like", "%{$search}%")
                        ->orWhere('email', "like", "%{$search}%")
                        ->orWhere('batch', "like", "%{$search}%")
                        ->orWhere('phone', "like", "%{$search}%");
                });
            })
            ->onlyTrashed()
            ->paginate(10)
            ->withQueryString();
        return view("students.deleted", compact("students", "search"));
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

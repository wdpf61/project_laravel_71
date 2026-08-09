<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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


        // $students= Student::with(['user:id,name', 'courses.subject', 'courses.teacher', 'courses.classroom','user.latestActivity','results', 'courses.subject.comments'])->get();
        // dd($students->toArray());


    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();
        return view("students.create", compact("subjects"));
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
            "batch" => "required",
            "bio" => "nullable",
            'subject_ids' => 'nullable|array',
            'subject_ids.*' => 'nullable|exists:subjects,id',
        ], [
            "name.required" => "Please gime a Student Name"
        ]);

        DB::transaction(function () use ($request) {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => 12345,
                'status' => 'active',
            ]);

            Profile::create([
                "user_id" => $user->id,
                'phone' => $request->phone,
                'bio' => $request->bio,
                'address' => $request->address,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $student = new Student();
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->status = $request->status;
            $student->batch = $request->batch;
            $student->user_id = $user->id;
            if ($request->hasFile("photo")) {
                $photo = $request->file("photo");
                $photo_name = $request->name . time() . "." . $photo->getClientOriginalExtension();
                $photo->move(public_path("uploads"), $photo_name);
                $student->photo = $photo_name;
            }
            $student->save();

            $couseId = [];
            foreach ($request->subject_ids as $key => $id) {
                $couseId[] = $id;
            }

            $student->courses()->sync($couseId);
        });
        return redirect("/students/")->with("success", "Student created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $this->authorize("view", $student);
        return view("students.show", compact("student"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::with("courses", "user.profile")->findOrFail($id);
        $subjects = Subject::all();
        return view("students.edit", compact("student", "subjects"));
        //   return response()->json($student, 200, [], JSON_PRETTY_PRINT);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {


       $this->authorize("update", $student);
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "phone" => "required",
            "photo" => "nullable|image|mimes:png,jpg,jpeg|max:5000",
            "status" => "nullable",
            "batch" => "nullable",
            "bio" => "nullable",
            'subject_ids' => 'nullable|array',
            'subject_ids.*' => 'nullable|exists:subjects,id',
        ], [
            "name.required" => "Please gime a Student Name"
        ]);


        // dd($request->subject_ids);


        DB::transaction(function () use ($request, $student) {
            $user = User::findOrFail($student->user_id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => 12345,
                'status' => 'active',
            ]);

            $profile = Profile::where("user_id", $user->id);  // primary key find   // another column where 
            $profile->update([
                'phone' => $request->phone,
                'bio' => $request->bio,
                'address' => $request->address,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

          
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->status = $request->status;
            $student->batch = $request->batch;
            $student->user_id = $user->id;
            if ($request->hasFile("photo")) {
                $photo = $request->file("photo");
                $photo_name = $request->name . time() . "." . $photo->getClientOriginalExtension();
                $photo->move(public_path("uploads"), $photo_name);
                $student->photo = $photo_name;
            }
            $student->update();

            $courseIds = [];
            foreach ($request->subject_ids as $key => $id) {
                $courseIds[$id] = ['enrolled_at' => now()];
            }
            $student->courses()->sync($courseIds, true);
        });
        return redirect("/students/")->with("success", "Student update successfully");
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

        $image = public_path('uploads/' . $student->photo);
        if (File::exists($image)) {
            File::delete($image);
        }

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

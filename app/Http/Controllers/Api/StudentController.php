<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return response()->json([
            "success" => true,
            "data" => $students
        ], 200);
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
        ], [
            "name.required" => "Please gime a Student Name"
        ]);

        try {
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
          
            return response()->json(["success" => true, "data" => $student ], 201);
        });
        } catch (\Throwable $th) {
            return response()->json(["success" => false, "error" => $th->getMessage() ], 500);
        }

        //   return response()->json(["success" => false, "data" => $request->all() ], 500);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $student = Student::findOrFail($id);
        return response()->json([
            "success" => true,
            "data" => $student
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $request->validate([
            "name" => "nullable",
            "email" => "nullable|email",
            "phone" => "nullable",
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
        $student = Student::find($id);
        try {
          
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

             return response()->json(["success" => true, "data" => $student ], 202);
        });
   
        } catch (\Throwable $th) {
            return response()->json(["success" => false, "error" => $th->getMessage() ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
         $student->delete();
         return response()->json(["success" => true, "data" => "student has been deleted" ], 204);
    }
}

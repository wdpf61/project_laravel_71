<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $subjects= Subject::all();
       return view("topic.index", compact("subjects"));
    }


    public function subject_chapter($id)
    {
      
       $chapter = Chapter::where("subject_id", $id)->get();

       return response()->json([
            "success" => true,
            "data" => $chapter
        ], 200);
    }
    public function chapter_topic($id)
    {
      
       $chapter = Topic::where("chapter_id", $id)->get();

       return response()->json([
            "success" => true,
            "data" => $chapter
        ], 200);
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
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        //
    }
}

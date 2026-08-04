@extends('layouts.backend.app')

@section("content")
 
 <div class="card">
     <div class="card-header">
        <h4>Edit Student</h4>
     </div>
    <div class="card-body">


    <form action="{{ route('students.update',  $student->id) }}" method="post">

        @csrf
        @method("PUT")

          @include('students._form')

            <input type="submit" name="btn_submit">
        </div>
    </form>
    </div>
 </div>

@endsection

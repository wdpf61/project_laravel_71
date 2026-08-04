@extends('layouts.backend.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Create Student</h4>
        </div>
        <div class="card-body">
            
            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                @include('students._form')

                <button class="btn btn-primary">
                    Save Student
                </button>

            </form>
        </div>
    </div>
@endsection

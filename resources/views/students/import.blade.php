@extends('layouts.backend.app')

@section('title', 'Student page')
@section('content')

    @if (session('success'))
        <div class="alert alert-success"> {{ session('success') }}</div>
    @endif

    <form action="{{ url('/students/import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 from-group">

            <label>Student File</label>
            <input type="file" name="file" placeholder="filename.xlsx"
                class="form-control @error('file') is-invalid @enderror">

            @error('file')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>
        <button class="btn btn-primary">
            Save Student
        </button>
    </form>
@endsection

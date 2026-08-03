@extends('layouts.backend.app')

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="mb-3">

                    <label for="name">Name</label>

                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label>Phone</label>

                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="form-control @error('phone') is-invalid @enderror">

                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label>Email</label>

                    <input type="email" name="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror">

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label>Batch</label>

                    <input type="text" name="batch" value="{{ old('batch') }}"
                        class="form-control @error('batch') is-invalid @enderror">

                    @error('batch')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label>Photo</label>

                    <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">

                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label>Status</label>

                    <select name="status" class="form-select">

                        <option value="1">Active</option>

                        <option value="0">Inactive</option>

                    </select>

                </div>

                <button class="btn btn-primary">
                    Save Student
                </button>

            </form>
        </div>
    </div>
@endsection

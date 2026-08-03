@extends('layouts.backend.app')

@section('title', 'Student page')
@section('content')

    @if (session('success'))
        <div class="alert alert-success"> {{ session('success') }}</div>
    @endif
    <div class="d-flex justify-content-between mb-3">
        <h3>Student List</h3>
        <a class="btn btn-success " href="{{ route('students.create') }}">Create Student</a>
    </div>
    <form class="input-group mb-3" action="{{route("students.index")}}" method="get">
        <input value="{{old("search", $search)}}" id="select-field" type="text" name="search" class="form-control" placeholder="search student..." >
        <button class="btn btn-outline-secondary" type="submit" id="button">Button</button>
       
        @if(request('search'))
            <a href="{{ route('students.index') }}" class="btn btn-outline-info">
                Clear
            </a>
        @endif
    </form>
    <table class="table table-striped border">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Photo</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as  $key=> $student)
                <tr>
                    <td> {{ $student->id }} </td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->email }}</td>
                    <td>  <img width="100"  src="{{asset("")}}/uploads/{{$student->photo }}" alt="{{$student->name}}" srcset=""> </td>
                    <td class="btn-group">
                        <a class="btn btn-info" href="{{ route('students.show', $student->id) }}">Show</a>
                        <a class="btn btn-secondary" href="{{ route('students.edit', $student->id) }}">Edit</a>

                        <form action="{{ route('students.destroy', $student->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" onclick="confirm('are you sure')">Delete</button>
                        </form>



                    </td>
                </tr>
            @endforeach
        </tbody>



    </table>

    <div class="d-flex justify-content-end">
        {{ $students->links() }}
    </div>
@endsection

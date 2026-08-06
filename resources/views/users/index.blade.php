@extends('layouts.backend.app')

@section('title', 'user page')
@section('content')

    @if (session('success'))
        <div class="alert alert-success"> {{ session('success') }}</div>
    @endif
    <div class="d-flex justify-content-between mb-3">
        <h3>user List</h3>
        <a class="btn btn-success " href="{{ route('users.create') }}">Create user</a>
    </div>

    <form class="input-group mb-3" action="{{route("users.index")}}" method="get">
        <input id="select-field" type="text" name="search" class="form-control" placeholder="search user..." >
        <button class="btn btn-outline-secondary" type="submit" id="button">Button</button>
       
        @if(request('search'))
            <a href="{{ route('users.index') }}" class="btn btn-outline-info">
                Clear
            </a>
        @endif
    </form>
    <table class="table table-striped border">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>email</th>
                <th>boi</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as  $key=> $user)
                <tr>
                    <td> {{ $user->id }} </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->profile?->bio }}</td>
                    <td class="btn-group">
                        <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">Show</a>
                        <a class="btn btn-secondary" href="{{ route('users.edit', $user->id) }}">Edit</a>

                        <form action="{{ route('users.destroy', $user->id) }}" method="post">
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
        {{ $users->links() }}
    </div>
@endsection

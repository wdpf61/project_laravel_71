@extends('layouts.backend.app')

@section('title', 'Role page')
@section('content')

    @if (session('success'))
        <div class="alert alert-success"> {{ session('success') }}</div>
    @endif
    <div class="d-flex justify-content-between mb-3">
        <h3>Role List</h3>
        <a class="btn btn-success " href="{{ route('roles.create') }}">Create Role</a>
    </div>

    <form class="input-group mb-3" action="" method="post">
        @csrf
        <input type="text" class="form-control" placeholder="search role..." >
        <button class="btn btn-outline-secondary" type="submit" id="button">Button</button>
    </form>
    <table class="table table-striped border">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>description</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td> {{ $role->id }} </td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->description }}</td>
                    <td class="btn-group">
                        <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}">Show</a>
                        <a class="btn btn-secondary" href="{{ route('roles.edit', $role->id) }}">Edit</a>

                        <form action="{{ route('roles.destroy', $role->id) }}" method="post">
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
        {{ $roles->links() }}
    </div>
@endsection

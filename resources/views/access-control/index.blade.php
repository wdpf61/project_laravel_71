@extends('layouts.backend.app')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Role & Permission Management
            </h2>

            <p class="text-muted mb-0">
                Manage roles, permissions and user access
            </p>
        </div>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <strong>Please fix the following:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Navigation --}}
    <ul class="nav nav-tabs mb-4" id="accessTab">

        <li class="nav-item">

            <button
                class="nav-link active"
                data-bs-toggle="tab"
                data-bs-target="#roles">

                <i class="bi bi-shield-check me-1"></i>
                Roles

            </button>

        </li>


        <li class="nav-item">

            <button
                class="nav-link"
                data-bs-toggle="tab"
                data-bs-target="#permissions">

                <i class="bi bi-key me-1"></i>
                Permissions

            </button>

        </li>


        <li class="nav-item">

            <button
                class="nav-link"
                data-bs-toggle="tab"
                data-bs-target="#assign-role">

                <i class="bi bi-person-badge me-1"></i>
                Assign Role

            </button>

        </li>


        <li class="nav-item">

            <button
                class="nav-link"
                data-bs-toggle="tab"
                data-bs-target="#assign-user-permission">

                <i class="bi bi-person-check me-1"></i>
                User Permission

            </button>

        </li>


        <li class="nav-item">

            <button
                class="nav-link"
                data-bs-toggle="tab"
                data-bs-target="#role-permission">

                <i class="bi bi-diagram-3 me-1"></i>
                Role Permissions

            </button>

        </li>

    </ul>


    <div class="tab-content">


        {{-- ================================================= --}}
        {{-- ROLES --}}
        {{-- ================================================= --}}

        <div class="tab-pane fade show active" id="roles">

            <div class="card shadow-sm">

                <div class="card-header bg-white">

                    <div class="d-flex justify-content-between">

                        <h5 class="mb-0">
                            Roles
                        </h5>

                        <span class="badge bg-primary">
                            {{ $roles->count() }} Roles
                        </span>

                    </div>

                </div>


                <div class="card-body">

                    <form
                        action="{{ route('access.roles.store') }}"
                        method="POST"
                        class="row g-3 mb-4">

                        @csrf

                        <div class="col-md-8">

                            <label class="form-label">
                                Role Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Example: Teacher"
                                required>

                        </div>


                        <div class="col-md-4 d-flex align-items-end">

                            <button class="btn btn-primary w-100">

                                <i class="bi bi-plus-circle me-1"></i>

                                Add Role

                            </button>

                        </div>

                    </form>


                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead class="table-light">

                                <tr>

                                    <th>#</th>

                                    <th>Role</th>

                                    <th>Guard</th>

                                    <th>Permissions</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($roles as $role)

                                    <tr>

                                        <td>
                                            {{ $loop->iteration }}
                                        </td>

                                        <td>
                                            <span class="badge bg-primary">
                                                {{ $role->name }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $role->guard_name }}
                                        </td>

                                        <td>

                                            @foreach($role->permissions as $permission)

                                                <span class="badge bg-light text-dark border me-1">

                                                    {{ $permission->name }}

                                                </span>

                                            @endforeach

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- PERMISSIONS --}}
        {{-- ================================================= --}}

        <div class="tab-pane fade" id="permissions">

            <div class="card shadow-sm">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Permissions
                    </h5>

                </div>


                <div class="card-body">

                    <form
                        action="{{ route('access.permissions.store') }}"
                        method="POST"
                        class="row g-3 mb-4">

                        @csrf

                        <div class="col-md-8">

                            <label class="form-label">
                                Permission Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Example: view-students"
                                required>

                        </div>


                        <div class="col-md-4 d-flex align-items-end">

                            <button class="btn btn-success w-100">

                                <i class="bi bi-plus-circle me-1"></i>

                                Add Permission

                            </button>

                        </div>

                    </form>


                    <div class="row">

                        @foreach($permissions as $permission)

                            <div class="col-md-4 mb-3">

                                <div class="border rounded p-3">

                                    <i class="bi bi-key text-warning me-2"></i>

                                    {{ $permission->name }}

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- ASSIGN ROLE TO USER --}}
        {{-- ================================================= --}}

        <div class="tab-pane fade" id="assign-role">

            <div class="card shadow-sm">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Assign Role to User
                    </h5>

                </div>


                <div class="card-body">

                    <form
                        action="{{ route('access.users.role') }}"
                        method="POST">

                        @csrf

                        <div class="row g-3">

                            <div class="col-md-5">

                                <label class="form-label">
                                    Select User
                                </label>

                                <select
                                    name="user_id"
                                    class="form-select"
                                    required>

                                    <option value="">
                                        -- Select User --
                                    </option>

                                    @foreach($users as $user)

                                        <option value="{{ $user->id }}">

                                            {{ $user->name }}

                                            -
                                            {{ $user->email }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            <div class="col-md-5">

                                <label class="form-label">
                                    Select Role
                                </label>

                                <select
                                    name="role"
                                    class="form-select"
                                    required>

                                    <option value="">
                                        -- Select Role --
                                    </option>

                                    @foreach($roles as $role)

                                        <option value="{{ $role->name }}">

                                            {{ $role->name }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            <div class="col-md-2 d-flex align-items-end">

                                <button class="btn btn-primary w-100">

                                    Assign

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>


            {{-- Current User Roles --}}

            <div class="card shadow-sm mt-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Current User Roles
                    </h5>

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-hover">

                            <thead>

                                <tr>
                                    <th>User</th>
                                    <th>Roles</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach($users as $user)

                                    <tr>

                                        <td>

                                            <strong>
                                                {{ $user->name }}
                                            </strong>

                                            <br>

                                            <small class="text-muted">
                                                {{ $user->email }}
                                            </small>

                                        </td>


                                        <td>

                                            @forelse($user->roles as $role)

                                                <span class="badge bg-primary me-1">

                                                    {{ $role->name }}

                                                </span>

                                            @empty

                                                <span class="text-muted">
                                                    No role
                                                </span>

                                            @endforelse

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- DIRECT USER PERMISSION --}}
        {{-- ================================================= --}}

        <div class="tab-pane fade" id="assign-user-permission">

            <div class="card shadow-sm">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Assign Permission Directly to User
                    </h5>

                </div>


                <div class="card-body">

                    <div class="alert alert-info">

                        This permission will be assigned directly
                        to the user and does not come from a role.

                    </div>


                    <form
                        action="{{ route('access.users.permission') }}"
                        method="POST">

                        @csrf

                        <div class="row g-3">

                            <div class="col-md-5">

                                <label class="form-label">
                                    User
                                </label>

                                <select
                                    name="user_id"
                                    class="form-select"
                                    required>

                                    <option value="">
                                        -- Select User --
                                    </option>

                                    @foreach($users as $user)

                                        <option value="{{ $user->id }}">

                                            {{ $user->name }}
                                            -
                                            {{ $user->email }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            <div class="col-md-5">

                                <label class="form-label">
                                    Permission
                                </label>

                                <select
                                    name="permission"
                                    class="form-select"
                                    required>

                                    <option value="">
                                        -- Select Permission --
                                    </option>

                                    @foreach($permissions as $permission)

                                        <option value="{{ $permission->name }}">

                                            {{ $permission->name }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            <div class="col-md-2 d-flex align-items-end">

                                <button class="btn btn-success w-100">

                                    Assign

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>


            {{-- Direct Permissions --}}

            <div class="card shadow-sm mt-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Direct User Permissions
                    </h5>

                </div>


                <div class="card-body">

                    <table class="table table-hover">

                        <thead>

                            <tr>

                                <th>User</th>

                                <th>Direct Permissions</th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($users as $user)

                                <tr>

                                    <td>
                                        {{ $user->name }}
                                    </td>

                                    <td>

                                        @forelse($user->permissions as $permission)

                                            <span class="badge bg-success me-1">

                                                {{ $permission->name }}

                                            </span>

                                        @empty

                                            <span class="text-muted">
                                                No direct permission
                                            </span>

                                        @endforelse

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- ROLE PERMISSIONS --}}
        {{-- ================================================= --}}

        <div class="tab-pane fade" id="role-permission">

            <div class="card shadow-sm">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Assign Permissions to Role
                    </h5>

                </div>


                <div class="card-body">

                    <form
                        action="{{ route('access.roles.permissions') }}"
                        method="POST">

                        @csrf


                        <div class="mb-4">

                            <label class="form-label fw-bold">
                                Select Role
                            </label>

                            <select
                                name="role_id"
                                class="form-select"
                                required>

                                <option value="">
                                    -- Select Role --
                                </option>

                                @foreach($roles as $role)

                                    <option value="{{ $role->id }}">

                                        {{ $role->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <label class="form-label fw-bold">
                            Select Permissions
                        </label>


                        <div class="row border rounded p-3">

                            @foreach($permissions as $permission)

                                <div class="col-md-4 mb-3">

                                    <div class="form-check">

                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="permissions[]"
                                            value="{{ $permission->id }}"
                                            id="permission{{ $permission->id }}">


                                        <label
                                            class="form-check-label"
                                            for="permission{{ $permission->id }}">

                                            {{ $permission->name }}

                                        </label>

                                    </div>

                                </div>

                            @endforeach

                        </div>


                        <div class="mt-4">

                            <button class="btn btn-primary">

                                <i class="bi bi-save me-1"></i>

                                Save Role Permissions

                            </button>

                        </div>

                    </form>

                </div>

            </div>


            {{-- Role Permission List --}}

            <div class="card shadow-sm mt-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Current Role Permissions
                    </h5>

                </div>


                <div class="card-body">

                    @foreach($roles as $role)

                        <div class="border rounded p-3 mb-3">

                            <div class="mb-2">

                                <span class="badge bg-primary fs-6">

                                    {{ $role->name }}

                                </span>

                            </div>


                            @forelse($role->permissions as $permission)

                                <span class="badge bg-light text-dark border me-1 mb-1">

                                    {{ $permission->name }}

                                </span>

                            @empty

                                <span class="text-muted">

                                    No permissions assigned.

                                </span>

                            @endforelse

                        </div>

                    @endforeach

                </div>

            </div>

        </div>


    </div>

</div>

@endsection
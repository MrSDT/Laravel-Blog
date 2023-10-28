@extends('admin.main')

@section('title')
    Edit User
@endsection

@section('content')


    <div class="row g-4">
        <div class="col-sm-12 p-5">

            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Basic Form</h6>
                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="createusername" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"> <!-- Add name attribute -->
                    </div>

                    <div class="mb-3">
                        <label for="createuseremail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"> <!-- Add name attribute -->
                    </div>


                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role">
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create User</button>
                </form>

            </div>
        </div>
    </div>











@endsection

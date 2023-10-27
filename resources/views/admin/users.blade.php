@extends('admin.main')

@section('title')
    Users
@endsection

@section('content')

    <div class="col-12 p-4">
        <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">Responsive Table</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Account Creation</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $userslist)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{$userslist->name}}</td>
                        <td>{{$userslist->email}}</td>
                        <td>{{$userslist->created_at}}</td>
                    @foreach($userslist->roles as $role)
                        <td>{{ucfirst($role->name)}}</td>
                        @endforeach
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Edit User</a></li>
                                    <form id="delete-frm" class="" action="{{ route('users.destroy', $user) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger">Delete User</button>

                                    </form>

                                </ul>
                            </div>






                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

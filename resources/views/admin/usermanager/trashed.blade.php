@extends('admin.main')

@section('title')
    Restore User
@endsection

@section('content')

    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($trashedUsers as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('users.restore', $user->id) }}" class="btn btn-warning">Restore User</a>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>

@endsection

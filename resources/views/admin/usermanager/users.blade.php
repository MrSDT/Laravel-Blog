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
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Account Creation</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    @foreach($user->roles as $role)
                        <td>{{ ucfirst($role->name) }}</td>
                    @endforeach
                    <td>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu">
                                <a href="{{ route('users.edit', ['user' => $user]) }}" class="btn btn-primary">Edit</a>
                                <li>
                                    <form id="delete-frm-{{ $user->id }}" class="" action="{{ route('users.destroy', $user) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger" type="button" onclick="confirmDelete({{ $user->id }})">Delete User</button>
                                    </form>
                                </li>
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

@section('scripts')
    <script>
        function confirmDelete(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Construct the form ID based on the user's ID
                    const formId = `delete-frm-${userId}`;

                    // Submit the form with the constructed ID
                    document.getElementById(formId).submit();
                }
            });
        }

        @if (session('success'))
        Swal.fire({
            title: 'Success',
            text: "{{ session('success') }}",
            icon: 'success',
        });
        @endif
    </script>

@endsection


@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.adminmenu')
                <a class="btn btn-primary" href="{{ route('users_add') }}">Add User</a>

                <h3>Users</h3>

                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Is Banned</th>
                        <th scope="col">Actions</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $users as $user )
                        <tr>
                            <th scope="row">{{ $user->id  }}</th>
                            <td>{{ $user->email }}</td>
                            <td>{{ ($user->role == 1 ? "Admin" : "Customer") }}</td>
                            <td>{{ ($user->blocked == 1) ? "Yes" : "No" }}</td>
                            <td>
                                <a href="/users/edit/{{ $user->id  }}" class="btn">Edit</a>
                                <a href="/users/delete/{{ $user->id  }}" class="btn btn-primary">Delete</a>
                                <a href="/users/block/{{ $user->id  }}" class="btn btn-primary">{{ ($user->blocked == 1) ? "Remove Ban" : "Ban" }}</a>
                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
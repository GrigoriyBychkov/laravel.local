@extends('layouts.app')

@section('content')

        <h3>Users</h3>

        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">email</th>
                <th scope="col">role</th>
                <th scope="col">actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $users as $user )
            <tr>
                <th scope="row">{{ $user->id  }}</th>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="/users/edit/{{ $user->id  }}" class="btn">Edit</a>
                    <a href="/users/makeadmin/{{ $user->id  }}" class="btn">Make Admin</a>
                    <a href="/users/delete/{{ $user->id  }}" class="btn">Delete</a>
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
@endsection
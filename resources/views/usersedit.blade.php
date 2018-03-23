@extends('layouts.app')

@section('content')
    <h3>Edit User</h3>
    <form method="post" action="">
        {{ csrf_field() }}
        {{ method_field('patch') }}

        <input type="text" name="name"  value="{{ $user->name }}" />

        <input type="email" name="email"  value="{{ $user->email }}" />

        <input type="password" name="password" placeholder="password"/>

        <input type="password" name="password_confirmation" placeholder="repeat password" />

        <button type="submit">Send</button>
    </form>


@endsection
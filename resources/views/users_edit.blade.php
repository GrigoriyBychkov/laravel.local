@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.adminmenu')

                <div class="panel panel-default">
                    <h3>Edit User</h3>

                    <form method="patch" action="">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="email"
                                   aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <div class="form-group">
                            <label for="name">User name</label>
                            <input type="text" name="name" value="{{ $user->name }}" minlength="3" class="form-control"
                                   id="name" placeholder="Enter your name">
                        </div>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" name="role" id="role">
                                <option value="0" {{ $user->role == 0 ? 'selected' : '' }} >Customer</option>
                                <option value="1" {{ $user->role == 1 ? 'selected' : '' }} >Admin</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Password</label>
                            <input type="password" name="password" class="form-control" id="name"
                                   placeholder="Password">
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
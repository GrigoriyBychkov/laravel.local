@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <h3>Edit User</h3>

                    <form method="post" action="">
                        {{ csrf_field() }}
                        {{ method_field('post') }}
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

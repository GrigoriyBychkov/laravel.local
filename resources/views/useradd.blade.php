@extends ('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.adminmenu')

                <div class="panel panel-default">
                    <h3>Add User</h3>

                    <form method="post" action="">
                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" value="{{ old('email') }}"  class="form-control" id="email"
                                   aria-describedby="emailHelp" placeholder="Enter email" required>
                        </div>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <div class="form-group">
                            <label for="name">User name</label>
                            <input type="text" name="name" value="{{ old('name') }}"  minlength="3" class="form-control"
                                   id="name" placeholder="Enter your name" required>
                        </div>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" name="role" id="role">
                                <option value="0" >Customer</option>
                                <option value="1"  >Admin</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Password</label>
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="password"
                                   placeholder="Password" required>
                        </div>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                        <div class="form-group">
                            <label for="name">Repeat Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                                   placeholder="Password" required>
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
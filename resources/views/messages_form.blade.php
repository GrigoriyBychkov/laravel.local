@extends ('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.usermenu')

                <div class="panel panel-default">
                    <h3>Write message</h3>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{route('send_message_confirm')}}">
                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ $email }}" class="form-control" id="email"
                                   placeholder="Enter Email" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Enter Text Here</label>
                            <textarea class="form-control" name="message" id="message"
                                      rows="5">{{ old('body') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
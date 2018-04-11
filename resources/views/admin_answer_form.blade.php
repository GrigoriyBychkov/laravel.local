@extends ('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.adminmenu')

                <div class="panel panel-default">
                    <h3>Write Answer</h3>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{route('email_answer_send',['id'=>$message->id])}}">
                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        <div class="form-group">
                            <label for="email">Email</label>
                            <p>{{$message->email}}</p>
                        </div>
                        <div class="form-group">
                            <label for="text">Text </label>
                            <p>{{$message->message}}</p>
                        </div>
                        <div class="form-group">
                            <label for="answer">Enter Text Here</label>
                            <textarea class="form-control" name="answer" id="answer" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
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
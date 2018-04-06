@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('layouts.usermenu')


            <div class="panel panel-default">
                <div class="panel-heading">User Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in as User!
                </div>

                @foreach($news as $new)
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object" src="/newsImages/{{$new->img}}" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{$new->title}}</h4>
                        {{ substr($new->body, 0, 70)}} <a href="{{route('news_show_customer',['id'=>$new->id])}}">Read All</a><br>
                        Views :{{$new->views}}
                    </div>
                </div>
                    @endforeach
                {{$news->links()}}
            </div>
        </div>
    </div>
</div>
@endsection

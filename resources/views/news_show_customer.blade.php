@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="/newsImages/{{$news->img}}" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{$news->title}}</h4>
                            {{$news->body}} <br>
                            @foreach($news->attachments as $attachment)
                                <a href="/attachments/{{$attachment->attachment}}"> {{ $attachment->attachment }} </a>
                            @endforeach
                            Views :{{$news->views}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
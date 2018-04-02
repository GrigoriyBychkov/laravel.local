@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.adminmenu')
                <a class="btn btn-primary" href="{{ route('news.create') }}">Add News</a>
                <h3>News</h3>

                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">News</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $news as $new )
                        <tr>
                            <td scope="row">{{ $new->id  }}</td>
                            <td><img width="100" src="/newsImages/{{$new->img}}" alt=""></td>
                            <td><b>{{ $new->title }}</b>
                                <p>{{ $new->body }}</p>
                                <p>Views :{{$new->views}}</p>
                                @foreach($new->attachments as $attachment)
                                    <a href="/attachments/{{$attachment->attachment}}"> {{ $attachment->attachment }} </a>
                                    <br>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{route('news.edit',['id'=>$new->id])}}" class="btn">Edit</a>
                                <a href="{{route('news.show',['id'=>$new->id])}}" class="btn">Delete</a>
                                <a href="{{route('news_archive',['id'=>$new->id])}}"
                                   class="btn">{{ $new->active ==1 ? "Restore" : "Archive" }}</a>
                            </td>
                        </tr>
                    @endforeach
                    {{$news->links()}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
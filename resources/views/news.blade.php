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
                    @foreach( $news as $record )
                        <tr>
                            <td scope="row">{{ $record->id  }}</td>
                            <td><img width="100" src="/newsImages/{{$record->img}}" alt=""></td>
                            <td><b>{{ $record->title }}</b>
                                <p>{{ $record->body }}</p>
                                <p>Views :{{$record->views}}</p>
                                @foreach($record->attachment as $attachment)
                                    <a href="/attachments/{{$attachment->attachment}}"> {{ $attachment->attachment }} </a>
                                    <br>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{route('news.edit',['id'=>$record->id])}}" class="btn">Edit</a>
                                <a href="{{route('news.show',['id'=>$record->id])}}" class="btn">Delete</a>
                                <a href="{{route('news_archive',['id'=>$record->id])}}"
                                   class="btn">{{ $record->active ==1 ? "Restore" : "Archive" }}</a>
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
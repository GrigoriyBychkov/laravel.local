@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.adminmenu')
                <h3>Messages</h3>
                <a class="btn btn-primary" href="{{ route('notification_form') }}">Add Notification</a>

                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Email</th>
                        <th scope="col">Text</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $messages as $record )
                        <tr>
                            <td scope="row">{{ $record->id  }}</td>
                            <td scope="row">{{ $record->email  }}</td>
                            <td scope="row">{{$record->message}}</td>
                            <td scope="row"><a href="{{route('email_answer_form',['id'=>$record->id])}}">Answer</a><br>
                            </td>
                        </tr>
                    @endforeach
                    {{$messages->links()}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
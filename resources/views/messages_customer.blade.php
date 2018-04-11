@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.usermenu')
                <a class="btn btn-primary" href="{{ route('send_message') }}">Send Message</a>
                <h3>Messages</h3>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Text</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $messages as $record )
                        <tr>
                            <td scope="row">{{ $record->id  }}</td>
                            <td scope="row">{{$record->message}}</td>
                        </tr>
                    @endforeach
                    {{$messages->links()}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
    @include('layouts.adminmenu')
                <a class="btn btn-primary" href="{{ route('news_add') }}">Add News</a>

            </div>
        </div>
    </div>
@endsection
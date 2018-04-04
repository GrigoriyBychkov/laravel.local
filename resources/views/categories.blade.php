@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.adminmenu')
                <a class="btn btn-primary" href="{{ route('categories.create') }}">Add Category</a>
                <h3>Categories</h3>
                <ul>
                    @foreach( $categories as $record )
                        @if($record->category_id == null)
                            <li>
                                {{ $record->name }}   <a href="{{route('categories.edit',['id'=>$record->id])}}" class="btn">Edit</a>
                                @include('layouts.subcats', ['subCategories' => $record->subCategories])
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
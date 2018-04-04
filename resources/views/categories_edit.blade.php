@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
    @include('layouts.adminmenu')
                <form method="post" action="{{route('categories.update',['id'=>$category->id])}}" >
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
                    <div class="form-group">
                        <label for="name">name</label>
                        <input type="text" name="name" value="{{ $category->name }}" class="form-control" id="name"
                               placeholder="{{$category->name}}" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select class="form-control" name="category_id" id="category_id">
                            <option value="">Parent Category</option>

                            @foreach($categories as $record)
                                <option value="{{$record->id}}">{{$record->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
                <form method="POST" action="{{route('categories.destroy', ['id'=>$category->id])}}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <input type="submit" name='delete' class="btn btn-success" value = "Delete"/>
                </form>

            </div>
        </div>
    </div>
        @endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.adminmenu')

                <div class="panel panel-default">
                    <h3>Edit News</h3>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form method="post" action="{{route('product.update',['id'=>$product->id])}}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <div class="form-group">
                            <label for="body">Image</label>
                            <input type="file" name="input_img">
                        </div>
                        <div class="form-group">
                            <img class="media-object" src="/productImages/{{$product->img}}" alt="...">
                            <label for="title">Title</label>
                            <input type="text" name="name" value="{{ $product->name }}" class="form-control" id="name"
                                   placeholder="Enter Name">
                        </div>
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        <div class="form-group">
                            <label for="body">Description</label>
                            <textarea name="description" minlength="3" class="form-control"
                                      id="description">{{$product->description }}</textarea>
                        </div>
                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control" name="category_id" id="category_id">
                                <option value="">{{$product->category->name}}</option>
                                <option value="">Parent Category</option>


                                @foreach($categories as $record)
                                    <option value="{{$record->id}}">{{$record->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{route('product.destroy', ['id'=>$product->id])}}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" name='delete' class="btn btn-success" value="Delete"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
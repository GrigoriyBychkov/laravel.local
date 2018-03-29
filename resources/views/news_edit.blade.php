@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.adminmenu')

                <div class="panel panel-default">
                    <h3>Edit News</h3>


                    <form method="post" action="" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        <div class="form-group">
                            <label for="body">Image</label>
                            <input type="file" name = "input_img">
                        </div>
                        <div class="form-group">
                            <img class="media-object" src="/newsImages/{{$news->img}}" alt="...">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ $news->title }}" class="form-control" id="title"
                                    placeholder="Enter Title">
                        </div>
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                        <div class="form-group">
                            <label for="body">News Text</label>
                            <textarea  name="body" minlength="3" class="form-control"
                                      id="body" >{{ $news->body }}</textarea>
                        </div>
                        @if ($errors->has('body'))
                            <span class="help-block">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                        @endif

                        <div class="form-group">
                            <label for="role">Visible</label>
                            <select class="form-control" name="active" id="active">
                                <option value="0" {{ $news->active == 0 ? 'selected' : '' }} >Archive</option>
                                <option value="1" {{ $news->active == 1 ? 'selected' : '' }} >Active</option>
                            </select>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Attachment</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($news->attachments as $attachment)
                            <tr>
                                <td scope="row">{{ $attachment->id }}</td>
                                <td>
                                    <a href="/attachments/{{$attachment->attachment}}"> {{ $attachment->attachment }} </a><br>
                                </td>
                                <td>
                                    <a href="/admin/attachments/delete/{{  $attachment->id  }}" class="btn">Delete Attachment</a>
                                </td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="form-group">
                            <label for="body">Attachments</label>
                            <input type="file" multiple name="attachments[]">
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
                </div>
            </div>
        </div>
    </div>
@endsection
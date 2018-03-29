@extends ('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.adminmenu')

                <div class="panel panel-default">
                    <h3>Add News</h3>
                    <form method="post" action="" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ old('title') }}"  class="form-control" id="title"
                                   placeholder="Enter Title" required>
                        </div>

                        <div class="form-group">
                            <label for="body">Enter Text Here</label>
                            <textarea class="form-control" name="body" id="body" rows="5">{{ old('body') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="body">Image</label>
                            <input type="file" name = "input_img">
                        </div>
                        <div class="form-group">
                            <label for="body">Attachments</label>
                            <input type="file" multiple name="attachments[]">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
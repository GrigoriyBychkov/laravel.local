@extends ('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.adminmenu')

                <div class="panel panel-default">
                    <h3>Add News</h3>
                    <form method="post" action="">
                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ old('title') }}"  class="form-control" id="title"
                                   placeholder="Enter Title" required>
                        </div>

                        <div class="form-group">
                            <label for="News Text">Enter Text Here</label>
                            <textarea class="form-control" id="NextNews" rows="5"></textarea>
                        </div>



                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @endsection
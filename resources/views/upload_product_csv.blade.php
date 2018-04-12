@extends ('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.adminmenu')

                <div class="panel panel-default">
                    <h3>Add Product</h3>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{route('upload_product_csv_confirm')}}" >
                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class="form-group">
                            <label for="category_id">Choose Category</label>
                            <select class="form-control" name="category_id" id="category_id">
                                <option value="">Parent Category</option>

                                @foreach($categories as $record)
                                    <option value="{{$record->id}}">{{$record->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file">Upload file</label>
                            <input type="file" name="file">
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
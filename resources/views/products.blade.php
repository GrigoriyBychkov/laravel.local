@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.adminmenu')
                <a class="btn btn-primary" href="{{ route('product.create') }}">Add Products</a>
                <a class="btn btn-primary" href="{{route('upload_product_csv')}}">Upload product via .CSV</a>
                <h3>Products</h3>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Category</th>
                        <th scope="col"></th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $products as $record )
                        <tr>
                            <td scope="row">{{$record->category->name}}
                            </td>
                            <td><img width="100" src="/productImages/{{$record->img}}" alt=""></td>
                            <td><b>{{ $record->name }}</b>
                            </td>
                            <td>{{$record->description}}</td>
                            <td>{{$record->price}}</td>
                            <td>
                                <a href="{{route('product.edit',['id'=>$record->id])}}" class="btn">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
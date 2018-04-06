@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="/productImages/{{$product->img}}" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{$product->name}}</h4>
                            {{$product->description}} <br>
                            <h2>Price: {{$product->price}}</h2>


                            <form method="POST" action="{{route('product.order', ['id'=>$product->id])}}">
                                {{ method_field('POST') }}
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" min=1 max=10 name="quantity" class="form-control" id="quantity"
                                           placeholder="Quantity" required>
                                </div>
                                <input type="submit" name='Order' class="btn btn-success" value = "Order"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
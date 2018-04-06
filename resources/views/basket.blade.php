@extends('layouts.app')
@section('content')
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $cartProducts as $item )
{{--{{dump($item['product']->id)}}--}}
            <tr>
                <th scope="row"><img width="100" src="/productImages/{{$item['product']->img}}" alt=""></th>
                <td>{{$item['product']->name}}</td>
                <td>{{$item['product']->description}}</td>
                <td>{{$item['quantity']}}</td>
                <td>{{$item['price']}}</td>
                <td><a href="{{route('order_delete',array('id'=>$item['product']->id))}}" class="btn btn-primary">Delete</a></td>

            </tr>
        @endforeach
        </tbody>
    </table>
    <p align="center" >Total: {{$total}}</p>
    <form method="POST" align="center" action="{{route('accept_order')}}">
        {{ method_field('POST') }}
        {{ csrf_field() }}
        <input type="submit"  name='accept' class="btn btn-success" value="Accept"/>
    </form>
@endsection
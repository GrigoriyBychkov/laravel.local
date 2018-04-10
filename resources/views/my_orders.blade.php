@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.usermenu')
                <h3>My Orders</h3>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Products</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $record)
                        <tr>
                            <td scope="row">{{$record->id}}</td>
                            <td scope="row">
                                @foreach($record->orderItem as $item)
                                    <p> Name: {{$item->product->name}};
                                        Quantity: {{$item->quantity}} </p>
                                @endforeach
                            </td>
                            <td>{{$record->status ==1? "Active" : "Not Active"}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.usermenu')

                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                @foreach( $categories as $record )
                                    @if($record->category_id == null)
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                               role="button" aria-haspopup="true" aria-expanded="false">
                                                {{ $record->name }}
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                @include('layouts.subcats_client', ['subCategories' => $record->subCategories])
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div><!-- /.container-fluid -->
                </nav>

                <div class="panel panel-default">
                    <div class="panel-heading">User Dashboard</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                    </div>

                    @foreach($products as $record)
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object" width="100" src="/productImages/{{$record->img}}" alt="...">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{$record->name}}</h4>
                                {{ substr($record->description, 0, 70)}} <a
                                        href="{{route('show_product',['id'=>$record->id])}}">Show</a><br>
                            </div>
                        </div>
                    @endforeach
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection

@foreach( $subCategories as $sc )
    <li>
        <a href="{{route('goods_show_category',['category_id'=>$sc->id])}}">{{ $sc->name }}</a>
        <ul>
            @if($sc->subCategories)
                @include('layouts.subcats', ['subCategories' => $sc->subCategories])
            @endif
        </ul>
    </li>
@endforeach

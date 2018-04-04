<ul>
    @foreach( $subCategories as $sc )
        <li>
            {{ $sc->name }}  <a href="{{route('categories.edit',['id'=>$sc->id])}}" class="btn">Edit</a>
            @if($sc->subCategories)
                @include('layouts.subcats', ['subCategories' => $sc->subCategories])
            @endif
        </li>
    @endforeach
</ul>
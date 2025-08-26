<ul class="row">
    @foreach ($categories as $item)
        <li class="col-6"><a href="{{ route('/', [$item->slug]) }}"> <img
                    src="{{ asset($item->image) }}"
                    alt="{{ $item->name ?? '' }}">{{ $item->name ?? '' }}</a></li>
    @endforeach
</ul>
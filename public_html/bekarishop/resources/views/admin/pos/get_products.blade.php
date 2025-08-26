<div class="row">
    @forelse($products as $item)
        <div class="col-md-4 col-lg-4  col-4">
            <div class="product_card" title="{{$item->name}}" onclick="addToCart({{ $item->id }})">
                <p class="mt-1" title="{{$item->name}}">{{ $item->serial ?? '0' }}.  {{ $item->name }} - Price: {{ $item->sell_price ?? '0' }} TK</p>
            </div>
        </div>
    @empty

    <div class="col-md-12 col-lg-12  col-6">
        <div class="product_card">
            <p>No Product Found !</p>
        </div>
    </div> 

    @endforelse
</div>
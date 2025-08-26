    <a href="{{route('cart-page')}}" class="cart_bt totalItem"><strong><span class="totalItem">{{$total_item}}</span></strong></a>
    <div class="dropdown-menu">
        <ul>
        <?php foreach($contents->take(3) as $content) {?>

         @if($content->rowId)
            <input type="hidden" name="rowid[]" value="{{$content->rowId}}">
        @endif

        <?php
            $product = App\Models\Product::where('id', $content->id)->first();
        ?>

        <li class="cartItem">
            <figure><img src="{{ asset($content->options->image) }}" data-src="{{ asset($content->options->image) }}" alt="" width="50" height="50" class="lazy"></figure>
            <strong>
                <span>{{ Str::limit($content->name, 25) }}</span>
                <span> {{$content->options->size}} -  ৳{{$content->price}} * {{$content->qty}}</span>
               
            </strong>
            <a href="#0" class="action DeleteItem" data-id="{{$content->rowId}}" ><i class="icon_trash_alt"></i></a>
        </li>
        
        <?php }?>
        </ul>
        <div class="total_drop">
            <div class="clearfix add_bottom_15"><strong>Total</strong><span>৳<span class="subTotal">{{$sub_total}}</span></span></div>
            <a href="{{route('cart-page')}}" class="btn_1 outline">View Cart</a><a href="{{route('checkout')}}" class="btn_1">Checkout</a>
        </div>
    </div>
            <ul>

                <?php foreach($contents as $content) {?>
                     @if($content->rowId)
                        <input type="hidden" name="rowid[]" value="{{$content->rowId}}">
                    @endif

                    <?php
                        $product = App\Models\Product::where('id', $content->id)->first();
                    ?>

                <li class="cartItem">
                    <div class="shopping-cart-img">
                        <a href="{{route('/', [$product->slug])}}"><img alt="{{$content->name}}" src="{{ asset($content->options->image) }}"></a>
                    </div>
                    <div class="shopping-cart-title">
                        <h4><a href="{{route('/', [$product->slug])}}"> {{ Str::limit($content->name, 15) }}</a></h4>
                        <h4><span>{{$content->qty}} × </span>৳{{$content->price}}</h4>
                    </div>
                    <div  class="shopping-cart-delete">
                        <a href="#" data-id="{{$content->rowId}}" class="DeleteItem"><i class="fi-rs-cross-small"></i></a>
                    </div>
                </li>
                <?php }?>
            </ul>
            <div class="shopping-cart-footer">
                <div class="shopping-cart-total">
                    <h4>Total <span class="subTotal">৳{{$sub_total}}</span></h4>
                </div>
                <div class="shopping-cart-button">
                    <a href="{{route('cart-page')}}" class="outline">View cart</a>
                    <a href="shop-checkout.html">Checkout</a>
                </div>
            </div>

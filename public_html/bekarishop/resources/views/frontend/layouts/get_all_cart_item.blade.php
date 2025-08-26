    @if(count($contents)>0)

<ul class="ps-cart__items ">

    <?php foreach($contents as $content) {?>

     @if($content->rowId)
        <input type="hidden" name="rowid[]" value="{{$content->rowId}}">
    @endif

    <?php
        $product = App\Models\Product::where('id', $content->id)->first();
    ?>

    <li class="ps-cart__item cartItem">
        <div class="ps-product--mini-cart"><a class="ps-product__thumbnail" href="{{route('/', [$product->slug])}}"><img src="{{ asset($content->options->image) }}" alt="alt" /></a>
            <div class="ps-product__content"><a class="ps-product__name" href="{{route('/', [$product->slug])}}">{{ Str::limit($content->name, 25) }}</a>
                <p class="ps-product__meta"> 
                    <span class="ps-product__price">
                        {{$content->qty}} × ৳{{$content->price}} = {{$content->qty * $content->price}}
                    </span>
                </p>
            </div><a class="ps-product__remove DeleteItem" data-id="{{$content->rowId}}" href="javascript: void(0)"><i class="icon-cross"></i></a>
        </div>
    </li>
    <?php }?>
</ul>

<div class="all-cart-item-show text-center"  style="display: none">
    <img src="{{ asset('assets/frontend/') }}/assets/imgs/loader.gif" alt="{{$siteInfo->site_name}}" style="width: 20px; margin-top: 5px;">
</div>



<div class="ps-cart__total"><span>Subtotal </span>
    <span>৳ <span class="subTotal">{{$sub_total}}</span></span></div>
<div class="ps-cart__footer"><a class="ps-btn ps-btn--outline" href="{{ route('cart-page') }}">View Cart</a><a class="ps-btn ps-btn--warning" href="{{ route('checkout') }}">Checkout</a></div>


    @else

        <div class="text-center">
            <h6>Cart Empty</h6>
        </div>

    @endif


    <script>
    
    $(document).ready(function(){
        $('.DeleteItem').on('click', function(e){
            e.preventDefault();
            var rowId = $(this).data('id');

            var thisDeleteArea = $(this);

            if (rowId) {
                $.ajax({
                    url: "{{url('/remove-from-cart/')}}/"+rowId,
                    type: "DELETE",
                    dataType: "json",
                    success:function(data){
                        // console.log(data);
                        $('span.subTotal').text(data.sub_total);
                        $('span.totalItem').text(data.total_item);
                        thisDeleteArea.closest('.cartItem').remove();
                        swal("Deleted", "", "success");
                        
                    },
                    error:function(error){
                        // console.log(error);

                    }
                })
            }
        })
    })


</script>
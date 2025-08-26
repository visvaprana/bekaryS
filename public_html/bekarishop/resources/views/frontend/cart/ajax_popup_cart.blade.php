<div class="dropdown dropdown-cart">
    <a href="{{route('cart-page')}}" class="cart_bt"><strong>
        <span class="totalItem">{{$total_item}}</span>
    </strong></a>
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
                <strong><span>{{ Str::limit($content->name, 25) }}</span>৳{{$content->price}}</strong>
                <a href="#0" class="action" class="action DeleteItem" data-id="{{$content->rowId}}" ><i class="icon_trash_alt"></i></a>
            </li>

            <?php }?>
        </ul>
        <div class="total_drop">
            <div class="clearfix add_bottom_15"><strong>Total</strong><span>৳<span class="subTotal">{{$sub_total}}</span></span></div>
            <a href="{{route('cart-page')}}" class="btn_1 outline">View Cart</a><a href="{{route('checkout')}}" class="btn_1">Checkout</a>
        </div>
    </div>
</div>



<script>
    
    $(document).ready(function(){
        $('.DeleteItem').on('click', function(e){
            e.preventDefault();
            var rowId = $(this).data('id');

            var thisDeleteArea = $(this);
            console.log(thisDeleteArea)

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
                        // swal("Deleted", "", "success");
                        
                    },
                    error:function(error){
                        // console.log(error);

                    }
                })
            }
        })
    })


    $('.cart_item_load_more').on('click', function(e){
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            url: "{{ url('/get-all-cart-item/') }}",
            type: "POST",
            dataType: "json",
            beforeSend:function(){
                $('.all-cart-item-show').show();
                $('.cart_item_load_more').hide();
            },
            success: function(data) {
                // console.log(data);

            },
            error: function(error) {
                $('.ajax-popup-cart').html(error.responseText);
                $('.cart_item_load_more').hide();
                $('.all-cart-item-show').hide();
            }
        })


    })



</script>
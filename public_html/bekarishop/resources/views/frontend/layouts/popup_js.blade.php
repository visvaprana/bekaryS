<script>
    //Qty Up-Down
    $('.detail-qty').each(function() {
        var qtyval = parseInt($(this).find('.qty-val').text(), 10);
        $('.qty-up').on('click', function(event) {
            event.preventDefault();
            qtyval = qtyval + 1;
            $(this).prev().text(qtyval);
            $('.qty-val-input').val(qtyval);


        });
        $('.qty-down').on('click', function(event) {
            event.preventDefault();
            qtyval = qtyval - 1;
            if (qtyval > 1) {
                $(this).next().text(qtyval);
                $('.qty-val-input').val(qtyval);
            } else {
                qtyval = 1;
                $(this).next().text(qtyval);
                $('.qty-val-input').val(qtyval);
            }
        });
    });

    $('.AddCart').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var id = $(this).data('id');
        console.log(id)

        if (id) {
            $.ajax({
                url: "{{ url('/add-to-cart/') }}/" + id,
                type: "POST",
                data: $('#OrderDetails').serialize(),
                dataType: "json",
                beforeSend: function() {
                    $($($this.closest('.product-cart-wrap')[0]).find('#AddCartLoaderGif')[0])
                        .show();
                    $($($this.closest('.product-cart-wrap')[0]).find('#AddToCartBtn')[0])
                        .hide();
                },
                success: function(data) {
                    console.log(data);
                    // swal("Added", "", "success");
                    // $('span.totalItem').text(data.total_item);
                    // $('.ajax-popup-cart').html(data.responseText);


                },
                error: function(error) {
                    console.log(error);
                    $('.PopUpCartItem').html(error.responseText);
                    console.log(error.responseText)
                    swal("Added to cart", "", "success");
                    // $($($this.closest('.product-cart-wrap')[0]).find('#AddCartLoaderGif')[0])
                    //     .hide();
                    // $($($this.closest('.product-cart-wrap')[0]).find('#AddToCartBtn')[0])
                    //     .show();
                }
            })
        }
    })
</script>


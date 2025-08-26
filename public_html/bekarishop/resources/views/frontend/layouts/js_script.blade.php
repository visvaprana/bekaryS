@include('frontend.layouts.popup_js')

<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    $('.open-product-details-popup').click(function() {
        id = parseInt($(this).data('id'))
        ViewProductDetails(id)
    })


    var token = $("input[name=_token]").val();

    function ViewProductDetails(id) {
        var datastr = "id=" + id + "&token=" + token;

        $.ajax({
            type: "POST",
            url: "{{ url('/view-product-details/') }}",
            data: datastr,
            cache: false,

            success: (data) => {
                console.log(data)
                $('.ps-product--detail').html(data);

            },
            error: (jqXHR, status, err) => {
                console.error(err);
            },
            complete: () => {

            }
        });
    }

    $(document).ready(function() {


        $('.increaseCart').on('click', function(e) {
            e.preventDefault();
            var rowId = $(this).data('id');

            if (rowId) {
                $.ajax({
                    url: "{{ url('/increase-cart/') }}/" + rowId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
           
                        $('span.subTotal').text(data.sub_total);
                        $('span.totalItem').text(data.total_item);

                        swal("Cart is Updated", "", "success");

                        location.reload();

                    },
                    error: function(error) {
                        console.log(error);


                    }
                })
            }
        })  

        $('.decreaseCart').on('click', function(e) {
            e.preventDefault();
            var rowId = $(this).data('id');

            if (rowId) {
                $.ajax({
                    url: "{{ url('/decrease-cart/') }}/" + rowId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
           
                        $('span.subTotal').text(data.sub_total);
                        $('span.totalItem').text(data.total_item);

                        swal("Cart is Updated", "", "success");

                        location.reload();

                    },
                    error: function(error) {
                        console.log(error);


                    }
                })
            }
        })      
        
        $('.DeleteItem').on('click', function(e) {
            e.preventDefault();
            var rowId = $(this).data('id');

            var thisDeleteArea = $(this);
            console.log(thisDeleteArea)

            if (rowId) {
                $.ajax({
                    url: "{{ url('/remove-from-cart/') }}/" + rowId,
                    type: "DELETE",
                    dataType: "json",
                    success: function(data) {
                        // console.log(data);
                        $('span.subTotal').text(data.sub_total);
                        $('span.totalItem').text(data.total_item);
                        thisDeleteArea.closest('.cartItem').remove();
                        swal("Deleted from cart", "", "error");

                        location.reload();

                    },
                    error: function(error) {
                        console.log(error);


                    }
                })
            }
        })        

        $('.cartDestroy').on('click', function(e) {
            e.preventDefault();

            var thisDeleteArea = $(this);
            console.log(thisDeleteArea)

            $.ajax({
                url: "{{ url('/cart-destroy') }}/",
                type: "get",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    // location.reload();


                },
                error: function(error) {
                    console.log(error);
                    location.reload();


                }
            })
        })




        $('.AddWishlist').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var id = $(this).data('id');

            if (id) {
                $.ajax({
                    url: "{{ url('/add-to-wishlist/') }}/" + id,
                    type: "POST",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);

                        if (data.exist) {
                            swal("Already added in wishlist", "", "error");
                        } else {
                            swal("Added to wishlist", "", "success");
                            $('span.totalWishlistItem').text(data.total_item);
                        }


                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            }
        })
    })

    $(document).ready(function() {
        $('.RemoveFromWishlist').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            var thisDeleteArea = $(this);

            if (id) {
                $.ajax({
                    url: "{{ url('/remove-from-wishlist/') }}/" + id,
                    type: "DELETE",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        $('span.totalWishlistItem').text(data.total_wishlist_item);
                        swal("Deleted from wishlist", "", "error");
                        thisDeleteArea.closest('.wishlistItem').remove();

                    },
                    error: function(error) {
                        console.log(error);


                    }
                })
            }
        })
    })


    $('.show-transaction').on('click', function(e){

        var $this = $(this);
        var id = $(this).data('id');

        if (id) {
            $.ajax({
                url: "{{ url('/get-payment-method-data/') }}/" + id,
                type: "POST",
                dataType: "json",
                success: function(data) {
                    // console.log(data.responseText);

                },
                error: function(error) {
                    console.log(error.responseText);
                    $('#payment_details').html(error.responseText);
                    document.getElementById("TransactionID").style.display = "block";


                }
            })
        }


    })


    $('.hide-transaction').on('click', function(e){
        document.getElementById("TransactionID").style.display = "none";
    })



    $('.more_categories').on('click', function(e){

        var $this = $(this);
        $.ajax({
            url: "{{ url('/get-all-category/') }}",
            type: "POST",
            dataType: "json",
            beforeSend:function(){
                $('.all-category-show').show();
                $('.more_categories').hide();
            },
            success: function(data) {
                // console.log(data);

            },
            error: function(error) {
                $('.categori-dropdown-inner').html(error.responseText);
                $('.more_categories').hide();
                $('.all-category-show').hide();
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

    $(document).ready(function() {
        $('#city_select2').select2({
            // theme: "classic"

        });
        $('#area_select2').select2({
            // theme: "classic"

        });
        $('#s_city_select2').select2({
            // theme: "classic"

        });
        $('#s_area_select2').select2({
            // theme: "classic"

        });
    });




  //GetArea
  var token =  $("input[name=_token]").val();
  function GetArea(val){
    var datastr = "city_id=" + val  + "&token="+token;
    $.ajax({
      type: "post",
      url: "<?php echo route('get-area');?>",
      data:datastr,
      cache:false,
      beforeSend: function() {
          // setting a timeout
      },
      success:function (data) {            
        $('#area_select2').html(data);

      },
      error: function (jqXHR, status, err) {
        alert(status);
        console.log(err);
      },
      complete: function () {
        // alert("Complete");
      }
    });
  }



  //GetArea
  var token =  $("input[name=_token]").val();
  function GetShippingArea(val){
    var datastr = "s_city_id=" + val  + "&token="+token;
    $.ajax({
      type: "post",
      url: "<?php echo route('get-shipping-area');?>",
      data:datastr,
      cache:false,
      beforeSend: function() {
          // setting a timeout
      },
      success:function (data) {            
        $('#s_area_select2').html(data);

      },
      error: function (jqXHR, status, err) {
        alert(status);
        console.log(err);
      },
      complete: function () {
        // alert("Complete");
      }
    });
  }



  //GetShippingCharge
  var token =  $("input[name=_token]").val();
  function GetShippingCharge(val){
    var datastr = "area_id=" + val  + "&token="+token;

    $.ajax({
      type: "post",
      url: "<?php echo route('get-shipping-charge');?>",
      data:datastr,
      cache:false,
      beforeSend: function() {
          // setting a timeout
      },
      success:function (data) {            
        $('.area_shipping_charge').text(data.data.shipping_charge);
        $('.zipcode').val(data.data.postcode);

        shipping_charge = data.data.shipping_charge;

        checkout_sub_total = $('#checkout_sub_total').text();

        
        checkout_discount = $('#checkout_discount').text();
        console.log(checkout_discount);

        if(checkout_discount){
            total =  (parseInt(checkout_sub_total -  parseInt(checkout_discount))) + parseInt(shipping_charge) ;
        }else{
            total =  parseInt(checkout_sub_total) + parseInt(shipping_charge) ;
        }

        checkout_total = $('#checkout_total').text(total);


      },
      error: function (jqXHR, status, err) {
        alert(status);
        console.log(err);
      },
      complete: function () {
        // alert("Complete");
      }
    });
  }



  var token =  $("input[name=_token]").val();
  function getUrgentCharge(val){
      
        var area_id = $('.area_id').val();

        var datastr = "isUrgent=" + val + "&area_id=" + area_id + "&token="+token;
        
      $('.urgent_charge_li').show();

       
       
        $.ajax({
          type: "post",
          url: "<?php echo route('get-urgent-charge');?>",
          data:datastr,
          cache:false,
          beforeSend: function() {
              // setting a timeout
          },
          success:function (data) {       
              

 
              
            if(val == 'yes'){
                
                
                $('.urgent_charge').text(data.data.urgent_charge);
                urgent_charge = data.data.urgent_charge;
                checkout_sub_total = $('#checkout_sub_total').text();                
                
                if(checkout_discount){
                    total =  (parseInt(checkout_sub_total -  parseInt(checkout_discount))) + parseInt(shipping_charge) ;
                }else{
                    total =  parseInt(checkout_sub_total) + parseInt(shipping_charge) ;
                }
                
                
                if(urgent_charge > 0){
                    total = total + urgent_charge;
                }                
                checkout_total = $('#checkout_total').text(total);
                
            }else{
                
                $('.urgent_charge').text(0);
                
                if(checkout_discount){
                    total =  (parseInt(checkout_sub_total -  parseInt(checkout_discount))) + parseInt(shipping_charge) ;
                }else{
                    total =  parseInt(checkout_sub_total) + parseInt(shipping_charge) ;
                }
                
                
                checkout_total = $('#checkout_total').text(total);
                
            }
            
     
    
            
    
    
          },
          error: function (jqXHR, status, err) {
            alert(status);
            console.log(err);
          },
          complete: function () {
            // alert("Complete");
          }
        });       
       
       

   

    
    
    
    
  }
    
    
    


















    $('.LoadMoreButton').on('click', function(e){
        e.preventDefault();
        var $this = $(this);
        var id = $(this).data('id');
        var datastr = "id="+id  + "&token="+token;


        $.ajax({
            url: "{{ url('/load-more-product/') }}",
            type: "POST",
            dataType: "json",
            data: datastr,
            beforeSend:function(){
                $('.LoadMoreButtonText').html("Loading...");
                $( ".LoadMoreButtonText" ).addClass( "LoadMoreButtonLoading" );

            },
            success: function(data) {
                console.log(data)
            },
            error: function(error) {
                $('#LoadMoreButton').remove();
                $('#LoadMoreProduct').append(error.responseText);
                $('.LoadMoreButtonLoading').remove();

               
            }
        })


    });


    $(".togglePassword").click(function(){
        $(".collapsePassword").show();
    });




</script>

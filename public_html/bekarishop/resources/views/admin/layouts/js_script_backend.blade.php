<script src="{{asset('assets/backend/plugins/')}}/jquery/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">


  $( document ).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  });


  @if (Session::has('message'))
  var type = "{{ Session::get('alert-type', 'info') }}"
  switch(type){
      case 'info':

          toastr.options.timeOut = 10000;
          toastr.info("{{Session::get('message')}}");
          var audio = new Audio('audio.mp3');
          audio.play();
          break;
      case 'success':

          toastr.options.timeOut = 10000;
          toastr.success("{{Session::get('message')}}");
          var audio = new Audio('audio.mp3');
          audio.play();

          break;
      case 'warning':

          toastr.options.timeOut = 10000;
          toastr.warning("{{Session::get('message')}}");
          var audio = new Audio('audio.mp3');
          audio.play();

          break;
      case 'error':

          toastr.options.timeOut = 10000;
          toastr.error("{{Session::get('message')}}");
          var audio = new Audio('audio.mp3');
          audio.play();

          break;
  }
  @endif



    //Country
    $(document).ready(function(){
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
           token = $( "input[value='_token']" ).val();


           $('.edit').on('click',function(){
               var id = $(this).attr("data-id");
               data = {
                   "_token": token,
                   "id":id
               };
               $.ajax({
                   url: "country/"+id+'/edit',
                   type: "get",
                   data:data,
                   success: function (response) {
                       // console.log(response);
                       $('.country-form').html(response);
                   },
                   error: function(jqXHR, textStatus, errorThrown) {
                       console.log(textStatus, errorThrown);
                   }
               });
           });




   });


    //City
    $(document).ready(function(){
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
           token = $( "input[value='_token']" ).val();


           $('.edit').on('click',function(){
               var id = $(this).attr("data-id");
               data = {
                   "_token": token,
                   "id":id
               };
               $.ajax({
                   url: "city/"+id+'/edit',
                   type: "get",
                   data:data,
                   success: function (response) {
                       // console.log(response);
                       $('.city-form').html(response);
                   },
                   error: function(jqXHR, textStatus, errorThrown) {
                       console.log(textStatus, errorThrown);
                   }
               });
           });




   });

    //Area
    $(document).ready(function(){
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       token = $( "input[value='_token']" ).val();


       $('.edit').on('click',function(){
           var id = $(this).attr("data-id");
           data = {
               "_token": token,
               "id":id
           };
           $.ajax({
               url: "area/"+id+'/edit',
               type: "get",
               data:data,
               success: function (response) {
                   // console.log(response);
                   $('.area-form').html(response);
               },
               error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
               }
           });
       });
   });

    //Item
    $(document).ready(function(){
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       token = $( "input[value='_token']" ).val();


       $('.edit').on('click',function(){
           var id = $(this).attr("data-id");
           data = {
               "_token": token,
               "id":id
           };
           $.ajax({
               url: "item/"+id+'/edit',
               type: "get",
               data:data,
               success: function (response) {
                   // console.log(response);
                   $('.item-form').html(response);
               },
               error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
               }
           });
       });
   });

    //item_package
    $(document).ready(function(){
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       token = $( "input[value='_token']" ).val();


       $('.edit').on('click',function(){
           var id = $(this).attr("data-id");
           data = {
               "_token": token,
               "id":id
           };
           $.ajax({
               url: "item_package/"+id+'/edit',
               type: "get",
               data:data,
               success: function (response) {
                   // console.log(response);
                   $('.item_package-form').html(response);
               },
               error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
               }
           });
       });
   });



    //galleyEdit
    $(document).ready(function(){
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       token = $( "input[value='_token']" ).val();


       $('.galleyEdit').on('click',function(){
           var id = $(this).attr("data-id");
           data = {
               "_token": token,
               "id":id
           };
           $.ajax({
               url: "gallery/"+id+'/edit',
               type: "get",
               data:data,
               success: function (response) {
                   // console.log(response);
                   $('.gallery-form').html(response);
               },
               error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
               }
           });
       });
    });

    //role
    $(document).ready(function(){
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       token = $( "input[value='_token']" ).val();


       $('.edit').on('click',function(){
           var id = $(this).attr("data-id");
           data = {
               "_token": token,
               "id":id
           };
           $.ajax({
               url: "role/"+id+'/edit',
               type: "get",
               data:data,
               success: function (response) {
                   // console.log(response);
                   $('.role-form').html(response);
               },
               error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
               }
           });
       });
   });

    //category
    $(document).ready(function(){
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       token = $( "input[value='_token']" ).val();


       $('.edit').on('click',function(){
           var id = $(this).attr("data-id");
           data = {
               "_token": token,
               "id":id
           };
           $.ajax({
               url: "category/"+id+'/edit',
               type: "get",
               data:data,
               success: function (response) {
                   // console.log(response);
                   $('.category-form').html(response);
               },
               error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
               }
           });
       });
   });

    //brand
    $(document).ready(function(){
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       token = $( "input[value='_token']" ).val();


       $('.edit').on('click',function(){
           var id = $(this).attr("data-id");
           data = {
               "_token": token,
               "id":id
           };
           $.ajax({
               url: "brand/"+id+'/edit',
               type: "get",
               data:data,
               success: function (response) {
                   // console.log(response);
                   $('.brand-form').html(response);
               },
               error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
               }
           });
       });
   });

    //coupon
    $(document).ready(function(){
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       token = $( "input[value='_token']" ).val();


       $('.editCoupon').on('click',function(){
           var id = $(this).attr("data-id");
           data = {
               "_token": token,
               "id":id
           };
           $.ajax({
               url: "coupon/"+id+'/edit',
               type: "get",
               data:data,
               success: function (response) {
                   // console.log(response);
                   $('.coupon-form').html(response);
               },
               error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
               }
           });
       });
   });

    //Banner
    $(document).ready(function(){
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       token = $( "input[value='_token']" ).val();


       $('.editBanner').on('click',function(){
           var id = $(this).attr("data-id");
           data = {
               "_token": token,
               "id":id
           };
           $.ajax({
               url: "banner/"+id+'/edit',
               type: "get",
               data:data,
               success: function (response) {
                   // console.log(response);
                   $('.banner-form').html(response);
               },
               error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
               }
           });
       });
   });

    //editPartner
    $(document).ready(function(){
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       token = $( "input[value='_token']" ).val();


       $('.editPartner').on('click',function(){
           var id = $(this).attr("data-id");
           data = {
               "_token": token,
               "id":id
           };
           $.ajax({
               url: "partner/"+id+'/edit',
               type: "get",
               data:data,
               success: function (response) {
                   // console.log(response);
                   $('.partner-form').html(response);
               },
               error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
               }
           });
       });
   });

    //editAttribute
    $(document).ready(function(){
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       token = $( "input[value='_token']" ).val();


       $('.editAttribute').on('click',function(){
           var id = $(this).attr("data-id");
           data = {
               "_token": token,
               "id":id
           };
           $.ajax({
               url: "attribute/"+id+'/edit',
               type: "get",
               data:data,
               success: function (response) {
                   // console.log(response);
                   $('.attribute-form').html(response);
               },
               error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
               }
           });
       });
   });

    //editColor
    $(document).ready(function(){
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       token = $( "input[value='_token']" ).val();


       $('.editColor').on('click',function(){
           var id = $(this).attr("data-id");
           data = {
               "_token": token,
               "id":id
           };
           $.ajax({
               url: "color/"+id+'/edit',
               type: "get",
               data:data,
               success: function (response) {
                   // console.log(response);
                   $('.color-form').html(response);
               },
               error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
               }
           });
       });
   });

    //editSize
    $(document).ready(function(){
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       token = $( "input[value='_token']" ).val();


       $('.editSize').on('click',function(){
           var id = $(this).attr("data-id");
           data = {
               "_token": token,
               "id":id
           };
           $.ajax({
               url: "size/"+id+'/edit',
               type: "get",
               data:data,
               success: function (response) {
                   // console.log(response);
                   $('.size-form').html(response);
               },
               error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
               }
           });
       });
   });

    //editUnit
    $(document).ready(function(){
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       token = $( "input[value='_token']" ).val();


       $('.editUnit').on('click',function(){
           var id = $(this).attr("data-id");
           data = {
               "_token": token,
               "id":id
           };
           $.ajax({
               url: "unit/"+id+'/edit',
               type: "get",
               data:data,
               success: function (response) {
                   // console.log(response);
                   $('.unit-form').html(response);
               },
               error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
               }
           });
       });
   });

















  //GetCity
  var token =  $("input[name=_token]").val();
  function GetCity(val){
    var datastr = "country_id=" + val  + "&token="+token;
    $.ajax({
      type: "post",
      url: "<?php echo route('admin/get-city');?>",
      data:datastr,
      cache:false,
      beforeSend: function() {
          // setting a timeout
      },
      success:function (data) {
        $('#city_id').html(data);

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
  function GetArea(val){
    var datastr = "city_id=" + val  + "&token="+token;
    $.ajax({
      type: "post",
      url: "<?php echo route('admin/get-area');?>",
      data:datastr,
      cache:false,
      beforeSend: function() {
          // setting a timeout
      },
      success:function (data) {
        $('#area_id').html(data);

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




  function calculateRetun(val, discountPercentage=0) {
      // Parse values as floats to ensure proper calculation
      let total = parseFloat($('.total').val());
      let discountAmount = total * (discountPercentage / 100);
      let finalTotal = total - discountAmount;

      // Calculate the return/change amount (payment - final total)
      let returnAmount = val - finalTotal;
      $('#discount').val(discountAmount);

      // Update the return field with formatted value
      $('.return').val(returnAmount.toFixed(2));
  }

  function calculateSub(input) {
        // Get the closest tr element by traversing up the DOM


        var row = input.parentNode;

        while (row && row.tagName.toLowerCase() !== 'tr') {
            row = row.parentNode;
        }

        // Check if the row and elements exist
        if (row) {
            var unitPriceElement = row.querySelector('.cart_unit_price');
            var subTotalElement = row.querySelector('.cart_sub_total');

            // Check if the elements exist before accessing properties
            if (unitPriceElement && subTotalElement) {
                // Get the unit price value
                var unitPrice = parseFloat(unitPriceElement.textContent);

                // Get the entered quantity
                var quantity = parseFloat(input.value, 10);

                // Calculate the subtotal
                var subTotal = unitPrice * quantity;

                // Update the cart_sub_total element with the new value
                subTotalElement.textContent = subTotal.toFixed(2);

                // Update the cart_sub_total element with the new value
                subTotalElement.textContent = subTotal.toFixed(2);


                $('.pay').val(0);
                $('.return').val(0);

                // Recalculate the total sum
                updateTotal();

            }
        }
    }

    function updateTotal() {
        var totalElements = document.querySelectorAll('.cart_sub_total');
        var total = Array.from(totalElements).reduce(function (sum, element) {
            return sum + parseFloat(element.textContent);
        }, 0);

        // Update the total class with the calculated sum
        document.querySelector('.total').value = total.toFixed(2);
    }

  //GetResturantItem
  var token =  $("input[name=_token]").val();
  function GetResturantItem(val){
    var datastr = "resturant_id=" + val  + "&token="+token;
    $.ajax({
      type: "post",
      url: "<?php echo route('admin/get-item');?>",
      data:datastr,
      cache:false,
      beforeSend: function() {
          // setting a timeout
      },
      success:function (data) {
        $('#item_id').html(data);

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
  //GetResturantItem
  var token =  $("input[name=_token]").val();
  function addToCart(val){

    var order_qty = $('.order_qty').val();
    console.log(order_qty);

    if(order_qty == 0){
        alert('Please Enter Order Quantity')
        // var order_qty = 1;
    }else{
        var datastr = "product_id=" + val + "&quantity=" + order_qty + "&token="+token;
        $.ajax({
        type: "post",
        url: "<?php echo route('admin/add_to_cart');?>",
        data:datastr,
        cache:false,
        beforeSend: function() {
            // setting a timeout
        },
        success:function (data) {
            // playSound();
            $('.cartItem').html(data);
            $('.order_qty').val(1);

        },
        error: function (jqXHR, status, err) {
            // alert(status);
            console.log(err);
        },
        complete: function () {
            // alert("Complete");
        }
        });
    }



  }



  //updateCart
  var token =  $("input[name=_token]").val();
  function updateCart(inputElement){

    var rowId = $(inputElement).data("id");
    var qty = $(inputElement).val();

    if(qty == 0){


    }else{

        var datastr = "rowId=" + rowId + "&qty=" + qty + "&token="+token;

        $.ajax({
        type: "post",
        url: "<?php echo route('admin/update-cart');?>",
        data:datastr,
        cache:false,
        beforeSend: function() {
            // setting a timeout
        },
        success:function (data) {
            console.log(data)
            // $('.cartItem').html(data);

            var subtotal = parseFloat($(inputElement).closest('tr').find('.cart_sub_total').text());
            var newSubtotal = parseFloat(data.sub_total); // Assuming data contains the updated subtotal

            $(inputElement).closest('tr').find('.cart_sub_total').text(newSubtotal.toFixed(2));

            $('.total').val(data.total);


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


  }


  function playSound() {
        var audio = document.getElementById("myAudio");
        audio.play();
    }

    // Call playSound function wherever you need the sound
    // playSound();

  $('.DeleteCartItem').on('click', function(e) {
            e.preventDefault();
            var rowId = $(this).data('id');


            var thisDeleteArea = $(this);
            console.log(1)

            if (rowId) {
                $.ajax({
                    url: "{{ url('admin/remove_from_cart/') }}/" + rowId,
                    type: "DELETE",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        $('.cartItem').html(data);

                        location.reload();

                    },
                    error: function(error) {
                        console.log(error);


                    }
                })
            }
        })

  //getProducts
  var token =  $("input[name=_token]").val();
  function getProducts(val){
    var datastr = "category_id=" + val  + "&token="+token;
    $.ajax({
      type: "post",
      url: "<?php echo route('admin/get-products');?>",
      data:datastr,
      cache:false,
      beforeSend: function() {
        loading();
      },
      success:function (data) {
        $('.search_products').html(data);

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
  //getProducts
  var token =  $("input[name=_token]").val();
  function getProductsByName(val){
    var datastr = "product_name=" + val  + "&token="+token;
    $.ajax({
      type: "post",
      url: "<?php echo route('admin/get-products-by-name');?>",
      data:datastr,
      cache:false,
      beforeSend: function() {

      },
      success:function (data) {
        $('.search_products').html(data);

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



  function loading(){
    document.getElementById('category_id').addEventListener('change', function() {
            var loadingOverlay = document.querySelector('.loading-overlay');
            loadingOverlay.style.display = 'flex'; // Show loading overlay

            // Perform your search or data loading logic here

            // Once the search is complete or data is loaded, hide the loading overlay
            // For example, you can simulate a delay with setTimeout
            setTimeout(function() {
                loadingOverlay.style.display = 'none'; // Hide loading overlay
            }, 2000); // Adjust the timeout based on your actual loading time
        });
  }







  $(document).ready(function() {
      $('.js-example-basic-multiple').select2({
          placeholder: 'Select '
      });
  });

  $(document).ready(function() {
      $('.productCategory').select2({
          placeholder: 'Select '
      });
  });

  $(document).ready(function() {
      $('.stock_status').select2({
          placeholder: 'Select '
      });
  });


  $(document).ready(function() {
      $('.brand_id').select2({
          placeholder: 'Select '
      });
  });


  $(document).ready(function() {
      $('.color_id').select2({
          placeholder: 'Select '
      });
  });

  $(document).ready(function() {
      $('.size_id').select2({
          placeholder: 'Select '
      });
  });


  $(document).ready(function() {
      $('.unit_id').select2({
          placeholder: 'Select '
      });
  });



    $(document).on('click', '.add', function(){
      var html = '';
      html += '<tr>';
      html += '<td><input type="file" name="product_image[]" class="form-control" /></td>';
      html += '<td><input type="text" class="form-control" name="product_image_alt[]" ></td>';
      html += '<td><textarea name="product_image_des[]" class="form-control" cols="30" rows="2"></textarea></td>';
      html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="fa fa-minus-circle"></span></button></td></tr>';
      $('#productImage').append(html);
    });

    $(document).on('click', '.highlights', function(){
      var html = '';
      html += '<tr>';
      html += '<td><input type="text" name="highlights[]" class="form-control" /></td>';
      html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="fa fa-minus-circle"></span></button></td></tr>';
      $('#highlights').append(html);
    });

    $(document).on('click', '.productTerm', function(){
      var html = '';
      html += '<tr>';
      html += '<td><input type="text" name="terms[]" class="form-control" /></td>';
      html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="fa fa-minus-circle"></span></button></td></tr>';
      $('#productTerm').append(html);
    });

    $(document).on('click', '.specification', function(){
      var html = '';
      html += '<tr>';
      html += '<td><input type="text" name="specification[]" class="form-control" /></td>';
      html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="fa fa-minus-circle"></span></button></td></tr>';
      $('#specification').append(html);
    });


    $(document).on('click', '.remove', function(){
      $(this).closest('tr').remove();
    });

    function calculateDiscount() {
        var sell_price = $('#sell_price').val();
        var discount = $('#discount').val();
        var discount_price = (sell_price - sell_price * discount / 100).toFixed();
        $('#discount_price').val(discount_price);
    }



</script>

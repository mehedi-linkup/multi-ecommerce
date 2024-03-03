<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="description" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="">
        <meta name="keywords" content="MediaCenter, Template, eCommerce">
        <meta name="robots" content="all">
        @yield('meta')

        <title>@yield('title')</title>

        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap.min.css">

        <!-- Customizable CSS -->
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/main.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/blue.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/owl.carousel.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/owl.transitions.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/animate.min.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/rateit.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />




        <!-- Icons/Glyphs -->
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/font-awesome.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Fonts --> 
        <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

        <script src="https://js.stripe.com/v3/"></script>
        
    </head>
    <body class="cnt-home">
        <!-- ============================================== HEADER ============================================== -->
        @include('frontend.partials.header')

        <!-- ============================================== HEADER : END ============================================== -->
        
        @yield('main_content')



        <!-- ============================================================= FOOTER ============================================================= -->
        @include('frontend.partials.footer')
        <!-- ============================================================= FOOTER : END============================================================= -->
        <!-- Cart Modal -->
        <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><span id="pname"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                      <div class="col-md-4">
                          <div class="card" style="width:5rem;">
                            <img src="" class="card-img-top" id="pimage" alt="" style="height: 200px; width: 190px">
                          </div>
                      </div>
                      
                      <div class="col-md-4">
                        <ul class="list-group">
                            <li class="list-group-item">Price: <strong class="text-danger">$<span id="price"></span> </strong> <del id="oldprice">$</del>
                            </li>
                            <li class="list-group-item">Product Code: <strong id="pcode"></strong></li>
                            <li class="list-group-item">Category: <strong id="pcategory"></strong></li>
                            <li class="list-group-item">Brand: <strong id="pbrand"></strong> </li>
                            <li class="list-group-item">Stock: <span class="badge badge-pill badge-success"
                                    id="aviable" style="background:green; color:white;"></span>
                                <span class="badge badge-pill badge-danger" id="stockout"
                                    style="background:red; color:white;"></span>
                            </li>
                        </ul>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="color">Select Color</label>
                            <select class="form-control" id="color" name="color">
                                
                            </select>
                        </div>
                        <div class="form-group" id="sizeArea">
                            <label for="size">Select Size</label>
                            <select class="form-control" id="size" name="size">
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="qty">Quantity</label>
                            <input type="number" class="form-control" id="qty" value="1" min="1">
                        </div>
                          
                        <input type="hidden" id="product_id">
                        <button type="submit" class="btn btn-danger" onclick="addToCart()">Add To Cart</button>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <!-- For demo purposes – can be removed on production -->


        <!-- For demo purposes – can be removed on production : End -->

        <!-- JavaScripts placed at the end of the document so the pages load faster -->
        <script src="{{ asset('frontend') }}/assets/js/jquery-1.11.1.min.js"></script>

        <script src="{{ asset('frontend') }}/assets/js/bootstrap.min.js"></script>

        <script src="{{ asset('frontend') }}/assets/js/bootstrap-hover-dropdown.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/js/owl.carousel.min.js"></script>

        <script src="{{ asset('frontend') }}/assets/js/echo.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/js/jquery.easing-1.3.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/js/bootstrap-slider.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/js/jquery.rateit.min.js"></script>
        <script type="text/javascript" src="{{ asset('frontend') }}/assets/js/lightbox.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/js/bootstrap-select.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/js/wow.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/js/scripts.js"></script>
        <script src="{{ asset('frontend') }}/js/sweetalert2@8.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="{{ asset('common') }}/jquery.form-validator.min.js"></script>
        <script>
            $.validate({
                lang: 'en'
            });

        </script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            @if (Session::has('message'))
                var type ="{{ Session::get('alert-type', 'info') }}"
                switch(type){
                case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;

                case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;

                case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;

                case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
                }
            @endif

        </script>
        
        <!-- Prodcut View Modal & Add to Cart -->
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }) 
        
        //Start product View with Modal
        
        function productView(id){
            $.ajax({
                type: "GET",
                url: "/product/view/modal/"+id,
                dataType: "json",
                success: function(data){
                    $('#pname').text(data.product.name_en);
                    $('#price').text(data.product.selling_price);
                    $('#pcode').text(data.product.product_code);
                    $('#pcategory').text(data.product.category.name_en);
                    $('#pbrand').text(data.product.brand.name_en);
                    $('#pimage').attr('src', '/backend/images/products/' + data.product.product_image);
                    $('#product_id').val(id);
                    $('#qty').val(1);
                    
                    //product price
                    if(data.product.discount_price == null){
                        $('#price').text('');
                        $('#oldprice').text('');
                        $('#price').text(data.product.selling_price);
                    }else{
                        $('#price').text(data.product.discount_price);
                        $('#oldprice').text(data.product.selling_price);
                    }
                    
                    //stock
                    if (data.product.quantity > 0) {
                        $('#aviable').text('');
                        $('#stockout').text('');
                        $('#aviable').text('aviable');
                    } else {
                        $('#aviable').text('');
                        $('#stockout').text('');
                        $('#stockout').text('stockout');
                    }

                    
                    //color
                    $('select[name="color"]').empty();
                    $.each(data.color, function(key, value) {
                        $('select[name="color"]').append('<option value="' + value + '">' + value +
                            '</option>')
                    })
                    //size
                    $('select[name="size"]').empty();
                    $.each(data.size, function(key, value) {
                        $('select[name="size"]').append('<option value="' + value + '">' + value +
                            '</option>')
                        if (data.size == "") {
                            $('#sizeArea').hide();
                        } else {
                            $('#sizeArea').show();
                        }
                    })
                    
                }
            });
            
            
        }
        
        //End product View with Modal
        
        //Start Add to Cart product
        function addToCart(){
            var product_name = $("#pname").text();
            var id = $("#product_id").val();
            var color = $("#color option:selected").text();
            var size = $("#size option:selected").text();
            var quantity = $("#qty").val();
            
            $.ajax({
                type: "POST",
                dataType: "json",
                data: {product_name: product_name, color:color, size:size, quantity:quantity},
                url: "/product/cart/store/"+id,
                success: function(data){
                     miniCart();
                     $('#closeModal').click();
                     
                     //  start message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000
                    })

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    //  end message
                }
            });
        }
        
        //End Add to Cart product
        
        
    </script>
    
    
    @yield('scripts')


    <script>
        function miniCart(){
            $.ajax({
                type: "GET",
                url: "/product/mini/cart",
                dataType: "json",
                success: function(response){
                    //console.log(response);
                    
                    $('span[id="cartSubTotal"]').text(response.cartTotal);
                    $('#cartQty').text(response.cartQty);
                    
                    var miniCart = '';
                    $.each(response.carts, function(key, value){
                        miniCart += `<div class="cart-item product-summary">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="image">
                                            <a href="detail.html"><img src="/backend/images/products/${value.options.image}" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">

                                        <h3 class="name"><a href="index8a95.html?page-detail">${value.name}</a></h3>
                                        <div class="price">${value.price}$ * ${value.qty}</div>
                                    </div>
                                    <div class="col-xs-1 action">
                                        <button type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                                <hr>`
                    });
                    $('#miniCart').html(miniCart);
                }
            });
        }
        
        miniCart();
        
        
        //Mini Cart Remove Start
        
        function miniCartRemove(rowId){
            $.ajax({
                type: "GET",
                url: "/mini/cart/remove/" +rowId,
                dataType: "json",
                success: function(data){
                    miniCart();
                    //start message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000
                    })

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    //  end message
                }
            });
        }
        
    </script>
    
    <!-- add to wishlist -->
    <script>
        function addToWishlist(product_id){
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "{{ url('/add-to-wishlist/') }}/" + product_id,
                success: function(data) {
                    //  start message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    //  end message
                }
            })
        }
    </script>
    
    <!-- Wishlist Page view -->
    <script>
        function wishlist(){
            $.ajax({
                type: 'GET',
                url: "{{ url('/user/get-wishlist-product') }}",
                dataType: 'json',
                success: function(response){
                    
                    var rows = '';
                    $.each(response, function(key, value){
                        rows += `<tr>
                                    <td class="col-md-2"><img src="/backend/images/products/${value.product.product_image}" alt="imga"></td>
                                    <td class="col-md-7">
                                        <div class="product-name"><a href="#">${value.product.name_en}</a></div>
                                        
                                        <div class="price">
                                            ${value.product.discount_price == null ? `$${value.product.selling_price}` : `$${value.product.discount_price} <span>$${value.product.selling_price}</span>`}
                                        </div>
                                    </td>
                                    <td class="col-md-2">
                                        <button type="button" title="Add to Cart" class="btn-upper btn btn-primary" id="${ value.product_id }" data-toggle="modal" data-target="#cartModal" onclick="productView(this.id)">Add to cart</button>
                                    </td>
                                    <td class="col-md-1 close-btn">
                                        <button type="button" class="" id="${value.id}" onclick="wishlistRemove(this.id)"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>`
                    });
                    $('#wishlist').html(rows);
                }
            });
        }
        
        wishlist();
        
        //Wishlist Remove
        
        function wishlistRemove(id){
            $.ajax({
                type: "GET",
                url: "/user/wishlist-remove/" +id,
                dataType: "json",
                success: function(data){
                    wishlist();
                    //  start message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    //  end message
                }
            });
        }
    </script>
    
    <!-- Cart page here -->
    <script>
        function cart(){
            $.ajax({
                type: "GET",
                url: "{{ url('/get-cart-product') }}",
                dataType: "json",
                success: function(response){
                    var rows = '';
                    $.each(response.carts, function(key, value){
                        rows += `<tr class="text-center">
                                    <td class="col-md-2">
                                       <img src="/backend/images/products/${value.options.image}" style="height:60px; width:60px;" alt="">
                                    </td>
                                        
                                    <td class="col-md-2">
                                        <div class="product-name"><strong>${value.name}</strong></div>
                                    </td>
                                            
                                    <td class="col-md-2">
                                        <div class="product-name"><strong>$${value.price}</strong></div>
                                    </td>
                                            
                                    <td class="col-md-2">

                                        <strong>${value.options.color}</strong>
                                    </td>
                                            
                                    <td class="col-md-2">
                                        ${value.options.size == null
                                            ? `<span >......</span>`
                                            :
                                            `<strong>${value.options.size}</strong>`
                                        }

                                    </td>
    
                                    <td class="col-md-2">
                                        ${value.qty > 1
                                        ? ` <button type="submit" class="btn btn-success btn-sm" id="${value.rowId}" onclick="cartDecrement(this.id)">-</button>`
                                        : ` <button type="submit" class="btn btn-success btn-sm" disabled>-</button>`
                                        }

                                        <input type="text" value="${value.qty}" min="1" max="100" disabled style="width:25px;">
                                        <button type="submit" id="${value.rowId}" onclick="cartIncrement(this.id)" class="btn btn-danger btn-sm">+</button>
                                    </td>
                                    
                                    <td class="col-md-1">
                                        <strong>$${value.subtotal}</strong>
                                    </td>

                                    <td class="col-md-1 close-btn">
                                     <button type="submit" class="" id="${value.rowId}" onclick="CartRemove(this.id)" ><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                                `
                    });
                    $('#cartPage').html(rows);
                }
            });
        }
        cart();
        
        
        function CartRemove(id){
            $.ajax({
                type: 'GET',
                url: "{{ url('/cart-remove/') }}/" + id,
                dataType: 'json',
                success: function(data) {
                    cart();
                    miniCart();
                    couponCalculation();
                    $('#couponField').show();
                    $('#coupon_name').val('');
                    //  start message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    //  end message
                }
            });
        }
        
        //Cart Increment
        function cartIncrement(rowId){
            $.ajax({
                type: 'GET',
                url: "{{ url('/cart-increment/') }}/" + rowId,
                dataType: 'json',
                success: function(data) {
                    couponCalculation();
                    cart();
                    miniCart();
                }
            });
        }
        
        //Cart Decrement
        function cartDecrement(rowId){
            $.ajax({
                type: 'GET',
                url: "{{ url('/cart-decrement/') }}/" + rowId,
                dataType: 'json',
                success: function(data) {
                    couponCalculation();
                    cart();
                    miniCart();
                }
            });
        }
        
    </script>
    
    <!-- Apply Coupon Here -->
    <script>
       function applyCoupon(){
           var coupon_name = $("#coupon_name").val();
           
           $.ajax({
               type: "POST",
               dataType: "json",
               data: {coupon_name: coupon_name},
               url: "{{ url('/coupon-apply') }}",
               success: function(data){
                   couponCalculation();
                   if(data.validity == true){
                       $('#couponField').hide();
                   }
                   //$('#couponField').css("display","none");
                   
                   //  start message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        $('#coupon_name').val('');
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    //  end message
               }
           });
       }    
       
       function couponCalculation(){
           $.ajax({
                type: 'GET',
                url: "{{ url('/coupon-calculation') }}",
                dataType: 'json',
                success: function(data) {
                    if (data.total) {
                        $('#couponCalField').html(`
                            <tr>
                            <th>
                                <div class="cart-sub-total">
                                    Subtotal<span class="inner-left-md">$${data.total}</span>
                                </div>
                                <div class="cart-grand-total">
                                    Grand Total<span class="inner-left-md">$${data.total}</span>
                                </div>

                            </th>
                        </tr>
                        `)
                    } else {
                        $('#couponCalField').html(`
                        <tr>
                            <th>
                             <div class="cart-sub-total">
                              Subtotal<span class="inner-left-md">$${data.subtotal}</span>
                                            </div>
                                            <div class="cart-sub-total">
                              Coupon<span class="inner-left-md">${data.coupon_name} </span>
                                                <button type="submit" onclick="couponRemove()"><i class="fa fa-times"></i></button>
                                            </div>
                                            <div class="cart-sub-total">
                              Discount Amount<span class="inner-left-md">$${data.discount_amount}</span>
                             </div>
                             <div class="cart-grand-total">
                              Grand Total<span class="inner-left-md">$${data.total_amount}</span>
                                            </div>

                            </th>
                        </tr>
                    `)
                    }
                }
            });
       }
       
       couponCalculation();
    </script>
    
    <!-- Remove Coupon -->
    <script>
        function couponRemove(){
            $.ajax({
                type: "GET",
                url: "{{ url('/coupon-remove') }}",
                dataType: "json",
                success: function(data){
                    couponCalculation();
                    $('#couponField').show();
                    // $('#couponField').css("display","");
                    $('#coupon_name').val('');
                    
                    //  start message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    //  end message
                }
            });
        }
    </script>
    
    <!-- If you want to use the popup integration, -->
    <script>
        var obj = {};
        obj.cus_name = $('#customer_name').val();
        obj.cus_phone = $('#mobile').val();
        obj.cus_email = $('#email').val();
        obj.cus_addr1 = $('#address').val();
        obj.amount = $('#total_amount').val();
        obj.post_code = $('#post_code').val();
        obj.division_id = $('#division_id').val();
        obj.district_id = $('#district_id').val();
        obj.state_id = $('#state_id').val();
        obj.notes = $('#notes').val();

        $('#sslczPayBtn').prop('postdata', obj);

        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);
    </script>

    <script>
        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);
    </script>

    </body>

</html>
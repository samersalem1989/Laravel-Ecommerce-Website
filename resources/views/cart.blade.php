@extends('index')

@section('content')

    <!--================Cart Area =================-->
    <section class="cart_area">
      <div class="container">
        <div class="cart_inner">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Product</th>
                  <th scope="col">Price</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Total</th>
                  <th scope="col">Delete</th>
                </tr>
              </thead>
              <tbody>
              @php $total = 0 @endphp

              @if(session('cart'))

              @foreach(session('cart') as $id => $details)

              @php $total += $details['price'] * $details['quantity'] @endphp
                <tr data-id="{{ $id }}" id="{{ $id }}">
                  <td data-th="Product" class="cart_product">
                    <div class="media">
                      <div class="d-flex">
                        <a href="{{ URL::to('single-product?item=' . $id.'&qty='. $details['quantity']) }}">
                            <img
                            src="{{asset('img/product/feature-product/').'/'. $details['image']}}"
                              alt=""
                              width="145px"
                            />
                        </a>
                      </div>
                      <div class="media-body">
                          <p class="txtwidth"><a style="color:#797979;" href="{{ URL::to('single-product?item=' . $id.'&qty='. $details['quantity']) }}"> {{$details['title']}}</a> </p> 
                      </div>
                    </div>
                  </td>
                  <td class="jquery_price">
                    <div class="media">
                    <h5 class="price_h5">{{ $details['price'] }} </h5> <h5>₪</h5>
                    </div>
                  </td>

                  <td data-th="Quantity" class="cart_quantity">
                   
                    <div class="theInputContainer">
                      <div class="icon-container">
                        <i class="theLoader"></i>
                      </div>
                    </div>
                    
                      <div class="cart_quantity_button">
                                                
                        <a class="cart_quantity_down update-cart-minus mr-1 text-success activate_myspinner" href=""> <i class="fa fa-minus" aria-hidden="true"></i></a>

                        <input class="cart_quantity_input quantity text-center" type="text" name="quantity" value="{{ $details['quantity'] }}" autocomplete="off" size="1">
                        
                        <a class="cart_quantity_up update-cart-plus ml-1 text-success activate_myspinner" href=""><i class="fa fa-plus" aria-hidden="true"></i></a>

                      </div>
							   </td>
                  <td data-th="Subtotal" class="cart_total">
                    <div class="media">
                    <h5 class="cart_total_price">{{ $details['price'] * $details['quantity'] }}</h5><h5> ₪</h5>
                    </div>
                  </td>
                  <td class="cart_delete">
                    <a class="cart_quantity_delete remove-from-cart"><i class="fa fa-times"></i></a>
                  </td>
                </tr>
                @endforeach
        				@endif     
                <tr class="out_button_area">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <div class="checkout_btn_inner">
                      <a class="gray_btn" href="{{ URL::to('/') }}" >Continue Shopping</a>
                      <a class="main_btn" href="{{ URL::to('checkout') }}">Proceed to checkout</a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <!--================End Cart Area =================-->
@endsection

<!--Start Of Cart Scripts-->
@section('scripts')	

<script type="text/javascript">

    $(".update-cart-plus").click(function (e) {

        e.preventDefault();


        var ele = $(this);

        var qty = ele.parents("tr").find(".quantity").val();
        var id = ele.parents("tr").attr("data-id");

        $('#'+id).children(".cart_quantity").children(".theInputContainer").addClass("inputcontainer");
        $('#'+id).children(".cart_quantity").children(".theInputContainer").children(".icon-container").children(".theLoader").addClass("loader");


        $.ajax({
            url: '{{ route('update.cart.plus') }}',
            method: "patch",
            data: {
                _token : '{{ csrf_token() }}',
                id: id, 
                quantity: qty,
            },

			success: function (response) {
        if (qty < 10){
              ++qty;
              $('#'+id).children(".cart_quantity").children(".cart_quantity_button").children(".cart_quantity_input").val(qty);
              var price = $('#'+id).children(".jquery_price").children(".media").children(".price_h5").text();
              var myInt = parseInt(price);
              var total = myInt * qty;
              $('#'+id).children(".cart_total").children(".media").children(".cart_total_price").text(total);
            }else{
              qty == 10;
            }
            $('#'+id).children(".cart_quantity").children(".theInputContainer").removeClass("inputcontainer");
            $('#'+id).children(".cart_quantity").children(".theInputContainer").children(".icon-container").children(".theLoader").removeClass("loader");
			}
        });
    });


	$(".update-cart-minus").click(function (e) {

		e.preventDefault();

		var ele = $(this);

    var id = ele.parents("tr").attr("data-id");
    var qty = ele.parents("tr").find(".quantity").val();

    $('#'+id).children(".cart_quantity").children(".theInputContainer").addClass("inputcontainer");
    $('#'+id).children(".cart_quantity").children(".theInputContainer").children(".icon-container").children(".theLoader").addClass("loader");


		$.ajax({
			url: '{{ route('update.cart.minus') }}',

			method: "patch",

			data: {
				_token : '{{ csrf_token() }}',
				id: id, 
				quantity: qty
			},

			success: function (response) {
        if (qty > 1){
              --qty;
              $('#'+id).children(".cart_quantity").children(".cart_quantity_button").children(".cart_quantity_input").val(qty);
              var price = $('#'+id).children(".jquery_price").children(".media").children(".price_h5").text();
              var myInt = parseInt(price);
              var total = myInt * qty;

              $('#'+id).children(".cart_total").children(".media").children(".cart_total_price").text(total);
        }else{
          qty == 1;
        }

        $('#'+id).children(".cart_quantity").children(".theInputContainer").removeClass("inputcontainer");
        $('#'+id).children(".cart_quantity").children(".theInputContainer").children(".icon-container").children(".theLoader").removeClass("loader");

      }
		});
		});

  

      $(".remove-from-cart").mouseover(function() {
            $(this).css("color","red");
            $(this).css("font-size","x-large");
        }).mouseout(function() {
            $(this).css("color","#797979");
            $(this).css("font-size","inherit");
        });


    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);

            $.ajax({

                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },

                success: function (response) {

                    var id = ele.parents("tr").attr("data-id");
                    $("#"+id).fadeOut();

                    var productsTotal = $('#badger span').text();
                                 $('#badger span').html(--productsTotal);

                    var qty = $('#'+id).children(".cart_quantity").children(".cart_quantity_button").children(".cart_quantity_input").val();
                    var price = $('#'+id).children(".jquery_price").children(".media").children(".price_h5").text();
                    var myInt = parseInt(price);
                    var total = myInt * qty;
                }

            });
    });

</script>
@endsection
 <!--/End Of Cart Scripts-->
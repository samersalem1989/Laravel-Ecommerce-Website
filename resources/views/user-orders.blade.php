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

              @foreach($userOrders as $order)

                <tr data-id="{{ $order->id }}" id="{{ $order->id }}">
                  <td data-th="Product" class="cart_product">
                    <div class="media">
                      <div class="d-flex">
                        <a href="{{ URL::to('single-product?item=' . $order->productId.'&qty='. $order->quantity) }}">
                        <img
                        src="{{asset('img/product/feature-product/').'/'. $order->image}}"
                          alt=""
                          width="145px"
                        />
                        </a>
                      </div>
                      <div class="media-body">
                        <a href="{{ URL::to('single-product?item=' . $order->productId.'&qty='. $order->quantity) }}" style="color:#797979;">
                        <p> {{$order->title}} </p>
                        </a>
                      </div>
                    </div>
                  </td>
                  <td>
                    <h5>{{$order->price}} ₪</h5>
                  </td>
                  <td data-th="Quantity" class="cart_quantity">
                    <h5>{{$order->quantity}}</h5>
				  </td>
                  <td data-th="Subtotal" class="cart_total">
                    <h5 class="cart_total_price">{{$order->total}} ₪</h5>
                  </td>
                  <td class="cart_delete">
                    <a class="cart_quantity_delete remove-from-cart"><i class="fa fa-times"></i></a>
                  </td>
                </tr><!--/Cart Products-->
                @endforeach
                       
                <tr class="out_button_area">
                  <td>{{ $userOrders->links() }}</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
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
@section('deleteOrderScript')	

<script type="text/javascript">

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

                        url: '{{ route('delete.order') }}',
                        method: "DELETE",

                        data: {
                            _token: '{{ csrf_token() }}', 
                            id: ele.parents("tr").attr("data-id")
                        },

                        success: function (response) {

                                var id = ele.parents("tr").attr("data-id");

                                $("#"+id).fadeOut();
                        }
                    });
        });



</script>

@endsection 
<!--/End Of Cart Scripts-->
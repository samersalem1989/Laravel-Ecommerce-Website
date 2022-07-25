@extends('index')

@section('content')

<!--================Home Banner Area =================-->
<section class="home_banner_area mb-40">
    <div class="banner_inner d-flex align-items-center">
      <div class="container">
        <div class="banner_content row">
          <div class="col-lg-12">
            <h3><span>Bazar</span> Smart <br />Quality <span>Shop</span></h3>
            <h4 class="text-dark">We Have All Your Needs</h4>
            <h5 class="text-dark">Safe and guaranteed</h5>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Home Banner Area =================-->

  <!-- Start feature Area -->
  <section class="feature-area section_gap_bottom_custom">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="single-feature">
              <i class="flaticon-money"></i>
              <h3>Money back gurantee</h3>
            <p>Shall open divide a one</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="single-feature">
              <i class="flaticon-truck"></i>
              <h3>Free Delivery</h3>
            <p>Shall open divide a one</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="single-feature">
              <i class="flaticon-support"></i>
              <h3>Alway support</h3>
            <p>Shall open divide a one</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="single-feature">
              <i class="flaticon-blockchain"></i>
              <h3>Secure payment</h3>
            <p>Shall open divide a one</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End feature Area -->

  <!--================ Feature Product Area =================-->
  <section class="feature_product_area section_gap_bottom_custom">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="main_title">
            <h2><span>Featured product</span></h2>
            <p>Bring called seed first of third give itself now ment</p>
          </div>
        </div>
      </div>

      <div class="row">
      @foreach ($featuredProducts as $product)
          @php $total=0;
               $count=0;
               $ordersCount =0;
          @endphp
          @foreach ($reviews as $review)
              @if ($product->id == $review->productId) 
                  @php $total+=$review->ratingValue @endphp
                  @php $count += 1 @endphp
              @endif
          @endforeach
          @foreach ($orders as $order)
              @if ($product->id == $order->productId) 
                  @php $ordersCount += 1 @endphp
              @endif
          @endforeach
          @php
          $quantity=1;
          if ($total>0){
                $average =$total / $count;
                $reviewsAverage = number_format((float) $average, 1);
              }
          @endphp

        <div class="col-lg-4 col-md-6">
          <div class="single-product">
            <div class="product-img">
             <a href="{{ URL::to('single-product?item=' . $product->id.'&qty='. $quantity) }}">
               <img class="img-fluid w-100" src={{'img/product/feature-product/'.$product->image}} alt="" />
             </a>
              <div class="p_icon" data-id="{{$product->id}}" id="{{$product->id}}">
                <a href="{{ URL::to('single-product?item=' . $product->id.'&qty='. $quantity) }}">   
                  <i class="ti-eye"></i>
                </a>
                <a href="{{ URL::to('buynow?item=' . $product->id .'&qty='. $quantity) }}">
                  <i class="fa fa-credit-card" aria-hidden="true"></i>
                </a>

                @php $cart = session()->get('cart', []); @endphp 

               @if(isset($cart[$product->id]))
               <a class="add-to-cart" href="" style="pointer-events: none; cursor: default;">
                <i class='fa fa-check' aria-hidden='true'></i>
               </a>
               <i class="fa fa-undo single_product_remove" aria-hidden="true" style="cursor: pointer; font-size:13px;margin-left: -20px;"></i>
              @else
                <a class="add-to-cart" href="">
                  <i class="fa fa-shopping-cart"></i>
                </a>
               <i class="fa fa-undo single_product_remove" aria-hidden="true" style="cursor: pointer; font-size:13px;margin-left: -20px;" hidden></i>
              @endif
              
              </div>
            </div>
            <div class="product-btm">
              <a href="{{ URL::to('single-product?item=' . $product->id.'&qty='. $quantity) }}" class="d-block">
                <h4>{{$product->title}}</h4>
              </a>
                <ul class="media list">
                      @if($count >0 )
                      <li>
                        @for($i=1;$i<$reviewsAverage;$i++)
                            <i class="fa fa-star" style="color:#fbd600;"></i>
                        @endfor
                        @if($reviewsAverage - intval($reviewsAverage)== 0 ||$reviewsAverage - intval($reviewsAverage) > 0.7 )
                          <i class="fa fa-star" style="color:#fbd600;"></i>
                          {{$reviewsAverage}}
                        @else
                          <i class="fa fa-star-half" aria-hidden="true" style="color:#fbd600;"></i>
                          {{$reviewsAverage}}
                        @endif
                      </li>
                      @else
                          <i class="fa fa-star-o" aria-hidden="true"></i>
                          <i class="fa fa-star-o" aria-hidden="true"></i>
                          <i class="fa fa-star-o" aria-hidden="true"></i>
                          <i class="fa fa-star-o" aria-hidden="true"></i>
                          <i class="fa fa-star-o" aria-hidden="true"></i>

                      @endif
                </ul>
                @if($ordersCount>0)
                  ({{$ordersCount}} Orders)
                @else
                  (0 Orders)
                @endif
              <div class="mt-3">
                <span class="mr-4">{{$product->price}} ₪ </span>
                <del>{{$product->oldprice}} ₪</del>
              </div>
            </div>
          </div>
        </div>
@endforeach
       
      </div>
    </div>
  </section>
  <!--================ End Feature Product Area =================-->

  <!--================ Offer Area =================-->
  @foreach ($feautredOffer as $offer)
  <section class="offer_area" style="background:url(../img/{{$offer->image}}) no-repeat center;background-size:cover">
    <div class="container">
      <div class="row justify-content-center">
        <div class="offset-lg-4 col-lg-6 text-center">
          <div class="offer_content">
            <h3 class="text-uppercase mb-40">{{$offer->title}}</h3>
            <h2 class="text-uppercase">{{$offer->discount}}</h2>
            <a href="#" class="main_btn mb-20 mt-5">Discover Now</a>
            <p>{{$offer->details}}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endforeach
  <!--================ End Offer Area =================-->

  <!--================ New Product Area =================-->
  <section class="new_product_area section_gap_top section_gap_bottom_custom">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="main_title">
            <h2><span>new products</span></h2>
            <p>Bring called seed first of third give itself now ment</p>
          </div>
        </div>
      </div>

      <div class="row">
        @foreach ($newOffer as $offer)
        <div class="col-lg-6">
          <div class="new_product">
            <h5 class="text-uppercase">{{$offer->details}}</h5>
            <h3 class="text-uppercase">{{$offer->title}}</h3>
            <div class="product-img">
              <img class="img-fluid" src={{'img/product/feature-product/'.$offer->image}} alt="" />
            </div>
            <h4>{{$offer->discount}}</h4>
            <a class="main_btn">Add to cart</a>
          </div>
        </div>
        @endforeach

        <div class="col-lg-6 mt-5 mt-lg-0">
          <div class="row">
            @foreach ($newProducts as $product)
                    @php
                            $total=0;
                            $count=0;
                            $ordersCount =0;
                    @endphp
                    @foreach ($reviews as $review)
                        @if ($product->id == $review->productId) 
                            @php $total+=$review->ratingValue @endphp
                            @php $count += 1 @endphp
                        @endif
                    @endforeach
                    @foreach ($orders as $order)
                        @if ($product->id == $order->productId) 
                            @php $ordersCount += 1 @endphp
                        @endif
                    @endforeach
                    @php
                            $quantity=1;
                            if ($total>0){
                            $average =$total / $count;
                            $reviewsAverage = number_format((float) $average, 1);
                            }
                    @endphp

            <div class="col-lg-6 col-md-6">
              <div class="single-product">
                <div class="product-img">
                  <a href="{{ URL::to('single-product?item=' . $product->id.'&qty='. $quantity) }}">
                     <img class="img-fluid w-100" src={{'img/product/feature-product/'.$product->image}} alt="" />
                  </a>
                  <div class="p_icon" data-id="{{$product->id}}" id="{{$product->id}}">
                    <a href="{{ URL::to('single-product?item=' . $product->id.'&qty='. $quantity) }}">
                      <i class="ti-eye"></i>
                    </a>
                    <a href="{{ URL::to('buynow?item=' . $product->id .'&qty='. $quantity) }}">
                      <i class="fa fa-credit-card" aria-hidden="true"></i>
                    </a>
                    @php $cart = session()->get('cart', []); @endphp 

                    @if(isset($cart[$product->id]))
                    <a class="add-to-cart" href="" style="pointer-events: none; cursor: default;">
                     <i class='fa fa-check' aria-hidden='true'></i>
                   </a>
                   @else
                     <a class="add-to-cart" href="">
                       <i class="fa fa-shopping-cart"></i>
                     </a>
                   @endif
                  </div>
                </div>
                <div class="product-btm">
                  <a href="{{ URL::to('single-product?item=' . $product->id.'&qty='. $quantity) }}" class="d-block">
                    <h4>{{$product->title}}</h4>
                  </a>
                  <ul class="media list">
                    @if($count >0 )
                    <li>
                      @for($i=1;$i<$reviewsAverage;$i++)
                          <i class="fa fa-star" style="color:#fbd600;"></i>
                      @endfor
                      @if($reviewsAverage - intval($reviewsAverage)== 0 ||$reviewsAverage - intval($reviewsAverage) > 0.7 )
                        <i class="fa fa-star" style="color:#fbd600;"></i>
                        {{$reviewsAverage}}
                      @else
                        <i class="fa fa-star-half" aria-hidden="true" style="color:#fbd600;"></i>
                        {{$reviewsAverage}}
                      @endif
                    </li>
                    @else
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    @endif
              </ul>
              @if($ordersCount>0)
                ({{$ordersCount}} Orders)
              @else
                (0 Orders)
              @endif
                  <div class="mt-3">
                    <span class="mr-4">{{$product->price}} ₪</span>
                    <del>{{$product->oldprice}} ₪</del>
                  </div>
                </div>
              </div>
            </div>
            @endforeach

          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================ End New Product Area =================-->

  <!--================ Inspired Product Area =================-->
  <section class="inspired_product_area section_gap_bottom_custom">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="main_title">
            <h2><span>Inspired products</span></h2>
            <p>Bring called seed first of third give itself now ment</p>
          </div>
        </div>
      </div>

      <div class="row">
        @foreach ($inspiredProducts as $product)
        @php
                $total=0;
                $count=0;
                $ordersCount =0;
        @endphp
        @foreach ($reviews as $review)
            @if ($product->id == $review->productId) 
                @php $total+=$review->ratingValue @endphp
                @php $count += 1 @endphp
            @endif
        @endforeach
        @foreach ($orders as $order)
            @if ($product->id == $order->productId) 
                @php $ordersCount += 1 @endphp
            @endif
        @endforeach
        @php
                $quantity=1;
                if ($total>0){
                $average =$total / $count;
                $reviewsAverage = number_format((float) $average, 1);
                }
        @endphp
        <div class="col-lg-3 col-md-6">
          <div class="single-product">
            <div class="product-img">
              <a href="{{ URL::to('single-product?item=' . $product->id.'&qty='. $quantity) }}">
                <img class="img-fluid w-100" src={{'img/product/feature-product/'.$product->image}} alt="" />
              </a>
              <div class="p_icon" data-id="{{$product->id}}" id="{{$product->id}}">
                <a href="{{ URL::to('single-product?item=' . $product->id.'&qty='. $quantity) }}">
                  <i class="ti-eye"></i>
                </a>
                <a href="{{ URL::to('buynow?item=' . $product->id .'&qty='. $quantity) }}">
                  <i class="fa fa-credit-card" aria-hidden="true"></i>
                </a>
                @php $cart = session()->get('cart', []); @endphp 

                @if(isset($cart[$product->id]))
                <a class="add-to-cart" href="" style="pointer-events: none; cursor: default;">
                 <i class='fa fa-check' aria-hidden='true'></i>
               </a>
               @else
                 <a class="add-to-cart" href="">
                   <i class="fa fa-shopping-cart"></i>
                 </a>
               @endif
              </div>
            </div>
            <div class="product-btm">
              <a href="{{ URL::to('single-product?item=' . $product->id.'&qty='. $quantity) }}" class="d-block">
                <h4>{{$product->title}}</h4>
              </a>
              <ul class="media list">
                  @if($count >0 )
                  <li>
                    @for($i=1;$i<$reviewsAverage;$i++)
                        <i class="fa fa-star" style="color:#fbd600;"></i>
                    @endfor
                    @if($reviewsAverage - intval($reviewsAverage)== 0 ||$reviewsAverage - intval($reviewsAverage) > 0.7 )
                      <i class="fa fa-star" style="color:#fbd600;"></i>
                      {{$reviewsAverage}}
                    @else
                      <i class="fa fa-star-half" aria-hidden="true" style="color:#fbd600;"></i>
                      {{$reviewsAverage}}
                    @endif
                  </li>
                  @else
                      <i class="fa fa-star-o" aria-hidden="true"></i>
                      <i class="fa fa-star-o" aria-hidden="true"></i>
                      <i class="fa fa-star-o" aria-hidden="true"></i>
                      <i class="fa fa-star-o" aria-hidden="true"></i>
                      <i class="fa fa-star-o" aria-hidden="true"></i>
                  @endif
             </ul>
              @if($ordersCount>0)
                ({{$ordersCount}} Orders)
              @else
                (0 Orders)
              @endif
              <div class="mt-3">
                <span class="mr-4">{{$product->price}} ₪</span>
                <del>{{$product->oldprice}} ₪</del>
              </div>
            </div>
          </div>
        </div>
@endforeach
      
      </div>
    </div>
  </section>
  <!--================ End Inspired Product Area =================-->
  @endsection

<!--Start Of Cart Scripts-->
@section('cartscript')	
  <script type="text/javascript">

        document.addEventListener("DOMContentLoaded", function(event) { 
                    var scrollpos = localStorage.getItem('scrollpos');
                    if (scrollpos) window.scrollTo(0, scrollpos);
                });

                window.onbeforeunload = function(e) {
                    localStorage.setItem('scrollpos', window.scrollY);
                };

                
                $(".add-to-cart").click(function (e) {
                      e.preventDefault();
                      var ele = $(this);

                          $.ajax({
                              url: '{{ route('add.to.cart') }}',
                              method: "GET",
                              data: {
                                  id: ele.parents("div").attr("data-id"),
                                  quantity: 1
                              },

                              success: function (response) {

                                var id = ele.parents("div").attr("data-id");
                                $('#'+id).children(".add-to-cart").html("<i class='fa fa-check' aria-hidden='true'></i>");

                                 var total = $('#badger span').text();
                                 $('#badger span').html(++total);

                                 $('#'+id).children(".add-to-cart").css({"pointer-events": "none", "cursor": "default"});

                                 $('#'+id).children(".single_product_remove").removeAttr('hidden');
                              }
                          });
                      });


                      $(".single_product_remove").click(function (e) {

                              e.preventDefault();
                              var ele = $(this);

                              $.ajax({
                              url: '{{ route('remove.from.cart') }}',
                              method: "DELETE",

                              data: {
                                  _token: '{{ csrf_token() }}', 
                                  id: ele.parents("div").attr("data-id"),
                              },

                              success: function (response) {

                                  var id = ele.parents("div").attr("data-id");
                                  $('#'+id).children(".add-to-cart").html("<i class='fa fa-shopping-cart' aria-hidden='true'></i>");

                                  var total = $('#badger span').text();
                                  $('#badger span').html(--total);

                                  $('#'+id).children(".add-to-cart").css({"pointer-events": "auto", "cursor": "pointer"});
                                  ele.attr("hidden","hidden");

                              }

                              });
                      });
</script>
@endsection 
<!--End Of Cart Scripts-->
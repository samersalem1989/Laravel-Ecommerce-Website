@extends('index')

@section('content')
    
    <!--================Single Product Area =================-->
    <div class="product_image_area">
      <div class="container">
      @foreach ($onlyRequestedItem as $product)
        <div class="row s_product_inner">
          <div class="col-lg-6">
            <div class="s_product_img">
              <div
                id="carouselExampleIndicators"
                class="carousel slide"
                data-ride="carousel"
              >
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img
                      class="d-block w-100"
                      src="{{asset('img/product/feature-product/').'/'. $product->image}}"
                      alt="First slide"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5 offset-lg-1" data-id="{{$product->id}}" id="myId" orders-count={{$ordersCount}}>
            <div class="s_product_text">
                <h3>{{$product->title}}</h3>
                  <h2>{{$product->price}} ₪ <del>{{$product->oldprice}} ₪</del></h2>
                  <ul class="list">
                    @if(count($reviews)>0)
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
  
                    <li>
                      <a>
                      <span>Orders</span> : {{$ordersCount}}
                      </a>
                    </li>

                    <li>
                      <a class="active" href="{{ URL::to('category?name=' . $product->category) }}">
                      <span>Category</span> : {{$product->category}}
                      </a>
                    </li>
                    <li>
                      <a> <span>Availibility</span> : In Stock</a>
                    </li>
                  </ul>
                  <p>
                  {{$product->description}}
                  </p>

                <div class="media">
                  <div class="product_count">
                    <label for="qty">Quantity:</label>
                    <input
                      type="text"
                      name="qty"
                      id="sst"
                      maxlength="12"
                      value="{{$quantity}}"
                      title="Quantity:"
                      class="input-text qty"
                      {{$disabled}}
                    />
                    <button
                      onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )&amp;&amp; sst < 10) result.value++;return false;"
                      class="increase items-count"
                      type="button"
                      style="{{$itemsCountCss}}"
                      {{$disabled}}
                    >
                    <i class="lnr lnr-chevron-up"></i>
                  </button>

                    <button
                      onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 1 ) result.value--;return false;"
                      class="reduced items-count"
                      type="button"
                      style="{{$itemsCountCss}}"
                      {{$disabled}}
                    >
                      <i class="lnr lnr-chevron-down"></i>
                    </button>
                  </div>
                    <a class="main_btn single_product_add ml-3" href="" style="{{$main_btnCss}}"><i class="{{$main_btnText}}" aria-hidden='true'></i></a>
                    <div class="remove mt-2">
                      <a class='single_product_remove ml-2' style="cursor: pointer; font-size:13px;" {{$hidden}}><i class="fa fa-undo" aria-hidden="true"></i></a>
                    </div>
                </div>
                  
                  <div class="card_area">
                  <div class="checkout_btn_inner mt-5">
                    <a class="gray_btn" href="{{ URL::to('/') }}" >Continue Shopping</a>
                    <a class="main_btn buy-now" href="">Buy Now</a>                 
                  </div>  
                    
                  </div>
             </div>
          </div>
        </div>
      </div>
    </div>
    <!--================End Single Product Area =================-->
    <section class="product_description_area">
      <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a
              class="nav-link"
              id="home-tab"
              data-toggle="tab"
              href="#home"
              role="tab"
              aria-controls="home"
              aria-selected="true"
              >Description</a
            >
          </li>
          <li class="nav-item">
            <a
              class="nav-link"
              id="profile-tab"
              data-toggle="tab"
              href="#profile"
              role="tab"
              aria-controls="profile"
              aria-selected="false"
              >Specification</a
            >
          </li>
          <li class="nav-item">
            <a
              class="nav-link active"
              id="contact-tab"
              data-toggle="tab"
              href="#contact"
              role="tab"
              aria-controls="contact"
              aria-selected="false"
              >All Reviews</a
            >
          </li>
          <li class="nav-item">
            <a
              class="nav-link"
              id="review-tab"
              data-toggle="tab"
              href="#review"
              role="tab"
              aria-controls="review"
              aria-selected="false"
              >Add Review</a
            >
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div
            class="tab-pane fade"
            id="home"
            role="tabpanel"
            aria-labelledby="home-tab"
          >
          <p>{!! nl2br(e($product->singleProductDescription)) !!}</p>
          </div>
          <div
            class="tab-pane fade"
            id="profile"
            role="tabpanel"
            aria-labelledby="profile-tab"
          >
            <div class="table-responsive">
              <table class="table">
                <tbody>
                  <tr>
                    <td>
                      <h5>Width</h5>
                    </td>
                    <td>
                      <h5>{{$product->width}}</h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Height</h5>
                    </td>
                    <td>
                      <h5>{{$product->height}}</h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Depth</h5>
                    </td>
                    <td>
                      <h5>{{$product->depth}}</h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Weight</h5>
                    </td>
                    <td>
                      <h5>{{$product->weight}}</h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Each Box contains</h5>
                    </td>
                    <td>
                      <h5>{{$product->contains}}</h5>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div
            class="tab-pane fade show active"
            id="contact"
            role="tabpanel"
            aria-labelledby="contact-tab"
          >
            <div class="row">
              @foreach($reviews as $review)
              <div class="col-lg-12">
                <div class="comment_list">
                  <div class="review_item">
                    <div class="media">
                      <div class="d-flex">
                          @if($review->profilePhoto != null)
                               <img class="rounded-img" src={{'img/'.$review->profilePhoto}}>
                          @else
                              <img
                              src="img/product/single-product/review-1.png"
                              alt=""
                              />    
                          @endif
                      </div>
                      <div class="media-body">
                        <h4>{{$review->userName}}</h4>
                        <h5>{{$review->created_at}}</h5>
                        @for($i=0;$i<$review->ratingValue;$i++)
                             <i class="fa fa-star"></i>
                        @endfor
                      </div>
                      <p id="review-text">
                        {{$review->text}}
                      </p>
  
                    </div>
                    <hr>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <div
            class="tab-pane fade"
            id="review"
            role="tabpanel"
            aria-labelledby="review-tab"
          >
            <div class="row">

                @if (Auth::check() && count($ordersId)>0)
                
               <div class="col-lg-6" id="successReviewing">
                <div class="review_box">
                  <h4>Add a Review</h4>
                  <img alt='tick image' width='32' src='data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA0MjYuNjY3IDQyNi42NjciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQyNi42NjcgNDI2LjY2NzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxwYXRoIHN0eWxlPSJmaWxsOiM2QUMyNTk7IiBkPSJNMjEzLjMzMywwQzk1LjUxOCwwLDAsOTUuNTE0LDAsMjEzLjMzM3M5NS41MTgsMjEzLjMzMywyMTMuMzMzLDIxMy4zMzMgIGMxMTcuODI4LDAsMjEzLjMzMy05NS41MTQsMjEzLjMzMy0yMTMuMzMzUzMzMS4xNTcsMCwyMTMuMzMzLDB6IE0xNzQuMTk5LDMyMi45MThsLTkzLjkzNS05My45MzFsMzEuMzA5LTMxLjMwOWw2Mi42MjYsNjIuNjIyICBsMTQwLjg5NC0xNDAuODk4bDMxLjMwOSwzMS4zMDlMMTc0LjE5OSwzMjIuOTE4eiIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K'/>
                  <p>Your Rating:</p>
                  <ul class="list" id="stars">
                    <li class='star' title='Poor' data-value='1'>
                        <i class="fa fa-star" id="oneStar"></i>
                    </li>
                    <li class='star' title='Fair' data-value='2'>
                        <i class="fa fa-star" id="twoStars"></i>
                    </li>
                    <li class='star' title='Good' data-value='3'>
                        <i class="fa fa-star" id="threeStars"></i>
                    </li>
                    <li class='star' title='Excellent' data-value='4'>
                        <i class="fa fa-star" id="fourStars"></i>
                    </li>
                    <li class='star' title='WOW!!!' data-value='5'>
                        <i class="fa fa-star" id="fiveStars"></i>
                    </li>
                  </ul>
                  <div class='success-box'>
                    <div class='clearfix'></div>
                    <div class='text-message'></div>
                    <div class='clearfix'></div>
                  </div>
  
                  <form
                    class="row contact_form"
                    method="post"
                    id="contactForm"
                    novalidate="novalidate"
                  >
                  @csrf
                    <div class="col-md-12">
                      <div class="form-group">
                        <textarea
                          class="form-control"
                          name="message"
                          id="message"
                          rows="1"
                          placeholder="Review"
                          style="height: 210px"
                        ></textarea>
                      </div>
                    </div>
                    <div class="col-md-12 text-right" id={{Auth::user()->id}} username="{{Auth::user()->name .' '. Auth::user()->lastname}}" userimage="{{Auth::user()->profilePhoto}}">
                      <button
                        type="submit"
                        value="submit"
                        class="btn submit_btn add_review"
                      >
                        Submit
                      </button>
                    </div>
                  </form>
                </div>
              </div>        
              @elseif (Auth::check()) 
                  <h5 style="font-family: 'Roboto',sans-serif"> *** You have to buy this item to review it *** </h5>
              @else
                  <h5 style="font-family: 'Roboto',sans-serif"> *** Please<a href="login"> Login</a> to leave a review *** </h5>
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>
    @endforeach


    @endsection

@section('singleProductScripts')	<!--Cart Scripts-->
  <script type="text/javascript">

  
    $(document).ready(function(){
  
          /* 1. Visualizing things on Hover - See next part for action on click */
          $('#stars li').on('mouseover', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
          
            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function(e){
              if (e < onStar) {
                $(this).addClass('hover');
              }
              else {
                $(this).removeClass('hover');
              }
            });
            
          }).on('mouseout', function(){
            $(this).parent().children('li.star').each(function(e){
              $(this).removeClass('hover');
            });
          });
          
          
          /* 2. Action to perform on click */
          $('#stars li').on('click', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');
            
            for (i = 0; i < stars.length; i++) {
              $(stars[i]).removeClass('selected');
            }
            
            for (i = 0; i < onStar; i++) {
              $(stars[i]).addClass('selected');
            }
            
            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            var msg = "";
            if (ratingValue > 1) {
                msg = "Thanks! You rated this " + ratingValue + " stars.";
            }
            else {
                msg = "Thanks! You rated this " + ratingValue + " stars.";
            }
            responseMessage(msg);
            
          });
          
  
    });

        function responseMessage(msg) {
          $('.success-box').fadeIn(200);  
          $('.success-box div.text-message').html("<span>" + msg + "</span>");
        }

    // add review
        $(".add_review").click(function (e) {

            e.preventDefault();

            var ele = $(this);
            var userId= ele.parents("div").attr("id");
            var userName= ele.parents("div").attr("username");
            var userImage= ele.parents("div").attr("userimage");
            var productId= $("#myId").attr("data-id");
            var text = $("#message").val();
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);

            $.ajax({
                url: '{{ route('add.review') }}',
                method: "POST",

                data: {
                    _token : '{{ csrf_token() }}',
                    userId: userId,                   
                    productId:productId,
                    userName:userName,
                    userImage:userImage,
                    text: text,
                    ratingValue: ratingValue,                   
                },

              success: function (response) {
                  console.log(userImage);
                  $('#successReviewing').html("<h5 style='font-family: 'Roboto',sans-serif'>Thanks for reviewing !</h5>");
              }
            });
        });



    // // Add To Cart
    $(".single_product_add").click(function (e) {

        e.preventDefault();

        var ele = $(this);
        var quantity = $('#sst').val();
        var id= $("#myId").attr("data-id");


        $.ajax({
            url: '{{ route('add.single.product.to.cart') }}',
            method: "GET",

            data: {
                _token : '{{ csrf_token() }}',
                id: id, 
                quantity: quantity,
            },

          success: function (response) {

            var productsTotal = $('#badger span').text();

            $('#badger span').html(++productsTotal);
            
            $(".single_product_add").css({"pointer-events": "none", "cursor": "default"});
            $(".single_product_add").html("<i class='fa fa-check' aria-hidden='true'></i>");
            $(".items-count").prop('disabled', true);
            $(".items-count").css({"pointer-events": "none", "cursor": "default"});
            $("#sst").prop('disabled', true);
            $('.single_product_remove').removeAttr('hidden');
          }
        });


        $(".items-count").click(function () {

          $(".single_product_add").html("<i class='fa fa-shopping-cart' aria-hidden='true'></i>");
          $(".single_product_add").css({"pointer-events": "auto", "cursor": "pointer"});
          $(".items-count").css({"pointer-events": "auto", "cursor": "pointer"});
        });
    });


    // Buy Now!!!
    $(".buy-now").click(function (e) {

        e.preventDefault();

        var ele = $(this);
        var quantity = $('#sst').val();
        var id= $("#myId").attr("data-id");

        $.ajax({
            url: '{{ route('buynow.single.product') }}',
            method: "GET",

            data: {
                _token : '{{ csrf_token() }}',
                id: id, 
                quantity: quantity,
            },

          success: function (response) {

            var productsTotal = $('#badger span').text();

            $('#badger span').html(++productsTotal);
            
            $(".single_product_add").css({"pointer-events": "none", "cursor": "default"});
            $(".single_product_add").html("<i class='fa fa-check' aria-hidden='true'></i>");

            $(".items-count").prop('disabled', true);
            $(".items-count").css({"pointer-events": "none", "cursor": "default"});
            $("#sst").prop('disabled', true);
            $('.single_product_remove').removeAttr('hidden');

            location.href="checkout";
          }
        });


        $(".items-count").click(function () {

          $(".single_product_add").html("<i class='fa fa-shopping-cart' aria-hidden='true'></i>");
          $(".single_product_add").css({"pointer-events": "auto", "cursor": "pointer"});
          $(".items-count").css({"pointer-events": "auto", "cursor": "pointer"});
        });
    });

    
    // Remove From Cart (Undo)

    $(".single_product_remove").click(function (e) {

        e.preventDefault();

        var ele = $(this);
        var id= $("#myId").attr("data-id");

       $.ajax({

        url: '{{ route('remove.from.cart') }}',
        method: "DELETE",

        data: {
            _token: '{{ csrf_token() }}', 
            id: id
        },

        success: function (response) {

            var productsTotal = $('#badger span').text();
                        $('#badger span').html(--productsTotal);
                        $(".single_product_add").html("<i class='fa fa-shopping-cart' aria-hidden='true'></i>");
                        $(".single_product_add").css({"pointer-events": "auto", "cursor": "pointer"});
                        $(".items-count").css({"pointer-events": "auto", "cursor": "pointer"});
                        $(".items-count").removeAttr('disabled');
                        $('.single_product_remove').attr('hidden','hidden');
                        $("#sst").removeAttr('disabled');
        }
    });
});
 
    </script> 
@endsection
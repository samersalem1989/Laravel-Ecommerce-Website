@extends('index')

@section('content')

    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap mt-2">
      <div class="container">
        <div class="billing_details">
          <div class="row">
            <div class="col-lg-7">
              <h3>Billing Details</h3>
              <form
                class="contact_form"
                action="checkout"
                method="POST"
                novalidate="novalidate"
              >
              <div class="col-md-9 form-group p_star">
                *First name :<input
                type="text"
                class="form-control"
                id="first"
                name="firstname"
                value = "{{$userData['userName']}}"
            />
            @if ($errors->first('firstname'))
                <p class="text-danger">{{$errors->first('firstname')}}</p>
            @endif
            </div>
            <div class="col-md-9 form-group p_star">
                *Last name :<input
                type="text"
                class="form-control"
                id="last"
                name="lastname"
                value = "{{$userData['userLastname']}}"
            />
            @if ($errors->first('lastname'))
                <p class="text-danger">{{$errors->first('lastname')}}</p>
            @endif
            </div>

            <div class="col-md-9 form-group p_star">
                *Phone number :<input
                type="text"
                class="form-control"
                id="number"
                name="phone"
                value = "{{$userData['userPhone']}}"
            />
            @if ($errors->first('phone'))
                <p class="text-danger">{{$errors->first('phone')}}</p>
            @endif

            </div>
            <div class="col-md-9 form-group p_star">
                *Email Address :<input
                type="text"
                class="form-control"
                id="email"
                name="email"
                value = "{{$userData['userEmail']}}"
            />
            @if ($errors->first('email'))
                <p class="text-danger">{{$errors->first('email')}}</p>
            @endif
            </div>

            <div class="col-md-9 form-group p_star">
                *Address :<input
                type="text"
                class="form-control"
                id="address"
                name="address"
                value = "{{$userData['userAddress']}}"
            />
            @if ($errors->first('address'))
                <p class="text-danger">{{$errors->first('address')}}</p>
            @endif

            </div>
            <div class="col-md-9 form-group p_star">
                *City :<input
                type="text"
                class="form-control"
                id="city"
                name="city"
                value = "{{$userData['userCity']}}"
            />
            @if ($errors->first('city'))
                <p class="text-danger">{{$errors->first('city')}}</p>
            @endif

            </div>
            <br><br>
            <div class="col-md-6">
                <button class="main_btn" type="submit">Proceed to Payment</button>
            </div>
              </form>

              <br>
              @php $total = 0;
                  if(!isset($payIframe)){
                    $payIframe = '';
                  };
                  @endphp
            </div>
            <div class="col-lg-5 mt-5">
              <div class="order_box">
                <h2>Your Order</h2>
                <ul class="list" >
                  <li>
                    <a href="#"
                      >Product
                      <span>Total</span>
                    </a>
                  </li>

                  @if(session('cart'))

                  @foreach(session('cart') as $id => $details)

                  @php $total += $details['price'] * $details['quantity'] @endphp

                  <li>
                    <a href=""
                      >{{ $details['quantity'] }}  {{$details['title']}}
                      <span class="last">${{ $details['price'] * $details['quantity'] }} ₪</span>
                    </a>
                  </li>
                  @endforeach
                </ul>               
                @endif

                <div class="payment_item active mt-5">
                  <ul class="list list_2">
                    <li>
                      <a href="#"
                        >Total: {{ $total }} ₪
                        <span><img src="img/product/single-product/card.jpg" alt="" /></span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Checkout Area =================-->
@endsection
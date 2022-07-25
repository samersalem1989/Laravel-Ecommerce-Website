@extends('index')

@section('content')

<!--================Home Banner Area =================-->
<section class="home_banner_area mb-40">
    <div class="banner_inner d-flex align-items-center">
      <div class="container">
        <div class="banner_content row">
          <div class="col-lg-12">
            <h3><span>Thank</span> You <br />For <span>Buying</span></h3>
            <h4 class="text-dark">You will get your order as soon as possible</h4>
            <h5 class="text-dark">Email has been sent to you</h5>
            <a class="main_btn mt-40" href="{{url('/')}}">Back to home page</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Home Banner Area =================-->
  @endsection

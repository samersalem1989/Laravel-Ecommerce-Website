@extends('index')

@section('content')

  @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
  @endif

<section class="user_details section_gap" style="padding:100px;">
<div class="container">
    <div class="billing_details">
        <div class="row">
          <div class="col-lg-8">
            <div class="media">
            @if (Auth::user()->profilePhoto != null)
                 <img class="rounded-img" src="img/{{ Auth::user()->profilePhoto }}">
            @else
                 <img  class="rounded-img" src="img/product/single-product/review-1.png" alt=""/> 
            @endif
            <h3>Fill Your Details</h3>
            </div>
            <form
            class="row contact_form"
            style="padding-top:5px;"
            action="{{ url('update-userinfo/'.Auth::user()->id) }}" 
            method="POST"
            novalidate="novalidate"
            enctype="multipart/form-data"
            >
            @csrf
            @method('PUT')
            <div class="col-md-6 form-group p_star">
                *First name :<input
                type="text"
                class="form-control"
                id="first"
                name="firstname"
                value = "{{Auth::user()->name}}"
            />
            @if ($errors->first('firstname'))
                <p class="text-danger">{{$errors->first('firstname')}}</p>
            @endif
            </div>
            <div class="col-md-6 form-group p_star">
                *Last name :<input
                type="text"
                class="form-control"
                id="last"
                name="lastname"
                value = "{{Auth::user()->lastname}}"
            />
            @if ($errors->first('lastname'))
                <p class="text-danger">{{$errors->first('lastname')}}</p>
            @endif
            </div>

            <div class="col-md-6 form-group p_star">
                *Phone number :<input
                type="text"
                class="form-control"
                id="number"
                name="phone"
                value = "{{Auth::user()->phone}}"
            />
            @if ($errors->first('phone'))
                <p class="text-danger">{{$errors->first('phone')}}</p>
            @endif

            </div>
            <div class="col-md-6 form-group p_star">
                *Email Address :<input
                type="text"
                class="form-control"
                id="email"
                name="email"
                value = "{{Auth::user()->email}}"
            />
            @if ($errors->first('email'))
                <p class="text-danger">{{$errors->first('email')}}</p>
            @endif

            </div>

            <div class="col-md-6 form-group p_star">
                *Address :<input
                type="text"
                class="form-control"
                id="address"
                name="address"
                value = "{{Auth::user()->address}}"
            />
            @if ($errors->first('address'))
                <p class="text-danger">{{$errors->first('address')}}</p>
            @endif

            </div>
            <div class="col-md-6 form-group p_star">
                *City :<input
                type="text"
                class="form-control"
                id="city"
                name="city"
                value = "{{Auth::user()->city}}"
            />
            @if ($errors->first('city'))
                <p class="text-danger">{{$errors->first('city')}}</p>
            @endif

            </div>

            <div class="col-md-6 form-group p_star">
              Image: (not required)<input type="file" name="image" class="form-control">
              @if ($errors->first('image'))
              <p class="text-danger">{{$errors->first('image')}}</p>
              @endif
           </div>

            <button class="main_btn btn-lg btn-block" id="updateProfileDetailsBtn" type="submit">Update Details</button>

            </form>

    
          </div>
        </div>
    </div>
</div>
</section>

@endsection
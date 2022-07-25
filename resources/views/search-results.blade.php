@extends('index')

@section('content')

  <!--================ Feature Product Area =================-->
  <section class="feature_product_area section_gap_bottom_custom">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="main_title">
            <h2><span>Search Results</span></h2>
            <p>{{ $products->total() }} result(s) for '{{ request()->input('query') }}'</p>
            @if ($errors->first('query'))
            <p class="text-danger">{{$errors->first('query')}}</p>
       @endif
    
          </div>
        </div>
      </div>

      <div class="row">
      @foreach ($products as $product)
      @php $quantity=1 @endphp
        <div class="col-lg-4 col-md-6">
          <div class="single-product">
            <div class="product-img">
              <img class="img-fluid w-100" src={{'img/product/feature-product/'.$product->image}} alt="" />
              <div class="p_icon">
                <a href="{{ URL::to('single-product?item=' . $product->id.'&qty='. $quantity) }}">   
                  <i class="ti-eye"></i>
                </a>
                <a href="#">
                  <i class="ti-heart"></i>
                </a>
                <a href="{{ URL::to('add-to-cart?item=' . $product->id .'&qty='. $quantity) }}">
                  <i class="ti-shopping-cart"></i>
                </a>
              </div>
            </div>
            <div class="product-btm">
              <a href="#" class="d-block">
                <h4>{{$product->title}}</h4>
              </a>
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
        {{ $products->appends(request()->input())->links() }}
  @endsection

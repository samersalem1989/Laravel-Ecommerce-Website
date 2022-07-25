@extends('index')

@section('content')

    <!--================Category Product Area =================-->
    <section class="cat_product_area section_gap mt-5 mb-5" style="padding:50px;">
      <div class="container">
        <div class="row flex-row-reverse">
          <div class="col-lg-9">            
            <div class="latest_product_inner">
              <div class="row">
                @foreach ($products as $product)
                @php $quantity=1 @endphp
                <div class="col-lg-4 col-md-6">
                  <div class="single-product">
                    <div class="product-img">
                      <img
                        class="card-img"
                        src={{'img/product/feature-product/'.$product->image}}
                        alt=""
                      />
                      <div class="p_icon">
                        <a href="{{ URL::to('single-product?item=' . $product->id.'&qty='. $quantity) }}"> 
                          <i class="ti-eye"></i>
                        </a>
                        <a href="{{ URL::to('buynow?item=' . $product->id .'&qty='. $quantity) }}">
                          <i class="fa fa-credit-card" aria-hidden="true"></i>
                        </a>
                        <a href="{{ URL::to('add-to-cart?item=' . $product->id .'&qty='. $quantity) }}">
                          <i class="ti-shopping-cart"></i>
                        </a>
                      </div>
                    </div>
                    <div class="product-btm">
                      <a href="{{ URL::to('single-product?item=' . $product->id.'&qty='. $quantity) }}" class="d-block">
                      <a href="" class="d-block">
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
          </div>

          <div class="col-lg-3">
            <div class="left_sidebar_area">
              <aside class="left_widgets p_filter_widgets">
                <div class="l_w_title">
                  <h3>Browse Categories</h3>
                </div>
                <div class="widgets_inner">
                  <ul class="list">
                @foreach ($categories as $category)
                    <li class="{{$category->name == $categoryName ? 'active' : ''}}">
                        <a href="{{ URL::to('category?name=' . $category->name) }}">{{$category->name}}</a>
                    </li>
                @endforeach
                  </ul>
                </div>
              </aside>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Category Product Area =================-->
    @endsection
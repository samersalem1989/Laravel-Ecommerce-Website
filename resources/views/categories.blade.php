@extends('index')

@section('content')

    <!--================Category Product Area =================-->
    <section class="cat_product_area section_gap mt-5">
      <div class="container">
        <div class="row flex-row-reverse">
          <div class="col-lg-9">            
            <div class="latest_product_inner">
              <div class="row">
                @foreach ($categories as $category)
                <div class="col-lg-4 col-md-6">
                  <div class="single-product">
                    <div class="product-img">
                      <a href="{{ URL::to('category?name=' . $category->name) }}" class="d-block">
                        <img
                          class="card-img"
                          src={{'img/product/feature-product/'.$category->image}}
                          alt=""
                        />
                      </a>
                    </div>
                    <div class="product-btm">
                      <a href="{{ URL::to('category?name=' . $category->name) }}" class="d-block">
                        <h4>{{$category->name}}</h4>
                      </a>
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
                  <h3>Categories</h3>
                </div>
                <div class="widgets_inner">
                  <ul class="list">
                @foreach ($categories as $category)
                    <li class='{{Request::is("category?name=$category->name") ? 'active' : ''}}'>
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
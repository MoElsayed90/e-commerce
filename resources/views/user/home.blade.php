@extends('user.layout')

@section('latest')
@

<div class="latest-products">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Latest Products</h2>
            <a href="">view all products <i class="fa fa-angle-right"></i></a>

            <form action="{{ url('search') }}" method="get">

                <input type="text" name="key" placeholder="Search product..." class="form-control mt-4">
                <button type="submit" class="btn btn-info m-2">search</button>


            </form>
            @include('success')

          </div>
        </div>
        @foreach ($products  as $product )


        <div class="col-md-4">
            <div class="product-item">
            <a href="#"><img src="{{asset("storage/$product->image")}}" alt=""></a>
            <div class="down-content">
              <a href="{{url("Products/$product->id")}}"><h4>{{$product->name}}</h4></a>
              <h6>{{$product->price}}</h6>
              <p>{{$product->desc}}</p>
              <form action="{{url("addToCart/$product->id")}}" method="post">
                @csrf
                <input type="number" class="w-25" name="qty" id="">
                <button type="submit" class="btn btn-info ">Add to cart</button>
              </form>
              <ul class="stars">
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
              </ul>
              <span>Reviews (24)</span>
            </div>
          </div>
        </div>

        @endforeach
      </div>
    </div>
  </div>

@endsection
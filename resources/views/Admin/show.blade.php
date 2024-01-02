@extends('Admin.layout')


@section('body')
    @include('success')





                <div class="card d-flex" style="width: 18rem;">
                    <img src="{{ asset("storage/$product->image") }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"> {{__("message.product Name")}} : {{ $product->name }}</h5>
                        <p class="card-text">{{__("message.product desc")}} : {{ $product->desc }}</p>
                        <h6>{{__("message.product Price")}}: {{ $product->price }}</h6>
                        <h6>{{__("message.product quantity")}} : {{ $product->quantity }}</h6>
                        <a href="{{url("products/edit/$product->id")}}"> <button type="button" class="btn btn-success">{{__("message.edit")}}</button></a>
                        <form action="{{url("products/$product->id")}}" method="post" class="pt-1" >
                            @csrf
                            @method("DELETE")
                            <a href=""> <button type="submit" class="btn btn-danger">{{__('message.delete')}}</button></a>
                        </form>
                    </div>
                </div>








@endsection

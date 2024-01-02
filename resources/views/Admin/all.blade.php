@extends('Admin.layout')


@section('body')
@include("success")

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">{{__("message.Name")}}</th>
        {{-- <th scope="col">desc</th> --}}
        <th scope="col">{{__("message.Price")}}</th>
        <th scope="col">{{__("message.Quantity")}}</th>
        <th scope="col">{{__("message.image")}}</th>
        <th scope="col">{{__("message.Action")}}</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
      <tr>
          <th scope="row">{{$loop->iteration}}</th>
        <td>{{$product->name}}</td>
        {{-- <td>{{$product->desc}}</td> --}}
        <td>{{$product->price}}</td>
        <td>{{$product->quantity}}</td>
        <td><img src="{{asset("storage/$product->image")}}" width="100px" alt="" srcset=""></td>
        <td>

            <h1>
                <a class="btn btn-success" href="{{url("product/show/$product->id")}}" >{{__("message.show")}}</a>
            </h1>
        </td>
    </tr>
    @endforeach

    </tbody>
  </table>


@endsection
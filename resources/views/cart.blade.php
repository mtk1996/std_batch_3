@extends('layout.master')

@section('content')
<div class="col-8 offset-2">
    <div class="card p-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Sale Price</th>
                    <th>Total Qty</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $total_price = 0; @endphp
                @foreach ($cart as $c)
                @php
                $total_price+= $c->total_quantity*$c->product->sale_price;
                @endphp
                <tr>
                    <td>
                        <img src="{{$c->product->image_url}}" width="50" class="img-thumbnail">
                    </td>
                    <td>
                        {{$c->product->name}}
                    </td>
                    <td>
                        {{$c->product->sale_price}}ks
                    </td>
                    <td>
                        {{$c->total_quantity}}
                    </td>
                    <td>
                        30
                    </td>
                    <td>
                        <a href="" class="btn btn-sm btn-dark">-</a>
                        <a href="{{url('/add-cart/'.$c->product->slug)}}" class="btn btn-sm btn-dark">+</a>
                        <a href="{{url('/remove-cart/'.$c->id)}}" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="6">
                        <span class="float-right">
                            <span>Total Price : <b>{{$total_price}}</b></span>
                            <a href="{{url('/checkout')}}" class="btn btn-primary">Checkout</a>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

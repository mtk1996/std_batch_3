@extends('layout.master')

@section('content')
<div class="col-8 offset-2">
    <div class="card p-2">
        <div>
            <a href="{{url('/order')}}" class="btn btn-dark">
                All Order Group
            </a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Sale Price</th>
                    <th>Total Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order as $g)
                <tr>
                    <td>
                        <img src="{{$g->product->image_url}}" width="50" alt="">
                    </td>
                    <td>{{$g->product->name}}</td>
                    <td>{{$g->product->sale_price}}</td>
                    <td>{{$g->total_quantity}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

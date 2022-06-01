@extends('admin.layout.master')

@section('content')
<div>
    <a href="{{route('product.create')}}" class="btn btn-success">Create</a>
</div>

<br>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Supplier Name</th>
            <th>Total Quantity</th>
            <th>Buy Price</th>
            <th>Buy Date</th>
            <th>Description</th>

        </tr>
    </thead>
    <tbody>

        @foreach ($transactions as $s)
        <tr>
            <td>

                <img src="{{asset('/images/'.$s->product->image)}}" width="50" alt="">
            </td>
            <td>
                {{$s->product->name}}
            </td>
            <td>
                {{$s->supplier->name}}
            </td>
            <td>
                {{$s->total_quantity}}
            </td>
            <td>
                {{$s->buy_price}}
            </td>

            <td>
                {{$s->buy_date}}
            </td>
            <td>
                {{$s->description}}
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
@endsection

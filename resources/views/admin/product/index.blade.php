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
            <th>Total Quantity</th>
            <th>Add Or Remove</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $p)
        <tr>
            <td>
                <img src="{{asset('/images/'.$p->image)}}" width="50" alt="">
            </td>
            <td>
                {{$p->name}}
            </td>
            <td>
                {{$p->total_quantity}}
            </td>
            <td>
                <a href="{{url('/admin/create-product-remove/'.$p->id)}}" class="btn btn-warning">-</a>
                <a href="{{url('/admin/create-product-add/'.$p->id)}}" class="btn btn-warning">+</a>
            </td>
            <td>
                <a href="{{route('product.edit',$p->id)}}" class="btn btn-primary">Edit</a>

                <form action="{{route('product.destroy',$p->id)}}" method="POST" class="d-inline"
                    onsubmit="return confirm('Are you Sure?')">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" class="btn btn-danger">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@extends('admin.layout.master')

@section('content')
<h2>Order</h2>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Image</th>
            <th>Order Count</th>
            <th>Status</th>
            <th>Option</th>
        </tr>

    </thead>
    <tbody>
        @foreach ($orderGroup as $o)
        <tr>
            <td>{{$o->order[0]->product->name}}</td>
            <td>
                <img src="{{$o->order[0]->product->image_url}}" width="50" alt="">
            </td>

            <td>
                <span class="badge badge-danger">3</span>
            </td>
            <td>
                @if($o->status ==='pending')
                <span class="text text-warning">pending</span>
                @endif
                @if($o->status ==='reject')
                <span class="text text-danger">reject</span>
                @endif
                @if($o->status ==='success')
                <span class="text text-success">success</span>
                @endif
            </td>
            <td>
                <a href="{{url('/admin/change-order/'.$o->id.'?status=success')}}"
                    class="btn btn-sm btn-success">Success</a>

                <a href="{{url('/admin/change-order/'.$o->id.'?status=reject')}}"
                    class="btn btn-sm btn-danger">Reject</a>
                <a href="" class="btn btn-sm btn-primary">
                    <i class="fa fa-eye"></i>
                </a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

@endsection

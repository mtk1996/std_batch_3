@extends('layout.master')

@section('content')
<div class="col-8 offset-2">
    <div class="card p-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Total Order</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($group as $g)
                <tr>
                    <td>
                        <img src="{{$g->order[0]->product->image_url}}" width="50" alt="">
                    </td>
                    <td>{{$g->order[0]->product->name}}</td>
                    <td>{{count($g->order)}}</td>
                    <td>
                        @if($g->status=='pending')
                        <span class="badge badge-warning">Pending</span>
                        @endif
                        @if($g->status=='success')
                        <span class="badge badge-success">Success</span>
                        @endif
                        @if($g->status=='reject')
                        <span class="badge badge-danger">Rejected</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{url('/order-detail/'.$g->id)}}" class="btn btn-primary btn-sm ">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

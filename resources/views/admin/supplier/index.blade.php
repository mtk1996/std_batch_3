@extends('admin.layout.master')

@section('content')
<div>
    <a href="{{route('supplier.create')}}" class="btn btn-success">Create</a>
</div>

<br>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Description</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($supplier as $s)
        <tr>
            <td>{{$s->name}}</td>
            <td>
                <img src="{{asset('/images/'.$s->image)}}" class="img-thumbnail" width="100" alt="">
            </td>
            <td>
                {{$s->description}}
            </td>
            <td>
                <a href="{{route('supplier.edit',$s->id)}}" class="btn btn-primary">Edit</a>

                <form action="{{route('supplier.destroy',$s->id)}}" method="POST" class="d-inline"
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

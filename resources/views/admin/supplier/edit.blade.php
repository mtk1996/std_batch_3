@extends('admin.layout.master')

@section('content')
<div>
    <a href="{{route('supplier.index')}}" class="btn btn-dark">All</a>
</div>
<form action="{{route('supplier.update',$supplier->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="">Enter Supplier Name</label>
        <input type="text" name="name" value="{{$supplier->name}}" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Choose Image</label>
        <input type="file" name="image" class="form-control">
        <br>
        <img src="{{asset('/images/'.$supplier->image)}}" width="150" class="img-thumbnail" alt="">
    </div>
    <div class="form-group">
        <label for="">Enter Supplier Name</label>
        <textarea name="description" class="form-control">{{$supplier->description}}</textarea>
    </div>
    <input type="submit" class="btn btn-primary" value="Update" id="">
</form>
@endsection

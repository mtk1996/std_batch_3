@extends('admin.layout.master')

@section('content')
<div>
    <a href="{{route('supplier.index')}}" class="btn btn-dark">All</a>
</div>
<form action="{{route('supplier.store')}}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="">Enter Supplier Name</label>
        <input type="text" name="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Choose Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Enter Supplier Name</label>
        <textarea name="description" class="form-control"></textarea>
    </div>
    <input type="submit" class="btn btn-primary" value="Create" id="">
</form>
@endsection

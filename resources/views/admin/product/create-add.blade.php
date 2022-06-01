@extends('admin.layout.master')

@section('content')
<div>
    <h2 class="">
        Add Product For <b class="text-warning">{{$product->name}}</b>
    </h2>
</div>
<form action="{{url('/admin/create-product-add/'.$product->id)}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="">Choose Supplier</label>
        <select name="supplier_id" class="form-control">
            @foreach ($supplier as $s)
            <option value="{{$s->id}}">{{$s->name}}</option>
            @endforeach

        </select>
    </div>
    <div class="form-group">
        <label for="">Enter Buy Pirce</label>
        <input type="number" name="buy_price" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Enter Qty</label>
        <input type="number" name="total_quantity" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Enter Description</label>
        <textarea class="form-control" name="description"></textarea>
    </div>
    <input type="submit" value="Add" class="btn btn-primary">
</form>
@endsection

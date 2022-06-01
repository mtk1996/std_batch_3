@extends('admin.layout.master')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<style>
    .select2-selection {
        height: 45px !important;
    }
</style>
@endsection

@section('content')
<div>
    <a href="{{route('product.index')}}" class="btn btn-dark">All</a>
</div>
<br>
<form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <form action="">
        <div class="row">
            <div class="col-8">
                <div class="p-3 card">
                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="">Image </label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Descriptioni</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <h3 class="text-primary">Pricing</h3>
                    <div class="form-group">
                        <label for="">Total quantity </label>
                        <input type="number" class="form-control" name="total_quantity">
                    </div>
                    <div class="form-group">
                        <label for="">Sale Price </label>
                        <input type="number" class="form-control" name="sale_price">
                    </div>
                    <div class="form-group">
                        <label for="">Buy Price </label>
                        <input type="number" class="form-control" name="buy_price">
                    </div>
                    <div class="form-group">
                        <label for="">Transaction Description</label>
                        <textarea name="tran_description" class="form-control"></textarea>
                    </div>
                </div>

            </div>
            <div class="col-4">
                <div class="card p-3">
                    <div class="form-group">
                        <label for="">Choose Supplier</label>
                        <select name="supplier_id" id="supplier">
                            @foreach ($supplier as $s)
                            <option value="{{$s->id}}">{{$s->name}}</option>
                            @endforeach

                        </select>
                    </div>
                    {{-- category --}}
                    <div class="form-group">
                        <label for="">Choose Category</label>
                        <select name="category_id" id="category">
                            @foreach ($category as $s)
                            <option value="{{$s->id}}">{{$s->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Brand --}}
                    <div class="form-group">
                        <label for="">Choose Brand</label>
                        <select name="brand_id" id="brand">
                            @foreach ($brand as $s)
                            <option value="{{$s->id}}">{{$s->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- color --}}
                    <div class="form-group">
                        <label for="">Choose Color</label>
                        <select name="color_id[]" id="color" multiple>
                            @foreach ($color as $s)
                            <option value="{{$s->id}}">{{$s->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="submit" value="Create" class="btn btn-primary">
                </div>
            </div>
        </div>
    </form>
</form>
@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(function(){
        $('#supplier').select2();
        $('#category').select2();
        $('#brand').select2();
        $('#color').select2();
        $('#description').summernote();
    })
</script>
@endsection

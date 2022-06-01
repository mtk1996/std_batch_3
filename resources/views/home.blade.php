@extends('layout.master')

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <!-- For Category and Information -->
        @include('layout.sidebar')
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="12 p-3">
                            <form>
                                <select name="color" class="btn bg-dark">
                                    <option value="">Color</option>
                                    @foreach ($color as $c)
                                    <option value="{{$c->slug}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                                <select name="category" class="btn bg-dark">
                                    <option value="">Category</option>
                                    @foreach ($category as $c)
                                    <option value="{{$c->slug}}">{{$c->name}}</option>
                                    @endforeach
                                </select>

                                <select name="brand" class="btn bg-dark">
                                    <option value="">Brand</option>
                                    @foreach ($brand as $c)
                                    <option value="{{$c->slug}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="search" placeholder="enter name" class="btn bg-dark">
                                <input type="submit" class="btn btn-dark" value="Filter">
                                <a href="{{url('/')}}" class="btn btn-danger">Clear</a>
                            </form>

                        </div>
                    </div>
                    <div class="row">
                        <!-- Loop Product -->
                        @foreach ($product as $p)
                        <div class="col-md-4">
                            <a href="{{url('/product/'.$p->slug)}}">
                                <div class="card">
                                    <img class="card-img-top" src="{{asset('/images/'.$p->image)}}" alt="">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4>
                                                    {{$p->name}}
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <a href="" class="badge badge-primary">{{$p->sale_price}}ks</a>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="" class="badge badge-warning">{{$p->category->name}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-3">
                            {{$product->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layout.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('layout.sidebar')

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>{{$product->name}}</h1>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{url('/add-cart/'.$product->slug)}}" class="btn btn-primary rounded">
                                        <i class="fas fa-cart-arrow-down"></i>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <small>
                                        <i class="fas fa-eye"></i>
                                        {{$product->view_count}}
                                    </small>
                                </div>
                                <div class="col-md-4">
                                    <a href="" class="">
                                        <small class="text-muted">Category:</small>
                                        <span class="badge badge-primary">{{$product->category->name}}</span>
                                    </a>

                                    <a href="" class="">
                                        <small class="text-muted">Brand:</small>
                                        <span class="badge badge-primary">{{$product->brand->name}}</span>
                                    </a>
                                    <br>
                                    <a href="" class="">
                                        <small class="text-muted">Color:</small>
                                        @foreach ($product->color as $c)
                                        <span class="badge badge-primary">{{$c->name}}</span>
                                        @endforeach

                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <img src="{{asset('/images/'.$product->image)}}" class="w-50" alt="">
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <small class="text-muted">Price:</small>
                                <span>{{$product->sale_price}}</span>
                            </div>
                            <p>
                                {!!$product->description!!}
                            </p>
                        </div>
                    </div>

                    {{-- Review --}}
                    <div class="row">
                        <div class="col-12" id="commentContainer">

                            @foreach($product->review as $r)
                            <div class="crad border p-3">
                                <small class="text-muted">{{$r->user->name}}</small>
                                <br>
                                <p class="p-3">
                                    {{$r->review}}
                                </p>
                            </div>
                            @endforeach



                        </div>
                        @auth

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card p-3">
                                <textarea id="txtComment" placeholder="enter comment" class="btn"></textarea>
                                <button class="btn btn-dark" id="btnComment">Comment</button>
                            </div>
                        </div>
                    </div>

                    @endauth

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    $(function(){
        const commentContainer = $('#commentContainer');
        const txtComment = $('#txtComment')
        const btnComment = $('#btnComment');

        btnComment.click(function(){

            var frmData = new FormData();
            frmData.append('review',txtComment.val());
            frmData.append('product_id',"{{$product->id}}");
            frmData.append('user_id',"{{auth()->id()}}");

            axios.post('/product-review',frmData)
            .then(function(d){
                commentContainer.append(d.data)
            })
        })
    })
</script>
@endsection

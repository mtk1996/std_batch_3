@extends('layout.master')

@section('content')
<div class="container mt-3">
    <div class="row">

        {{-- col 4 --}}
        @include('layout.sidebar')

        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">Login</div>
                <div class="card-body">
                    <form action="{{url('/login')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Enter Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Enter Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <input type="submit" class="btn btn-primary" value="Login">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layout.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <div class="card p-3">
                <h4>Update Your Password</h4>
                <form action="{{url('/update-password')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Enter Old Password</label>
                        <input type="password" name="old_password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Enter New Password</label>
                        <input type="password" name="new_password" class="form-control">
                    </div>
                    <input type="submit" value="Update Password" class="btn btn-primary">
                </form>

                <hr>
                <h4>Update Info</h4>
                <form action="">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" disabled class="form-control" value="{{auth()->user()->email}}" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="number" class="form-control" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <textarea name="address" class="form-control"></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Update Info">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

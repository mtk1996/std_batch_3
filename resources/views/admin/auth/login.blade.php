<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
</head>

<body>
    @if($errors->any())
    @foreach ($errors->all() as $e )
    <div class="alert alert-danger">{{$e}}</div>
    @endforeach
    @endif
    @if(session()->has('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
    @endif
    <form action="{{url('/admin/login')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Enter Email</label>
            <input type="text" name="email" class="form-control" id="">
        </div>
        <div class="form-group">
            <label for="">Enter Password</label>
            <input type="password" name="password" class="form-control" id="">
        </div>
        <input type="submit" value="Login" id="">
    </form>
</body>

</html>

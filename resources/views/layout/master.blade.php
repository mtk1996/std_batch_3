<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MM-Coder-Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet"
        href="https://demos.creative-tim.com/argon-dashboard/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/argon-design-system-free@1.2.0/assets/css/argon-design-system.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <style>
        #header {
            height: 60vh;
            background: linear-gradient(#007bff, white);
            border-bottom-left-radius: 10%;
            border-bottom-right-radius: 10%;
        }

        #header .nav-link {
            color: white !important;
        }

        #header img {
            width: 60% !important;

        }
    </style>

</head>

<body>
    <!-- Header -->
    <div class="container-fluid" id="header">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand text-white" href="#">MM-Shop</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{url('/')}}">Home </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/order')}}">Your Order</a>
                    </li>
                    <li class="nav-item dropdown">

                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{url('/cart')}}" tabindex="-1">
                            Cart
                            <small class="badge badge-danger">{{$cart_count}}</small>
                        </a>
                    </li>
                </ul>
                <div class="form-inline">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        User
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @guest
                        <a class="dropdown-item" href="{{url('/login')}}">Login</a>
                        <a class="dropdown-item" href="{{url('/register')}}">Register</a>
                        @endguest


                        @auth
                        <a class="dropdown-item" href="#">Welcome {{auth()->user()->name}}!</a>
                        <a class="dropdown-item" href="{{url('/logout')}}">Logout</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <h1>Welcome From MM-Coder Shopping Website</h1>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium
                        sequi voluptas similique sed minima rerum labore reprehenderit, illo
                        recusandae quasi tempore placeat aliquam autem, a soluta nisi totam
                        temporibus dolorem!
                    </p>
                    @guest
                    <a href="{{url('/register')}}" class="btn btn-outline-primary">SignUp</a>
                    <a href="{{url('/login')}}" class="btn btn-primary">Login</a>
                    @endguest

                </div>
                <div class="col-md-6 text-center">
                    <img class=""
                        src="https://wp.xpeedstudio.com/seocify/home-fifteen/wp-content/uploads/sites/27/2020/03/home17-banner-image-min.png"
                        alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- End Header -->
    @yield('content')


    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.5/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/argon-design-system-free@1.2.0/assets/js/argon-design-system.min.js">
    </script>

    {{-- toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    @if(session()->has('success'))
    <script>
        toastr.success("{{session('success')}}")
    </script>
    @endif

    @if(session()->has('error'))
    <script>
        toastr.error("{{session('error')}}")
    </script>
    @endif

    @yield('script')

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    {{-- Jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>

    {{-- meta --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- style --}}
    <link rel="stylesheet" href="{{ url('css/style.css') }}">

    <title>bbabae</title>
</head>

<body>
    <header class="container-fluid">
        <div class="content-area nav">
            <div class="logo">
                <a href="{{ url('/') }}">
                    <img class="w-50" src="{{ url('/media/images/BBABAE_white.svg') }}" alt="bbabae logo" />
                </a>
            </div>

            <ul class="nav-menu">
                <li>
                    <input type="text" placeholder="search" class="menu-search" />
                </li>

                @if (!is_null(session('loggedin_user')))
                    <li><a href="{{ url('user') }}">{{ session('loggedin_user')['username'] }}</a></li>
                @else
                    <li><a href="{{ url('login') }}">Login</a></li>
                @endif
                <li><a href="">Help</a></li>
                <li class="nav-item cart">
                    <a href="{{ url('cart') }}"><i class="fas fa-shopping-bag"></i></a>
                    @if (session()->has('cart'))
                        <div class="cart-item">{{ sizeof(session('cart')) }}</div>
                    @endif
                </li>
            </ul>
        </div>
        <div class="mobile-nav"></div>
    </header>
    @yield('content-area')

    <!-- footer -->
    <footer class="container-fliud">
        <div class="content-area">
            <div class="row">
                <div class="col-md-3">
                    <ul class="footer-menu text-uppercase">
                        <li class="footer-menu-heading text-uppercase">Help</li>
                        <li class="footer-menu-item">
                            <a href="">Shop at bbabae.com</a>
                        </li>
                        <li class="footer-menu-item"><a href="">Product</a></li>
                        <li class="footer-menu-item"><a href="">payment</a></li>
                        <li class="footer-menu-item"><a href="">shipping</a></li>
                        <li class="footer-menu-item">
                            <a href="">exchanges and return</a>
                        </li>
                        <li class="footer-menu-item"><a href="">my account</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="footer-menu text-uppercase">
                        <li class="footer-menu-heading text-uppercase">follow us</li>
                        <li class="footer-menu-item">
                            <a href="">newsletter</a>
                        </li>
                        <li class="footer-menu-item"><a href="">wechat</a></li>
                        <li class="footer-menu-item"><a href="">weibo</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="footer-menu text-uppercase">
                        <li class="footer-menu-heading">Company</li>
                        <li class="footer-menu-item">
                            <a href="">about us</a>
                        </li>
                        <li class="footer-menu-item"><a href="">join life</a></li>
                        <li class="footer-menu-item"><a href="">offices</a></li>
                        <li class="footer-menu-item"><a href="">stories</a></li>
                        <li class="footer-menu-item">
                            <a href="">work with us</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="footer-menu text-uppercase">
                        <li class="footer-menu-heading">Policies</li>
                        <li class="footer-menu-item"><a href="">privacy policy</a></li>
                        <li class="footer-menu-item"><a href="">purchase conditions</a></li>
                    </ul>
                </div>
                <p class="fs-12 mt-2 text-center text-uppercase text-dark">2022 © All right reserved.</p>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


    <script>
        $(document).ready(function() {
            $('.counter').counterUp({
                delay: 10,
                time: 1200
            });
        });
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>

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
                <img class="w-50" src="images/bbabae logo.png" alt="" />
            </div>

            <ul class="nav-menu">
                <li>
                    <input type="text" placeholder="search" class="menu-search" />
                </li>
                <li><a href="">Login</a></li>
                <li><a href="">Help</a></li>
                <li class="nav-item cart">
                    <a href=""><i class="fas fa-shopping-bag"></i></a>
                    @if (session()->has('cart'))
                        <div class="cart-item">{{ sizeof(session('cart')) }}</div>
                    @endif
                </li>
            </ul>
        </div>
        <div class="mobile-nav"></div>
    </header>
    <section id="main">
        @yield('content-area')
    </section>
    
    <!-- footer -->
    <footer class="container-fliud">
        <div class="content-area">
            <div class="row">
                <div class="col-md-3">
                    <ul class="footer-menu">
                        <li class="footer-menu-heading">Help</li>
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
                    <ul class="footer-menu">
                        <li class="footer-menu-heading">Help</li>
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
                    <ul class="footer-menu">
                        <li class="footer-menu-heading">Help</li>
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
                    <ul class="footer-menu">
                        <li class="footer-menu-heading">Help</li>
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

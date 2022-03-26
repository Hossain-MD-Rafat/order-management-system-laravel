<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- font awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    <!-- Optional JavaScript; choose one of the two! -->
    <script script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
    </script>

    {{-- style --}}
    <link rel="stylesheet" href="{{ url('css/style.css') }}">

    <title>bbabae</title>
</head>

<body>

    <header class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('media/images/logo.png') }}" alt="" class="logo">
            </div>
            <div class="col-md-4 offset-md-4 nav-menu">
                <div class="nav-item">Home</div>
                <div class="nav-item">About</div>
                <div class="nav-item cart">Cart <i class="fas fa-shopping-cart"></i>
                    @if (session()->has('cart'))
                        <div class="cart-item">{{ sizeof(session('cart')) }}</div>
                    @endif
                </div>
                <div class="nav-item account">Account <i class="fas fa-user"></i></div>
            </div>
        </div>
    </header>
    <section id="main">
        @yield('content-area')
    </section>
    <footer>
        <div class="bg-dark text-white text-center p-1">bbabae copyright © 2022</div>
    </footer>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>

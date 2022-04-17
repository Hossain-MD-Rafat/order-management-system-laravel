@extends('templates.public')
@section('content-area')
    <section class="cart container">
        <div class="address-side-bar">
            <div class="text-right" role="button">
                <i class="fas fa-times"></i>
            </div>
            <div class="address-item-select">
                <h4>lorem</h4>
                <span class="street">lorem</span><br>
                <span>lorem</span><br>
                <span>lorem</span><br>
                <span>lorem</span><br>
                <span>lorem</span><br>
                <span>lorem</span><br>
            </div>
        </div>
        <div class="row mb-5">
            <h4 class="text-uppercase mb-4 shipping-title">Where do you want to recieve your order?</h4>
            <div class="col-md-2">
                <div class="select-shipping-address">
                    <i class="fas fa-home"></i>
                    <h6 class="text-uppercase">To Me</h6>
                </div>
            </div>
            <div class="col-md-2">
                <div class="select-shipping-address" id="other-address">
                    <i class="fab fa-intercom"></i>
                    <h6 class="text-uppercase">other</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <h4 class="text-uppercase mb-4 shipping-title">items</h4>
            @php
                $total = 0;
            @endphp
            @foreach (session('cart') as $item)
                @php
                    $total += $item['price'] * $item['quantity'];
                @endphp
                <div class="col-md-2">
                    <img class="w-100" src="{{ $item['banner'] }}" alt="" />
                </div>
            @endforeach
        </div>
        <div class="row d-flex mt-5">
            <div class="cart-calculation">
                <div class="text-center">
                    <b>Total:</b> ¥<span id="total-amount">{{ $total }}</span><br>
                    <small class="fs-10">Domestic Shipping fee and agent fee will be added</small>
                </div>
                <div>
                    <a href="{{ url('shipping') }}" class="add-to-cart">Continue</a>
                </div>
            </div>
        </div>
    </section>
    <script>
        $('#other-address').click(function(e) {
            $('.address-side-bar').toggleClass('side-bar-show');
        });
    </script>
@endsection

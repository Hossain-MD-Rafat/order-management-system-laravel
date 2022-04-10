@extends('templates.public')
@section('content-area')
    <section class="container-fluid product-details">
        <div class="row w-100">
            <div class="col-md-10 horizontal-center">
                <div class="row">
                    @php
                        $total = 0;
                    @endphp
                    <div class="col-md-7">
                        @if (session()->has('cart'))
                            @foreach (session('cart') as $item)
                                @php
                                    $total += $item['price'] * $item['quantity'];
                                @endphp
                                <div class="d-flex flex-wrap mb-4">
                                    <div class="cart-pd-image">
                                        <img class="w-100" src="{{ $item['banner'] }}" alt="">
                                    </div>
                                    <div class="cart-pd-body">
                                        <h2 class="product-title">{{ $item['title'] }}</h2>
                                        <span class="price">Price: ¥{{ $item['price'] }}</span>
                                        <span>Quantity: {{ $item['quantity'] }}</span><br>
                                        <span>Expected Delivery Days:
                                            {{ $item['delivery_days'] }} Days</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="offset-md-1 col-md-4 price-calculator">
                        <div class="form-group mt-4 text-center">
                            <h2 class="product-title text-center">Summary</h2>
                            <hr>
                            <span class="d-block mb-4 total-items">Total Ordered Item:
                                {{ sizeof(session('cart')) }}</span>
                            <span class="d-block mb-4 total-items">Amount: <span
                                    class="total-price">¥{{ $total }}</span></span>

                            <a href="checkout" class="place-order" type="submit">Proceed To Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

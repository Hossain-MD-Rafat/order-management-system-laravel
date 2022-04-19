@extends('templates.public')
<div class="address-side-bar">
    <div class="text-right" role="button" id="close-sidebar">
        <i class="fas fa-times"></i>
    </div>
    <div>
        <a class="text-uppercase d-block mt-4 mb-4 text-dark" href="{{ url('user/addressform') }}">add new shipping
            address</a>
    </div>
    @foreach ($address as $item)
        <div class="address-item-select" onclick="selectaddress(this, {{ $item->id }})">
            <h4>{{ $item->name }}</h4>
            <span class="street">{{ $item->address }}</span><br>
            <span>{{ $item->district }}</span><br>
            <span>{{ $item->post_code . ' ' . $item->town }}</span><br>
            <span>{{ $item->province }}</span><br>
            <span>{{ $item->region }}</span><br>
            <span>{{ $item->phone }}</span><br>
        </div>
    @endforeach
</div>
@section('content-area')
    <section class="cart container">
        <div class="row mb-5">
            <h4 class="text-uppercase mb-4 shipping-title">Where do you want to recieve your order?</h4>
            <div class="col-md-2">
                <div class="select-shipping-address"
                    onclick="selectaddress(this, {{ isset($main[0]->id) ? $main[0]->id : '' }})">
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
                <form method="POST" action="{{ url('user/addshipping') }}">
                    @csrf
                    <input type="hidden" name="address_id" value="" id="address_id">
                    <div class="text-center">
                        <b>Total:</b> ¥<span id="total-amount">{{ $total }}</span><br>
                        <small class="fs-10">Domestic Shipping fee and agent fee will be added</small>
                    </div>
                    <div>
                        <button type="submit" class="add-to-cart" name="place_order" value="true">Place Order</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        function selectaddress(e, id) {
            $('.selected-address').removeClass('selected-address');
            $(e).addClass('selected-address');
            $('#address_id').val(id);
        }
        $('#other-address').click(function(e) {
            $('.address-side-bar').toggleClass('side-bar-show');
        });
        $('#close-sidebar').click(function(e) {
            $('.address-side-bar').toggleClass('side-bar-show');
        });
    </script>
@endsection

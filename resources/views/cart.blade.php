@extends('templates.public')
@section('content-area')
    <section class="cart container">
        <div class="row">
            @php
                $total = 0;
            @endphp
            @foreach (session('cart') as $item)
                @php
                    $total += $item['price'] * $item['quantity'];
                @endphp
                <div class="col-md-4">
                    <h2 class="cart-product-title">{{ $item['title'] }}</h2>
                    <div class="d-flex justify-content-between">
                        <div class="cart-item-thumb">
                            <img class="w-100" src="{{ $item['banner'] }}" alt="" />
                        </div>
                        <div class="cart-item-other">
                            <div class="pd-option">
                                <span class="cart-product-details">{{ $item['color'] }}</span><br>
                                <span class="cart-product-details">{{ $item['size'] }}</span> <br>
                                <label class="cart-product-details" for="">Quantity</label>
                                <div class="d-flex">
                                    <div onclick="minuscounter(this, {{ $item['id'] }}, {{ $item['price'] }})"
                                        class="qnt-controll" role="button">-</div>
                                    <input type="number" id="quantity" class="cart-quantity" name="quantity"
                                        value="{{ $item['quantity'] }}" required />
                                    <div onclick="pluscounter(this, {{ $item['id'] }}, {{ $item['price'] }})"
                                        class="qnt-controll" role="button">+</div>
                                </div>
                            </div>
                            <div class="cart-product-details">¥<span>{{ $item['price'] }}</span></div>
                            <div class="cart-product-details text-danger" role="button"
                                onclick="deletcartitem(this, {{ $item['id'] }}, {{ $item['price'] }})">Delete</div>
                        </div>
                    </div>
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
                    <a href="{{ url('user/shipping') }}" class="add-to-cart">Continue</a>
                </div>
            </div>
        </div>
    </section>
    <script>
        let qntFlag = false;

        function pluscounter(e, id, price) {
            let input = e.parentNode.querySelector('input');
            let value = parseInt(input.value);
            value += 1;
            input.value = value;
            let total = parseFloat($('#total-amount').text());
            $('#total-amount').text(total + price);


            let qnt = 0;
            if (qntFlag === false) {
                qntFlag = true;
                setTimeout(function() {
                    qnt = e.parentNode.querySelector('input').value;
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('cartquantity') }}",
                        method: 'POST',
                        cache: false,
                        data: {
                            'quantitychange': true,
                            'id': id,
                            'quantity': qnt
                        },
                        success: function(res) {
                            qntFlag = false;
                        },
                        error: function() {
                            qntFlag = false;
                        }
                    });
                }, 4000);
            }
        }

        function minuscounter(e, id, price) {
            let input = e.parentNode.querySelector('input');
            let value = parseInt(input.value);
            if (value > 1) {
                value = value - 1;
                input.value = value;
                let total = parseFloat($('#total-amount').text());
                $('#total-amount').text(total - price);

                let qnt = 0;
                if (qntFlag === false) {
                    qntFlag = true;
                    setTimeout(function() {
                        qnt = e.parentNode.querySelector('input').value;
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ url('cartquantity') }}",
                            method: 'POST',
                            cache: false,
                            data: {
                                'quantitychange': true,
                                'id': id,
                                'quantity': qnt
                            },
                            success: function(res) {
                                qntFlag = false;
                            },
                            error: function() {
                                qntFlag = false;
                            }
                        });
                    }, 4000);
                }
            }
        }

        function deletcartitem(e, id, price) {
            let qnt = parseInt(e.parentNode.querySelector('#quantity').value);
            let total = parseFloat($('#total-amount').text());
            $('#total-amount').text(total - (price * qnt));

            let item = e.parentNode.parentNode.parentNode;
            item.style.display = 'none';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ url('cartitemdelete') }}",
                data: {
                    delete: true,
                    id: id
                },
                cache: false,
                success: function(response) {
                    if (response.status === 200) {
                        item.remove();
                    } else {
                        item.style.display = 'block';
                    }
                },
                error: function(response) {
                    item.style.display = 'block';
                }
            });
        }
    </script>
@endsection

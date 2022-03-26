@extends('templates.public')

@section('content-area')
    <section class="container-fluid product-details">
        <div class="row w-100">
            <div class="col-md-8 horizontal-center">
                <div class="row">
                    <div class="col-md-7">
                        <h2 class="product-title"><?= $product->title ?></h2>
                        <img class="w-100 product-thumb" src="{{ $product->banner }}" alt="">
                        <div class="mt-5">
                            <h2 class="pd-description">Product Details</h2>
                            @if ($product->site == 1)
                                @foreach ($product->details as $item)
                                    @if ($item->type == 1)
                                        <p>{{ $item->text }}</p>
                                    @elseif($item->type == 10000)
                                        <p>{{ $item->text }}</p>
                                        <img class="w-75" src="{{ $item->url }}" alt="">
                                    @else
                                        <img class="w-75" src="{{ $item->url }}" alt="">
                                    @endif
                                @endforeach
                            @endif
                            @if ($product->site == 2)
                                @foreach ($product->details as $item)
                                    <img class="w-75" src="{{ $item }}" alt="">
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="offset-md-1 col-md-4 price-calculator">
                        @isset($error)
                            <small class="text-center text-danger">{{ $error }}</small>
                        @endisset($error)
                        <span class="price">¥<span id="price"><?= $product->price ?></span></span>
                        <span class="d-block text-center">Delivery charge will add.</span>
                        <form action="{{ url('addtocart') }}" method="post">
                            @csrf
                            <input type="hidden" name="url" value="{{ $product->url }}">
                            <input type="hidden" name="name" value="{{ $product->title }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <div class="form-group mt-4">
                                <label for="">Quantity</label>
                                <div class="d-flex">
                                    <div id="minus" class="counter" role="button">-</div>
                                    <input type="number" id="quantity" class="form-control text-center" name="quantity"
                                        value="1" required>
                                    <div id="plus" class="counter" role="button">+</div>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <label for="">Expected Delivery Days</label>
                                <div class="d-flex">
                                    <div id="d-minus" class="counter" role="button">-</div>
                                    <input type="number" id="days" class="form-control text-center" name="delivery_days"
                                        value="1" required>
                                    <div id="d-plus" class="counter plus" role="button">+</div>
                                </div>
                            </div>
                            <div class="form-group mt-4 text-center">
                                <button class="place-order" type="submit">Add to cart</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- <div class="d-flex flex-wrap mt-4">
                <div class="single-product-image">
                    <img class="w-75" src="" alt="">
                </div>
            </div> --}}
        </div>
    </section>
    <script>
        window.onload = function() {
            $('#plus').click(() => {
                let input = $('#quantity').val();
                let value = parseInt(input);
                value += 1;
                $('#quantity').val(value);
            })
            $('#minus').click((e) => {
                let input = $('#quantity').val();
                let value = parseInt(input);
                if (value > 1) {
                    value = value - 1;
                    $('#quantity').val(value);
                }
            })
            $('#d-plus').click(() => {
                let input = $('#days').val();
                let value = parseInt(input);
                value += 1;
                $('#days').val(value);
            })
            $('#d-minus').click((e) => {
                let input = $('#days').val();
                let value = parseInt(input);
                if (value > 1) {
                    value = value - 1;
                    $('#days').val(value);
                }
            })
        }
    </script>
@endsection

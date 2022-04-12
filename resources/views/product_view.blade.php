@extends('templates.public')

@section('content-area')
    <section class="product-view container">
        <div class="row">
            <div class="col-md-7 d-flex justify-content-between">
                <div class="thumb-image">
                    <img class="w-100" src="{{ $product->banner }}" alt="" />
                </div>
                <div class="other-image">
                    @foreach ($product->other_images as $item)
                        <img class="w-100 mb-1" src="{{ $item }}" alt="" />
                    @endforeach
                </div>
            </div>
            <div class="col-md-5">
                <h2 class="product-title">{{ $product->title }}</h2>
                <div class="product-description">
                    <span>{{ $product->title }}</span><br /><br />
                </div>
                <div class="option-one mt-4">
                    <h4 class="option-label">Color</h4>
                    @foreach ($product->color as $key => $item)
                        @if ($key === 0)
                            <div class="option-item active" id="color" onclick="selectOption(this)">{{ $item->attrValue }}
                            </div>
                        @else
                            <div class="option-item" id="color" onclick="selectOption(this)">{{ $item->attrValue }}
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="option-two mt-4">
                    <h4 class="option-label">Size</h4>
                    @foreach ($product->size as $key => $item)
                        @if ($key === 0)
                            <div class="option-item active" id="size" onclick="selectOption(this)">{{ $item->attrValue }}
                            </div>
                        @else
                            <div class="option-item" id="size" onclick="selectOption(this)">{{ $item->attrValue }}
                            </div>
                        @endif
                    @endforeach
                </div>
                <span class="product-price">¥{{ $product->price }}</span>
                <div class="mt-4 text-center d-none" id="loader-div">
                    <img src="{{ url('media/images/loader.gif') }}" alt="loader">
                </div>
                <button class="add-to-cart" id="add-to-cart" onclick="addtocart()">Add to cart</button>
                <a class="add-to-cart d-none" id="go-to-cart" href="{{ url('/cart') }}">Go to Cart</a>

            </div>
        </div>
        <input type="hidden" name="" id="product-title" value="{{ $product->title }}">
        <input type="hidden" name="" id="product-price" value="{{ $product->price }}">
        <input type="hidden" name="" id="product-site" value="{{ $product->site }}">
        <input type="hidden" name="" id="product-url" value="{{ $product->url }}">
        <input type="hidden" name="" id="product-banner" value="{{ $product->banner }}">
        <input type="hidden" name="" id="product-color" value="{{ $product->color[0]->attrValue }}">
        <input type="hidden" name="" id="product-size" value="{{ $product->size[0]->attrValue }}">
    </section>
    <script>
        function selectOption(e) {
            e.parentNode.querySelector('.option-item.active').classList.remove('active');
            e.classList.add('active');
            let id = e.getAttribute('id');
            if (id === 'color') {
                $('#product-color').val(e.innerText);
            }
            if (id === 'size') {
                $('#product-size').val(e.innerText);
            }
        }

        function addtocart() {
            $('#loader-div').removeClass('d-none');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ url('addtocart') }}",
                data: {
                    addtocart: true,
                    title: $('#product-title').val(),
                    price: $('#product-price').val(),
                    site: $('#product-site').val(),
                    url: $('#product-url').val(),
                    banner: $('#product-banner').val(),
                    color: $('#product-color').val(),
                    size: $('#product-size').val(),
                },
                cache: false,
                success: function(response) {
                    $('#loader-div').addClass('d-none');
                    if (response.status == 200) {
                        $('#add-to-cart').addClass('d-none');
                        $('#go-to-cart').removeClass('d-none');
                    }
                },
                error: function() {
                    $('#loader-div').addClass('d-none');
                    $('#add-to-cart').removeClass('d-none');
                    $('#go-to-cart').addClass('d-none');
                }
            });
        }
    </script>
@endsection

{{-- <section class="container-fluid product-details">
    <div class="row w-100">
        <div class="col-md-8 horizontal-center">
            <div class="row">
                <div class="col-md-7">
                    <h2 class="product-title"> //$product->title ?></h2>
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
                    <span class="price">¥<span id="price">< //$product->price ?></span></span>
                    <span class="d-block text-center">Delivery charge will add.</span>
                    <form action="{{ url('addtocart') }}" method="post">
                        @csrf
                        <input type="hidden" name="url" value="{{ $product->url }}">
                        <input type="hidden" name="title" value="{{ $product->title }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <input type="hidden" name="banner" value="{{ $product->banner }}">
                        <input type="hidden" name="details" value="{{ json_encode($product->details) }}">
                        <input type="hidden" name="site" value="{{ $product->site }}">
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
        </div>
    </div>
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
</section> --}}

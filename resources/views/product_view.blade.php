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
        setTimeout(() => {
            document.title = "bbabae";
        }, 1000);
    </script>
@endsection

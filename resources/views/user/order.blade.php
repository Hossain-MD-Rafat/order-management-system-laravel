@extends('templates.public')

@section('content-area')
    <section class="product-view container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="product-row mb-4">
                    <div class="w-20 order-title text-uppercase">Product Image</div>
                    <div class="product-details order-title text-uppercase">Product Details</div>
                    <div class="product-conditions order-title text-uppercase">Product Conditions</div>
                    <div class="uploaded-images order-title text-uppercase">Uploaded Images</div>
                </div>
                @foreach ($order as $item)
                    <div class="product-row mb-4">
                        <div class="product-image">
                            <img src="{{ $item->image }}" alt="">
                        </div>
                        <div class="product-details">
                            <span>Name: {{ $item->name }}</span> <br>
                            <span>Color: {{ $item->color }}</span> <br>
                            <span>Size: {{ $item->size }}</span> <br>
                            <span>Price: ¥{{ $item->unit_price }}</span> <br>
                            <span>Quantity: {{ $item->quantity }}</span>
                        </div>
                        <div class="product-conditions">{{ $item->description }}</div>
                        <div class="uploaded-images">
                            @php
                                $uploaded_image = explode(';', $item->admin_image);
                            @endphp
                            @if ($uploaded_image)
                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        @foreach ($uploaded_image as $key => $item)
                                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                                data-bs-slide-to="{{ $key }}"
                                                class="{{ $key == 0 ? 'active' : '' }}" aria-current="true"
                                                aria-label="Slide 1"></button>
                                        @endforeach
                                    </div>

                                    <div class="carousel-inner">
                                        @foreach ($uploaded_image as $key => $item)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                <img src="{{ $item }}" alt="uploaded-image">
                                            </div>
                                        @endforeach
                                    </div>

                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

                <div class="row d-flex mt-5">
                    <div class="cart-calculation">
                        <div class="text-center">
                            Quantity: <span id="total-amount">{{ $order[0]->total_quantity }}</span><br>
                            <b>Total:</b> ¥<span id="total-amount">{{ $order[0]->total_amount }}</span><br>
                        </div>
                        <div>
                            <a href="{{ url('user') }}" class="add-to-cart">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
    </script>
@endsection

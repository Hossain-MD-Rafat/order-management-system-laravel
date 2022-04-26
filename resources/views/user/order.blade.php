@extends('templates.public')

@section('content-area')
    <section class="product-view container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
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
                                                <img src="{{ asset('storage/' . $item) }}" alt="uploaded-image">
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

                <div class="d-flex justify-content-between align-items-center mt-5">
                    <div class="address">
                        <span class="street">{{ $order[0]->address }}</span><br>
                        <span>{{ $order[0]->district }}</span><br>
                        <span>{{ $order[0]->post_code . ' ' . $order[0]->town }}</span><br>
                        <span>{{ $order[0]->province }}</span><br>
                        <span>{{ $order[0]->region }}</span><br>
                        <span>{{ $order[0]->phone }}</span><br>
                    </div>
                    <div class="cart-calculation">
                        <div>
                            Quantity: <span id="total-amount">{{ $order[0]->total_quantity }}</span><br>
                            @php
                                $total_with_fee = $order[0]->total_amount;
                                if (!Is_null($order[0]->shipping)) {
                                    $total_with_fee += $order[0]->shipping;
                                }
                                if (!Is_null($order[0]->agent_fee)) {
                                    $total_with_fee += $order[0]->agent_fee;
                                }
                            @endphp
                            @if (!Is_null($order[0]->shipping))
                                Shipping: ¥<span id="total-amount">{{ $order[0]->shipping }}</span><br>
                            @endif
                            @if (!Is_null($order[0]->agent_fee))
                                Agent Fee: ¥<span id="total-amount">{{ $order[0]->agent_fee }}</span><br>
                            @endif
                            <b>Total:</b> ¥<span id="total-amount">{{ $total_with_fee }}</span><br>
                        </div>
                        <div>
                            <button name="order_save" class="add-to-cart p-2" value="true">Continue Payment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
    </script>
@endsection

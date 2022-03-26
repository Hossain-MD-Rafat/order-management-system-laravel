@extends('templates.public')
@section('content-area')
    <section class="container-fluid product-details">
        <div class="row w-100">
            <div class="col-md-8 horizontal-center">
                <div class="row">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row form-group mb-4">
                            <div class="col-lg-6">
                                <label class="control-label">Username</label>
                                <input type="text" required name="username" class="form-control" value=""
                                    placeholder="username">
                            </div>
                            <div class="col-lg-6">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="" placeholder="Full Name">
                            </div>
                        </div>
                        <div class="row form-group mb-4">
                            <div class="col-lg-6">
                                <label class="control-label">Email</label>
                                <input type="text" required name="email" class="form-control" value=""
                                    placeholder="Email">
                            </div>
                            <div class="col-md-6">
                                <label>Postal Code</label>
                                <input type="text" class="form-control" name="postal_code">
                            </div>
                        </div>
                        <div class="row form-group mb-4">
                            <div class="col-md-12">
                                <label>Address</label>
                                <textarea name="address" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        @php
                            $total = 0;
                        @endphp
                        @if (session()->has('cart'))
                            @foreach (session('cart') as $item)
                                @php
                                    $total += $item['price'] * $item['quantity'];
                                @endphp
                            @endforeach
                        @endif
                        <div class="form-group mt-5 text-center">
                            <h2 class="product-title text-center">Order Information</h2>
                            <hr>
                            <span class="d-block mb-4 total-items">Total Ordered Item:
                                {{ sizeof(session('cart')) }}</span>
                            <span class="d-block mb-4 total-items">Amount: <span
                                    class="total-price">¥{{ $total }}</span>
                            </span>
                        </div>
                        <div class="form-group" style="text-align: right">
                            <button type="submit" class="user-save" name="test_submit" value="test_submit">
                                Place Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            </form>
        </div>
        </div>
        </div>
    </section>
@endsection

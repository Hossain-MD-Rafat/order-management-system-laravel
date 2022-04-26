@extends('admin.admintemplate')

@section('content-area')
    <section class="product-view container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @foreach ($order as $item)
                    <form class="order-item" action="{{ url('admin/saveorderedit/' . $item->id . '/' . $item->pid) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-5">
                                <img class="w-50" src="{{ $item->image }}" alt="">
                                <div>
                                    <span>Name: {{ $item->name }}</span> <br>
                                    <span>Color: {{ $item->color }}</span> <br>
                                    <span>Size: {{ $item->size }}</span> <br>
                                    <span>Price: ¥{{ $item->unit_price }}</span> <br>
                                    <span>Quantity: {{ $item->quantity }}</span>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group mb-2">
                                    <label>Add description</label><br>
                                    <textarea class="orderitem-description" name="description" id="" rows="5"></textarea>
                                </div>
                                <label for="">Uploaded Image List</label>
                                <div>
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
                                <label class="mt-4" for="">Add More Photos</label>
                                <div id="file-input-wrapper" onclick="fileinputhandler(this)">
                                    <div>Choose file</div>
                                    <button>Browse</button>
                                    <input type="file" name="uploaded_images[]"
                                        value="<?= isset($data->image) ? $data->image : '' ?>" class="file-upload d-none"
                                        multiple>
                                </div>

                            </div>
                        </div>
                        <div class="row d-flex">
                            <div class="cart-calculation">
                                <div>
                                    <button type="submit" name="item_save" value="true"
                                        class="add-to-cart save-button">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                @endforeach

                <div class="row d-flex mt-5">
                    <div class="cart-calculation">
                        <form action="{{ url('admin/saveorderedit/' . $order[0]->id) }}" method="POST">
                            @csrf
                            <div class="login-form-group">
                                <input type="number" step="0.0001" required class="login-input" name="shipping_charge"
                                    placeholder=" "
                                    value="{{ !is_null($order[0]->shipping) ? $order[0]->shipping : '' }}">
                                <label>Shipping Charge</label>
                            </div>
                            <div class="login-form-group">
                                <input type="number" step="0.0001" required class="login-input" name="agent_fee"
                                    placeholder=" "
                                    value="{{ !is_null($order[0]->agent_fee) ? $order[0]->agent_fee : '' }}">
                                <label>Agent Fee</label>
                            </div>
                            <div class="text-center">
                                Quantity: <span
                                    id="total-amount">{{ isset($order[0]->total_quantity) ? $order[0]->total_quantity : '' }}</span><br>
                                <b>Total:</b> ¥<span
                                    id="total-amount">{{ isset($order[0]->total_amount) ? $order[0]->total_amount : '' }}</span><br>
                            </div>
                            <div class="d-flex">
                                <a href="{{ url('admin') }}" class="add-to-cart">Back</a>
                                <button type="submit" name="order_save" class="add-to-cart ml-2" value="true">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function fileinputhandler(e) {
            let file = e.querySelector('input');
            file.click();
        }
        $("input[type='file']").change(function(e) {
            let name = e.target.files[0].name;
            e.target.parentNode.querySelector('div').innerHTML = name;
        });
    </script>
@endsection

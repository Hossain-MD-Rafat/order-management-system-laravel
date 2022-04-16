@extends('templates.public')

@section('content-area')
    <section class="cart container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2 class="text-uppercase">Address</h2>
                <form method="POST" action="{{ url('user/addaddress') }}">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('login_msg'))
                        <div class="text-success">{{ session('login_msg') }}</div>
                    @endif
                    @csrf
                    <input type="hidden" name="id" id="" value="{{ isset($address[0]->id) ? $address[0]->id : '' }}">
                    <div class="address-form-group">
                        <div class="w-48 login-form-group mb-2">
                            <input type="text" required class="login-input" name="name"
                                value="{{ isset($address[0]->name) ? $address[0]->name : '' }}" placeholder=" ">
                            <label class="text-uppercase">Name</label>
                        </div>
                        <div class="w-48 login-form-group mb-2">
                            <input type="text" required class="login-input" name="province" placeholder=" "
                                value="{{ isset($address[0]->province) ? $address[0]->province : '' }}">
                            <label class="text-uppercase">Province</label>
                        </div>
                    </div>
                    <div class="address-form-group">
                        <div class="w-48 login-form-group mb-2">
                            <input type="text" required class="login-input" name="town" placeholder=" "
                                value="{{ isset($address[0]->town) ? $address[0]->town : '' }}">
                            <label class="text-uppercase">town</label>
                        </div>
                        <div class="w-48 login-form-group mb-2">
                            <input type="text" required class="login-input" name="district" placeholder=" "
                                value="{{ isset($address[0]->district) ? $address[0]->district : '' }}">
                            <label class="text-uppercase">district</label>
                        </div>
                    </div>
                    <div class="address-form-group">
                        <div class="w-48 login-form-group mb-2">
                            <input type="text" required class="login-input" name="region" placeholder=" "
                                value="{{ isset($address[0]->region) ? $address[0]->region : '' }}">
                            <label class="text-uppercase">region</label>
                        </div>
                        <div class="w-48 login-form-group mb-2">
                            <input type="text" required class="login-input" name="address" placeholder=" "
                                value="{{ isset($address[0]->address) ? $address[0]->address : '' }}">
                            <label class="text-uppercase">address</label>
                        </div>
                    </div>
                    <div class="address-form-group">
                        <div class="w-48 login-form-group mb-2">
                            <input type="text" class="login-input" name="address_2" placeholder=" "
                                value="{{ isset($address[0]->address_2) ? $address[0]->address_2 : '' }}">
                            <label class="text-uppercase">address 2</label>
                        </div>
                        <div class="w-48 login-form-group mb-2">
                            <input type="text" required class="login-input" name="post_code" placeholder=" "
                                value="{{ isset($address[0]->post_code) ? $address[0]->post_code : '' }}">
                            <label class="text-uppercase">post code</label>
                        </div>
                    </div>
                    <div class="w-48 d-flex justify-content-between align-items-end mb-2">
                        <div class="phone-prefix">
                            <span>Prefix</span><br>
                            <span>+86</span>
                        </div>
                        <div class="login-form-group w-75">
                            <input type="number" required class="login-input mb-0" name="phone" placeholder=" "
                                value="{{ isset($address[0]->phone) ? $address[0]->phone : '' }}">
                            <label class="text-uppercase">repeat new phone number</label>
                        </div>
                    </div>
                    <div class="w-48 login-form-group mt-5 d-block">
                        <button type="submit" name="save_address" value="true"
                            class="add-to-cart mt-4 mb-3 text-uppercase">save</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@extends('templates.public')

@section('content-area')
    <section class="cart container p-0 pb-4">
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
                    <div class="form-group">
                        <div class="w-48 login-form-group mb-2">
                            <input type="text" required class="login-input" name="name">
                            <label class="text-uppercase">Name</label>
                        </div>
                        <div class="w-48 login-form-group mb-2">
                            <input type="text" required class="login-input" name="province">
                            <label class="text-uppercase">Province</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="w-48 login-form-group mb-2">
                            <input type="text" required class="login-input" name="town">
                            <label class="text-uppercase">town</label>
                        </div>
                        <div class="w-48 login-form-group mb-2">
                            <input type="text" required class="login-input" name="district">
                            <label class="text-uppercase">district</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="w-48 login-form-group mb-2">
                            <input type="text" required class="login-input" name="region">
                            <label class="text-uppercase">region</label>
                        </div>
                        <div class="w-48 login-form-group mb-2">
                            <input type="text" required class="login-input" name="address">
                            <label class="text-uppercase">address</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="w-48 login-form-group mb-2">
                            <input type="text" class="login-input" name="address_2">
                            <label class="text-uppercase">address 2</label>
                        </div>
                        <div class="w-48 login-form-group mb-2">
                            <input type="text" required class="login-input" name="post_code">
                            <label class="text-uppercase">post code</label>
                        </div>
                    </div>
                    <div class="w-48 d-flex justify-content-between align-items-end mb-2">
                        <div class="phone-prefix">
                            <span>Prefix</span><br>
                            <span>+86</span>
                        </div>
                        <div class="login-form-group w-75">
                            <input type="number" required class="login-input mb-0" name="phone">
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

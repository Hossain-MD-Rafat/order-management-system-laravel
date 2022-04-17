@extends('templates.public')

@section('content-area')
    <section class="cart container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="profile-nav">
                    <div role="button" id="purchases" onclick="profileview(this)" class="profile-nav-item active">
                        Purchases
                    </div>
                    <div role="button" id="profile" onclick="profileview(this)" class="profile-nav-item">
                        Profile
                    </div>
                    <div role="button" id="settings" onclick="profileview(this)" class="profile-nav-item">
                        Settings
                    </div>
                </div>
                <div class="mt-4 row" id="profile-content-purchases">
                    <div class="col-md-6 mb-5">
                        <div class="order-statu">Delivered</div>
                        <div class="order-date">Thurshday 2022, April</div>
                        <span>$223 <a href="">View Order</a></span>
                        <img src="./images/kelly-sikkema-xp-ND7NjWaA-unsplash.jpg" alt="" class="w-100" />
                    </div>
                    <div class="col-md-6 mb-5">
                        <div class="order-statu">Delivered</div>
                        <div class="order-date">Thurshday 2022, April</div>
                        <span>$223 <a href="">View Order</a></span>
                        <img src="./images/kelly-sikkema-xp-ND7NjWaA-unsplash.jpg" alt="" class="w-100" />
                    </div>
                    <div class="col-md-6 mb-5">
                        <div class="order-statu">Delivered</div>
                        <div class="order-date">Thurshday 2022, April</div>
                        <span>$223 <a href="">View Order</a></span>
                        <img src="./images/kelly-sikkema-xp-ND7NjWaA-unsplash.jpg" alt="" class="w-100" />
                    </div>
                </div>
                <div class="mt-4 row d-none" id="profile-content-profile">
                    <div class="col-md-10">
                        <a href="" class="profile-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="profile-item-heading">Rafat</span><span
                                        class="profile-item-body">0298547</span>
                                </div>
                                <div><i class="fas fa-angle-right text-dark"></i></div>
                            </div>
                        </a>
                        <a href="{{ url('user/account') }}" class="profile-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="profile-item-heading">Account</span><span class="profile-item-body">Email,
                                        Password, Sign out</span>
                                </div>
                                <div><i class="fas fa-angle-right text-dark"></i></div>
                            </div>
                        </a>
                        <a href="{{ url('user/address') }}" class="profile-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="profile-item-heading">Addresses</span><span
                                        class="profile-item-body">Shipping and billing addresses</span>
                                </div>
                                <div><i class="fas fa-angle-right text-dark"></i></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="mt-4 row d-none" id="profile-content-settings">
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
                                <label class="text-uppercase">new phone number</label>
                            </div>
                        </div>
                        <div class="w-48 login-form-group mt-5 d-block">
                            <button type="submit" name="save_profile" value="true"
                                class="add-to-cart mt-4 mb-3 text-uppercase">save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        function profileview(e) {
            if (e.id === "purchases") {
                $("#profile").removeClass("active");
                $("#settings").removeClass("active");
                $("#purchases").addClass("active");
                $("#profile-content-purchases").removeClass("d-none");
                $("#profile-content-profile").addClass("d-none");
                $("#profile-content-settings").addClass("d-none");
            } else if (e.id === "profile") {
                $("#purchases").removeClass("active");
                $("#settings").removeClass("active");
                $("#profile").addClass("active");
                $("#profile-content-purchases").addClass("d-none");
                $("#profile-content-profile").removeClass("d-none");
                $("#profile-content-settings").addClass("d-none");
            } else {
                $("#profile").removeClass("active");
                $("#settings").addClass("active");
                $("#purchases").removeClass("active");
                $("#profile-content-purchases").addClass("d-none");
                $("#profile-content-profile").addClass("d-none");
                $("#profile-content-settings").removeClass("d-none");
            }
        }
    </script>
@endsection



{{-- <div class="profile-settings-body tab-body">
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
                <input type="text" name="name" class="form-control" value=""
                    placeholder="Full Name">
            </div>
        </div>
        <div class="row form-group mb-4">
            <div class="col-lg-6">
                <label class="control-label">Email</label>
                <input type="text" required name="email" class="form-control" value=""
                    placeholder="Email">
            </div>
            <div class="col-lg-6">
                <label>Upload Image <small>(max: 5MB)</small></label>
                <?php if (isset($data->image)) { ?>
                <div class="pb-2" style="width: 250px">
                    <img class="w-100" src="" alt="">
                </div>
                <?php } ?>
                <div id="file-input-wrapper" onclick="fileinputhandler(this)">
                    <div>Choose file</div>
                    <button>Browse</button>
                    <input type="file" name="test_image"
                        value="<?= isset($data->image) ? $data->image : '' ?>"
                        class="file-upload d-none">
                </div>
            </div>
        </div>
        <div class="row form-group mb-4">
            <div class="col-lg-6">
                <label class="control-label">New Password</label>
                <input type="password" required name="new_password" class="form-control" value="">
            </div>
            <div class="col-lg-6">
                <label class="control-label">Confirm Password</label>
                <input type="password" required name="confirm_password" class="form-control">
            </div>
        </div>
        <div class="row form-group mb-4">
            <div class="col-md-6">
                <label>Postal Code</label>
                <input type="text" class="form-control" name="postal_code">
            </div>
            <div class="col-md-6">
                <label>Address</label>
                <textarea name="address" class="form-control"></textarea>
            </div>
        </div>
        <div class="form-group" style="text-align: right">
            <button type="submit" class="user-save" name="test_submit" value="test_submit">
                Save Changes
            </button>
        </div>
    </form>
</div> --}}

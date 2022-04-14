@extends('templates.public')

@section('content-area')
    <section class="cart container p-0 pb-4">
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
                        <a href="{{ url('/account') }}" class="profile-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="profile-item-heading">Account</span><span class="profile-item-body">Email,
                                        Password, Sign out</span>
                                </div>
                                <div><i class="fas fa-angle-right text-dark"></i></div>
                            </div>
                        </a>
                        <a href="" class="profile-item">
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
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga, qui!
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

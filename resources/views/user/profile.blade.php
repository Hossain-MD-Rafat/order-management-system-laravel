@extends('templates.public')

@section('content-area')
    <section class="user-profile">
        <div class="container">
            <div class="row">
                <div class="col-md-3 offset-md-1">
                    <img src="{{ asset('media/images/user.png') }}" alt="" class="w-50">
                    <div class="name">Lorem</div>
                    <div class="user-badge">
                        <i class="fas fa-certificate"></i> General
                    </div>
                    <div class="setting">
                        <i class="fas fa-cog"></i> Settings
                    </div>
                    <button class="logout">Logout</button>
                </div>
                <div class="col-md-8">
                    <div class="tab">
                        <div class="orders tab-item active">Orders</div>
                        <div class="completed-orders tab-item">Completed Orders</div>
                        <div class="running-orders tab-item">Running Orders</div>
                        <div class="profile-settings tab-item">Profile Setting</div>
                    </div>
                    <div class="tab-body mt-4">
                        <div class="orders-body tab-body active">
                            <div class="row bg-light mb-4" style="border-radius: 15px;">
                                <div class="col-md-2 text-center order-heading">Order</div>
                                <div class="col-md-3 text-center order-heading">Order Date</div>
                                <div class="col-md-3 text-center order-heading">Delivery Date</div>
                                <div class="col-md-2 text-center order-heading">Status</div>
                                <div class="col-md-2 text-center print-show">Action</div>
                            </div>
                            <div id="printorderdiv">
                                {{-- <?php foreach ($orders as $order) { ?>
                                <div class="row mb-3">
                                    <div class="col-md-2 text-center">#<?= $order->id ?></div>
                                    <div class="col-md-2 text-center font-italic"><?= $order->name ?></div>
                                    <div class="col-md-2 text-center"><?= $order->order_date ?></div>
                                    <div class="col-md-2 text-center"><?= $order->delivery_date ?></div>
                                    <div class="col-md-2 text-center">
                                        <?= $order->payment_status == 1 && $order->status != 2 ? 'Paid' : ($order->status == 0 ? 'not confirmed' : ($order->status == 2 ? 'delivered' : 'confirmed')) ?>
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-center">
                                        <?php if ($order->status == 0) { ?>
                                        <a class="action-icon"
                                            href="<?= base_url() . 'user/orderprint/handleedit/' . $order->id ?>"><i
                                                class="fa fa-pencil-square-o text-secondary" aria-hidden="true"></i></a>
                                        <div class="filter-link action-icon" data-toggle="modal"
                                            data-target="#exampleModalCenter"
                                            onclick="deleteOrder(this, <?= $order->id ?>)"> <i
                                                class="fa fa-trash text-danger text-center" aria-hidden="true"></i> </div>
                                        <small id="delete-message"></small>
                                        <?php } ?>
                                        <?php if ($order->status == 2) { ?>
                                        <div class="filter-link action-icon" data-toggle="modal" data-target="#addreview"
                                            onclick="addReview(<?= $order->id ?>)"> <i class="fas fa-comment-medical"></i>
                                        </div>
                                        <small id="delete-message"></small>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php } ?> --}}
                            </div>
                        </div>
                        <div class="completed-orders-body tab-body">Completed Orders</div>
                        <div class="running-orders-body tab-body">Running Orders</div>
                        <div class="profile-settings-body tab-body">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('.tab-item').click((e) => {
            $('.tab-item.active').toggleClass('active');
            $(e.target).toggleClass('active');
            let classlist = $(e.target).attr('class');
            let classname = classlist.split(" ")[0];
            $('.tab-body.active').toggleClass('active');
            $(`.${classname}-body`).toggleClass('active');
        })
    });
</script>





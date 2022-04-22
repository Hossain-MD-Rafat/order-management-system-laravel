@extends('templates.public')

@section('content-area')
    <section class="cart container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $details->name }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $details->email }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Phone</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $details->phone }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Postal Code</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $details->postal_code }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $details->address }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <a class="back-button" href="{{ url('/user') }}">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
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

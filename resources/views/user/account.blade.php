@extends('templates.public')

@section('content-area')
    <section class="cart container">
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
                <div class="mt-4 row" id="account">
                    <h2>Account</h2>
                    <div class="col-md-10">
                        <div class="account-item" id="change-telephone">
                            <div>
                                <span class="profile-item-heading">Change Telephone</span>
                            </div>
                            <div><i class="fas fa-angle-right text-dark"></i></div>
                        </div>
                        <div class="account-item" id="change-password">
                            <div>
                                <span class="profile-item-heading">Change Password</span>
                            </div>
                            <div><i class="fas fa-angle-right text-dark"></i></div>
                        </div>
                        <a class="signout-btn" href="{{ url('signout') }}">Sign out</a>
                    </div>
                </div>
                <div class="telephone-change d-none">
                    <div role="button" class="account-home"><i class="fas fa-long-arrow-alt-left"></i></div>
                    <h2 class="mb-4 text-uppercase">Change telephone</h2>
                    <span>If you want to change your current phone number. Please provide the new <br>phone number with your
                        current password</span><br><br>
                    <span>Your current phone number is <b></b></span>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <form method="POST" action="{{ url('changeaccountinfo') }}">
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
                                <div class="login-form-group mb-2">
                                    <input type="password" required class="login-input" name="password" placeholder=" ">
                                    <label class="text-uppercase">Current Password</label>
                                </div>
                                <div class="d-flex justify-content-between align-items-end mb-2">
                                    <div class="phone-prefix">
                                        <span>Prefix</span><br>
                                        <span>+86</span>
                                    </div>
                                    <div class="login-form-group w-75">
                                        <input type="number" required class="login-input mb-0" name="new_phone" placeholder=" ">
                                        <label class="text-uppercase">new phone number</label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-end mb-2">
                                    <div class="phone-prefix">
                                        <span>Prefix</span><br>
                                        <span>+86</span>
                                    </div>
                                    <div class="login-form-group w-75">
                                        <input type="number" required class="login-input mb-0" name="new_phone_again" placeholder=" ">
                                        <label class="text-uppercase">repeat new phone number</label>
                                    </div>
                                </div>

                                <button type="submit" name="phone_change" value="true"
                                    class="add-to-cart mt-4 mb-3 text-uppercase">update phone number</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="password-change d-none">
                    <div role="button" class="account-home"><i class="fas fa-long-arrow-alt-left"></i></div>
                    <h2 class="mb-5 text-uppercase">Change password</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <form method="POST" action="{{ url('changeaccountinfo') }}">
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
                                <div class="login-form-group">
                                    <input type="password" required class="login-input" name="password" placeholder=" ">
                                    <label class="text-uppercase">Current Password</label>
                                </div>
                                <div class="login-form-group">
                                    <input type="password" required class="login-input" name="new_password" placeholder=" ">
                                    <label class="text-uppercase">new Password</label>
                                </div>
                                <div class="login-form-group">
                                    <input type="password" required class="login-input" name="new_password_again" placeholder=" ">
                                    <label class="text-uppercase">repeat new Password</label>
                                </div>
                                <button type="submit" name="password_change" value="true"
                                    class="add-to-cart mt-4 mb-3 text-uppercase">update password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $('#change-telephone').click(function(e) {
            $('.password-change').addClass('d-none');
            $('.telephone-change').removeClass('d-none');
            $('#account').addClass('d-none');
        });
        $('#change-password').click(function(e) {
            $('.password-change').removeClass('d-none');
            $('.telephone-change').addClass('d-none');
            $('#account').addClass('d-none');
        });
        $('.account-home').click(function(e) {
            $('.password-change').addClass('d-none');
            $('.telephone-change').addClass('d-none');
            $('#account').removeClass('d-none');
        });
    </script>
@endsection

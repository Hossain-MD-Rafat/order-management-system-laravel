@extends('admin.admintemplate')
@section('content-area')
    <section>
        <div class="password-change">
            <div class="col-md-6 horizontal-center">
                <a href="{{ url('/admin') }}" class="account-home text-dark"><i class="fas fa-long-arrow-alt-left"></i></a>
                <h2 class="mb-5 text-uppercase">Change password</h2>
                <div class="row w-100">
                    <form method="POST" action="{{ url('admin/changeadminpass') }}">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('msg'))
                            <div class="text-success">{{ session('msg') }}</div>
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
                            <input type="password" required class="login-input" name="new_password_again"
                                placeholder=" ">
                            <label class="text-uppercase">repeat new Password</label>
                        </div>
                        <button type="submit" name="password_change" value="true"
                            class="add-to-cart mt-4 mb-3 text-uppercase">update password</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

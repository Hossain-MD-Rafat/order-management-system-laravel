@extends('admin.admintemplate')
@section('content-area')
    <section>
        <div class="login-container">
            <form method="POST" action="{{ url('adminlogin') }}">
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
                <h2>Log in</h2>
                <div class="login-form-group">
                    <input type="text" required class="login-input" name="email" placeholder=" ">
                    <label>Email or username</label>
                </div>
                <div class="login-form-group">
                    <input type="password" required class="login-input" name="password" placeholder=" ">
                    <label>Password</label>
                </div>
                <button type="submit" name="login" value="login" class="add-to-cart mt-4 mb-3">Log in</button>
            </form>
        </div>
    </section>
@endsection

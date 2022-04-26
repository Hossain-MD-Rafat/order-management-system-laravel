@extends('templates.public')
@section('content-area')
    <section>
        <div class="login-container">
            <form method="POST" action="{{ url('userregistration') }}">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @csrf
                <h2>Register</h2>
                <div class="login-form-group">
                    <input type="text" required class="login-input" name="name" placeholder=" ">
                    <label>Name</label>
                </div>
                <div class="login-form-group">
                    <input type="text" required class="login-input" name="email" placeholder=" ">
                    <label>Email</label>
                </div>
                <div class="login-form-group">
                    <input type="text" required class="login-input" name="phone" placeholder=" ">
                    <label>Phone</label>
                </div>
                <div class="login-form-group">
                    <input type="password" required class="login-input" name="password" placeholder=" ">
                    <label>Password</label>
                </div>
                <button type="submit" name="register" value="register" class="add-to-cart mt-4 mb-3">Register</button>
                <div class="new-user">Already registered? <a href="{{ url('login') }}">Login</a></div>
            </form>
        </div>
    </section>
@endsection

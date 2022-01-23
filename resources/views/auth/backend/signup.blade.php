@extends('layouts.backend.auth.auth')
@section('content')
<!-- Register-->
<div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
    <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
        <h2 class="card-title font-weight-bold mb-1">Sign Up Admin</h2>
        @if ($errors->has('email'))
            <div class="alert alert-danger" role="alert">
                <div class="alert-body">
                    {{ $errors->first('email') }}
                </div>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success">
                <div class="alert-body">
                    Successfully registered.
                </div>
            </div>
        @endif
        <form class="auth-register-form mt-2" action="{{ route('backend.signup') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="register-username">Username</label>
                <input class="form-control" id="register-username" type="text" name="register-username" placeholder="johndoe" aria-describedby="register-username" autofocus="" tabindex="1" required/>
            </div>
            <div class="form-group">
                <label class="form-label" for="register-email">Email</label>
                <input class="form-control" id="register-email" type="email" name="register-email" placeholder="john@example.com" aria-describedby="register-email" tabindex="2"  required/>
            </div>
            <div class="form-group">
                <label class="form-label" for="register-password">Password</label>
                <div class="input-group input-group-merge form-password-toggle">
                    <input class="form-control form-control-merge" id="register-password" type="password" name="register-password" placeholder="············" aria-describedby="register-password" tabindex="3"  required/>
                    <div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
                </div>
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" id="register-privacy-policy" type="checkbox" tabindex="4" required/>
                    <label class="custom-control-label" for="register-privacy-policy">I agree to<a href="javascript:void(0);">&nbsp;privacy policy & terms</a></label>
                </div>
            </div>
            <button class="btn btn-primary btn-block" tabindex="5">Sign up</button>
        </form>
        <p class="text-center mt-2"><span>Already have an account?</span><a href="/signin"><span>&nbsp;Sign in instead</span></a></p>
    </div>
</div>
<!-- /Register-->
@endsection
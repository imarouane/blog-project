@extends('layouts.custom-login-layout')

@section('content')
    <div class="col-lg-7">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-4">Create Account</h3>
            </div>
            <div class="card-body">
                @error('error')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <form method="POST" action="{{ route('custom.register') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input name="firstname" value="{{ old('firstname') }}"
                                    class="form-control @error('firstname') is-invalid @enderror" id="inputFirstName"
                                    type="text" placeholder="Enter your first name" />
                                <label for="inputFirstName">First name</label>
                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input name="lastname" value="{{ old('lastname') }}"
                                    class="form-control @error('lastname') is-invalid @enderror" id="inputLastName"
                                    type="text" placeholder="Enter your last name" />
                                <label for="inputLastName">Last name</label>
                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" id="inputEmail" type="email"
                            placeholder="name@example.com" />
                        <label for="inputEmail">Email address</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input name="password" class="form-control @error('password') is-invalid @enderror"
                                    id="inputPassword" type="password" placeholder="Create a password" />
                                <label for="inputPassword">Password</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="inputPasswordConfirm" type="password" placeholder="Confirm password" />
                                <label for="inputPasswordConfirm">Confirm Password</label>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 mb-0">
                        <div class="d-grid"> <button class="btn btn-primary btn-block">Create Account</button></div>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <div class="small"><a href="{{ route('custom.login') }}">Have an account? Go to login</a></div>
            </div>
        </div>
    </div>
@endsection

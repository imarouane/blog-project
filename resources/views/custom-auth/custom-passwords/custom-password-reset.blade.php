@extends('layouts.custom-login-layout')

@section('content')
    <div class="col-lg-5">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-4">Reset Password</h3>
            </div>
            <div class="card-body">
                @error('status')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <form method="POST" action="{{ route('custom.password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-floating mb-3">
                        <input name="email" class="form-control" id="inputEmail" type="email"
                            placeholder="name@example.com" value="{{ $email ?? old('email') }}" />
                        <label for="inputEmail">Email address</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input name="password" class="form-control @error('password') is-invalid @enderror"
                            id="inputPassword" type="password" placeholder="Password" />
                        <label for="inputPassword">Password</label>
                        @error('password')
                            @if ($message !== 'The password field confirmation does not match.')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @endif
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror" id="inputPassword"
                            type="password" placeholder="Password" />
                        <label for="inputPassword">Confirm Password</label>
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('password')
                            @if ($message === 'The password field confirmation does not match.')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @endif
                        @enderror
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <button type="submit" class="btn btn-primary">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

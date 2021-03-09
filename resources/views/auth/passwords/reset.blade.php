@extends('auth.app')

@section('content')

<p class="text-center">RESET PASSWORD</p>
{{-- <p class="text-muted text-center">
<small>Enter your email address to recover your password.</small>
</p> --}}<br>

<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group">
        <label for="email">{{ __('E-Mail Address') }}</label>
        <input id="email" type="email" class="form_submit underline form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            {{ $errors->first('email') }}
        </span>
        @endif
    </div>

    <div class="form-group">
        <label for="password">{{ __('Password') }}</label>
        <input id="password" type="password" class="form_submit underline form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

        @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
            {{ $errors->first('password') }}
        </span>
        @endif
    </div>

    <div class="form-group">
        <label for="password-confirm">{{ __('Confirm Password') }}</label>
        <input id="password-confirm" type="password" class="form_submit underline form-control" name="password_confirmation" required>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            {{ __('Reset Password') }}
        </button>
    </div>
</form>

@endsection

@extends('auth.app')

@section('page_title')
LOGIN
@endsection

@section('page_description')
Please, enter your credentials to continue.
@endsection

@section('content')

<form method="POST" action="{{ route('login') }}" id="login-form" novalidate="">
    @csrf

    {{-- email --}}
    <div class="form-group">
        <label for="email" class="">{{ __('E-Mail Address') }}</label>
        <input id="email" type="email" class="form_submit underlined form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Your email" value="{{ old('email') }}" required autofocus>

        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('email') }}
            </span>
        @endif
    </div>

    {{-- password --}}
    <div class="form-group">
        <label for="password" class="">{{ __('Password') }}</label>
        <input id="password" type="password" class="form_submit underlined form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Your password" required>
    </div>

    {{-- remember --}}
    <div class="form-group">
        <div class="form-check d-inline" style="padding-left: 0">
            <label class="item-check" id="select-all-items">
                <input type="checkbox" class="app_checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <span>{{ __('Remember Me') }}</span>
            </label>
        </div>

        {{-- forgot --}}
        <a class="forgot-btn pull-right d-inline" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    </div>

    {{-- submit --}}
    <div class="form-group">
        <button type="submit" class="btn btn-block btn-primary">{{ __('Login') }}</button>
    </div>
</form>

@endsection

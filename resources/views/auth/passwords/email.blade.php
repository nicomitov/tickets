@extends('auth.app')

@section('page_title')
PASSWORD RECOVER
@endsection

@section('page_description')
Enter your email address to recover your password.
@endsection

@section('content')

    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" id="reset-form" novalidate="">
        @csrf

        <div class="form-group">
            <label for="email">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="form_submit underlined form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Your email" required>

            @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('email') }}
            </span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-block btn-primary">
                {{ __('Send Password Reset Link') }}
            </button>
        </div>

        <div class="form-group clearfix">
            <a class="pull-right" href="{{ route('login') }}">return to Login</a>
        </div>
    </form>

@endsection

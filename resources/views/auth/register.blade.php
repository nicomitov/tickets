@extends('auth.app')

@section('page_title')
REGISTER
@endsection

@section('page_description')
Please, fill out the form bellow.
@endsection

@section('content')

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="form-group">
        <label for="name" class="">{{ __('Name') }}</label>
        <input id="name" type="text" class="form_submit underlined form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="email" class="">{{ __('E-Mail Address') }}</label>
        <input id="email" type="email" class="form_submit underlined form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="password" class="">{{ __('Password') }}</label>
        <input id="password" type="password" class="form_submit underlined form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>
        <input id="password-confirm" type="password" class="form_submit underlined form-control" name="password_confirmation" required>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            {{ __('Register') }}
        </button>
    </div>
</form>

@endsection

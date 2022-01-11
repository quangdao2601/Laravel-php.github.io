@extends('layouts.storee')
@extends('layouts.app')
@section('main-content')
<div class="reset">
    
<form method="POST" class="form-" class="form-reset" action="{{ route('password.update') }}">
    @csrf
    <h1 style="font-weight: bold;font-size:24px;margin-bottom:10px">Đặt lại mật khẩu</h1>

    <input type="hidden" name="token" value="{{ $token }}">


    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

    @error('email')
    <span class="invalid-feedback" role="alert">
        <strong class="text text-warning">{{ $message }}</strong>
    </span>
    @enderror



    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>


    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

    @error('password')
    <span class="invalid-feedback" role="alert">
        <strong class="text text-warning">{{ $message }}</strong>
    </span>
    @enderror



    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>


    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">



    <button type="submit" class="btn btn-primary">
        {{ __('Reset Password') }}
    </button>

</form>
</div>

@endsection
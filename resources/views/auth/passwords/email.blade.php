@extends('layouts.storee')

@section('main-content')

<div class="forget-pass">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" class="form-fp" action="{{ route('password.email') }}">
        @csrf

        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>


        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <button type="submit" class="btn btn-primary">
            {{ __('Send Password Reset Link') }}
        </button>

    </form>
</div>

@endsection
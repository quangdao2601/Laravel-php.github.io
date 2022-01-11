@extends('layouts.storee')
@section('main-content')

<div class="verified">

    <div class="card-body">
        @if (session('resent'))
        <div class="alert alert-success " style="padding: 10px;" role="alert">
            Mã xác minh đã được gửi tới Email của bạn vui lòng kiểm tra để xác thực tài khoản
        </div>
        @endif
        <div class="card-header">Tài khoản Email của bạn chưa được xác minh</div>
        Trước khi tiếp tục, vui lòng kiểm tra email của bạn xác thực tài khoản. Nếu bạn không nhận được email
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn-kh">Bấm vào đây để kích hoạt tài khoản của bạn</button>.

        </form>


        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
            Click vào đây để quay về trang chủ
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>


    </div>
</div>


@endsection
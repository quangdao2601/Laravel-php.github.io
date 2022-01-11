@extends('layouts.storee')
@section('main-content')

<div class="section" id="customer-info-wp">
    <div class="section-head">
        <h1 class="section-title">Thông tin khách hàng</h1>
    </div>
    <div class="section-detail">
        @if(Cart::count()>0)
        <form method="POST" action="{{route('reslove')}}" name="form-checkout">
            @csrf
            <div class="form-row clearfix">
                <div class="form-col fl-left">
                    <label for="fullname">Họ tên</label>
                    <input type="text" readonly="readonly" name="fullname" value="{{Auth::user()->name}}" id="fullname">
                </div>
                <div class="form-col fl-right">
                    <label for="email">Email</label>
                    <input value="{{Auth::user()->email}}" readonly="readonly" type="email" name="email" id="email">
                </div>
            </div>
            <div class="form-row clearfix">
                <div class="form-col fl-left">
                    <label for="address">Địa chỉ</label>
                    <input type="text" name="address" id="address">
                    @error('address')
                    <p style="color: red ;" class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-col fl-right">
                    <label for="phone">Số điện thoại</label>
                    <input type="tel" name="phone" id="phone">
                    @error('phone')
                    <p style="color: red;" class="text text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="form-row">

                <label for="notes">Ghi chú</label>
                <textarea style="width:100%;height:300px;padding:10px" name="note"></textarea>


            </div>
            <label for="0">Than toán qua thẻ</label>
            <input type="radio" style="margin-right: 10px;" id="0" name="payment" value="0">
            <label for="1">Thanh toán khi nhận hàng</label>
            <input type="radio" id="1" name="payment" value="1">
            @error('payment')
            <p style="color: red;" class="text-danger">{{$message}}</p>

            @enderror
            <input style="display: block;margin-top:10px;border:none;background:deepskyblue;padding:10px;width:100px" type="submit" name="order" value="Đặt hàng">


        </form>
        @else
        <p>Không có bất kỳ sản phẩm nào trong giỏ hàng</p>
        @endif
    </div>
</div>
<div class="section" id="order-review-wp">
    <div class="section-head">
        <h1 class="section-title">Thông tin đơn hàng</h1>
    </div>
    <div class="section-detail">
        <table class="shop-table">
            <thead>
                <tr>
                    <td>Sản phẩm</td>
                    <td>Tổng</td>
                </tr>
            </thead>
            <tbody>
                @foreach(Cart::content() as $product)
                <tr class="cart-item">
                    <td class="product-name">{{$product->name}}<strong class="product-quantity">x {{$product->qty}}</strong></td>
                    <td class="product-total">{{number_format($product->total)}}.đ</td>
                </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr class="order-total">
                    <td>Tổng đơn hàng:</td>
                    <td><strong class="total-price">{{number_format(Cart::total())}}.đ</strong></td>
                </tr>
            </tfoot>
        </table>


    </div>
</div>

@endsection
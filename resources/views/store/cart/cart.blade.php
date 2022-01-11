@extends('layouts.storee')
@section('main-content')
<div class="section" id="info-cart-wp">
    <div class="section-detail table-responsive">
        <form action="{{route('cart_update')}}" method="POST">
            @csrf
            <table class="table">
                <thead>
                    <tr>
                        <td>Mã sản phẩm</td>
                        <td>Ảnh sản phẩm</td>
                        <td>Tên sản phẩm</td>
                        <td>Giá sản phẩm</td>
                        <td>Số lượng</td>
                        <td colspan="2">Thành tiền</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach(Cart::content() as $product)
                    <tr>
                        <td>HCA00032</td>
                        <td>
                            <a href="{{route('product_detail',$product->id)}}" title="" class="thumb">
                                <img src="{{asset('uploads/product')}}/{{$product->options->img_product}}" alt="">
                            </a>
                        </td>
                        <td>
                            <a href="{{route('product_detail',$product->id)}}" title="" class="name-product">{{$product->name}}</a>
                        </td>
                        <td>{{number_format($product->price)}}.đ</td>
                        <td>
                            <input type="number" name="rowId[{{$product->rowId}}]" value="{{$product->qty}}" max="{{$product->options->qty_max}}" class="num-order">
                        </td>
                        <td>{{number_format($product->total)}}.đ</td>
                        <td>
                            <a href="{{route('cart_delete_product',$product->rowId)}}" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7">
                            <div class="clearfix">
                                <p id="total-price" class="fl-right">Tổng giá: <span>{{Cart::total()}}đ</span></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <div class="clearfix">
                                <div class="fl-right">
                                    <input type="submit" id="update-cart" value="Cập nhật giỏ hàng">
                                    <a href="{{route('checkout')}}" title="" id="checkout-cart">Thanh toán</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>
    </div>
</div>
<div class="section" id="action-cart-wp">
    <div class="section-detail">
        <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
        <a href="{{url('')}}" title="" id="buy-more">Mua tiếp</a><br />
        <a href="{{route('cart_destroy')}}" title="" id="delete-cart">Xóa giỏ hàng</a>
    </div>
</div>

@endsection
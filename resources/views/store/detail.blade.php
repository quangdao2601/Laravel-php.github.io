@extends('layouts.storee')
@section('main-content')

<div class="section" id="detail-product-wp">
    <div class="section-detail clearfix">
        <div class="thumb-respon-wp fl-left">
            <img src="{{asset('uploads/product')}}/{{$info_product->img_product}}">
        </div>
        <div class="info fl-right">
            <h3 class="product-name">{{$info_product->name}}</h3>
            <div class="desc">
                {!!$info_product->desc!!}
            </div>
            <div class="num-product">
                <span class="title">Sản phẩm: </span>
                <span class="status">Còn hàng({{$info_product->qty}})</span>
            </div>
            <p class="price">{{number_format($info_product->price)}}.đ</p>
            
            @if($info_product->qty == 0)
            <a href="?page=cart" title="Thêm giỏ hàng"  class="add-cart">Sản phẩm đang hết hàng</a>
            @else
            <a href="{{route('add_product',$info_product->id)}}" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a>
            @endif
            
        </div>
    </div>
</div>
<div class="section" id="post-product-wp">
    <div class="section-head">
        <h3 class="section-title">Mô tả sản phẩm</h3>
    </div>
    <div class="section-detail">
        {!!$info_product->content!!}
    </div>
</div>
<div class="section" id="same-category-wp">
    <div class="section-head">
        <h3 class="section-title">Cùng chuyên mục</h3>
    </div>
    <div class="section-detail">
        <ul class="list-item">
            @if(!empty($list_product_relevant))
            @foreach($list_product_relevant as $product)
            <li>
                <a href="{{route('product_detail',$product->id)}}" title="" class="thumb">
                    <img src="{{asset('uploads/product')}}/{{$product->img_product}}">
                </a>
                <a href="{{route('product_detail',$product->id)}}" title="" class="product-name">{{$product->name}}</a>
                <div class="price">
                    <span class="new">{{number_format($product->price)}}.đ</span>
                    <span class="old">{{number_format($product->old_price)}}.đ</span>
                </div>
            </li>
            @endforeach
            @endif
        </ul>
    </div>
</div>
@endsection
@extends('layouts.storee')
@section('main-content')
<div class="section" id="list-product-wp">
        @if(!empty($list_product))
        @foreach($list_product as $item)
        <div class="section-head">
            <h3 class="section-title">{{$item['name']}}</h3>
        </div>
        <div class="section-detail">
            <ul class="list-item clearfix">
                @if(!empty($item))
                @foreach($item['product'] as $product)
                <li>
                    <a href="{{route('product_detail',$product->id)}}" title="" class="thumb">
                        <img src="{{asset('uploads/product')}}/{{$product->img_product}}">
                    </a>
                    <a href="?page=detail_product" title="" class="product-name">{{$product->name}}</a>
                    <div class="price">
                        <span class="new">{{number_format($product->price)}}.đ</span>
                        <span class="old">{{number_format($product->old_price)}}.đ</span>
                    </div>
                    <div class="star-rate"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></div>
                    <div class="clearfix"></div>
                </li>
                @endforeach
                @endif
            </ul>
        </div>
        @endforeach
        @endif
    </div>

@endsection
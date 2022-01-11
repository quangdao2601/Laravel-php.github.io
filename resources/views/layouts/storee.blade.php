<!-- body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        } -->

</style>

</body>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>ISMART STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link href="{{asset('smart/css/bootstrap/bootstrap-theme.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('smart/css/bootstrap/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('smart/reset.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('smart/css/carousel/owl.carousel.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('smart/css/carousel/owl.theme.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('smart/css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('smart/css/font-awesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('smart/css/fontawesome/css/all.css')}}" rel="stylesheet" type="text/css" />

    <!-- <link href="{{asset('smart/css/font-awesome/css/all.css')}}" rel="stylesheet"  /> -->
    <link href="{{asset('smart/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('smart/responsive.css')}}" rel="stylesheet" type="text/css" />
    <!-- <script src="{{asset('smart/js/jquery-2.2.4.min.js')}}" type="text/javascript"></script> -->
    <script src="{{asset('js/jquery-3.5.1.js')}}" type="text/javascript"></script>
    <script src="{{asset('smart/js/elevatezoom-master/jquery.elevatezoom.js')}}" type="text/javascript"></script>
    <script src="{{asset('smart/js/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('smart/js/carousel/owl.carousel.js')}}" type="text/javascript"></script>
    <script src="{{asset('smart/js/main.js')}}" type="text/javascript"></script>



</head>
<script>
    $(document).ready(function() {

        $('input.search').keyup(function() { //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
            var query = $(this).val(); //lấy gía trị ng dùng gõ
            //  alert(query)
            var data = {
                query: query
            }
            $.ajax({
                url: "http://localhost:8080/unitop.vn/back-end/lavarel/project/smartkey/search/name", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
                method: 'GET', // phương thức gửi dữ liệu.
                data: data,
                success: function(data) { //dữ liệu nhận về
                    // $('#list-seach').fadeIn();
                    $('#list-seach').html(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là countryList
                }
            });

        });

    });
</script>

<body>
    <div id="site">

        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="{{url('')}}" title="">Trang chủ</a>

                                </li>
                                <li>
                                    <a href="?page=category_product" title="">Sản phẩm</a>
                                </li>
                                <li>
                                    <a href="?page=blog" title="">Blog</a>
                                </li>
                                <li>
                                    <a href="?page=detail_blog" title="">Giới thiệu</a>
                                </li>
                                <li>
                                    <a href="?page=detail_blog" title="">Liên hệ</a>
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>

                        @if (isset(Auth::user()->name))

                        <div class="user">
                            <div class="fl-right" style="color:white;font-size:16px;">
                                <div style="float: left;width:45px;height:auto"> <img src="{{asset('smart/images/images.png')}}" alt=""></div>
                                <div class="name" style="float: left;color:black;font-weight:normal">{{Auth::user()->name}}</div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="drop">
                                <div class="info">Thông tin cá nhân</div>
                                <div class="logout">
                                    <a class="dropdown-item" href="{{ route('logout') }}" style="color:black;" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Đăng xuất
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="customer fl-right">
                            <div class="" style="float:left;width:45px;height:auto"><a href=""><img src="{{asset('smart/images/90e54b0a7a59948dd910ba50954c702e.png')}}" alt=""></a></div>
                            <div class="" style="float: left">
                                <div class="login"> <a href="{{url('login')}}" style="color:white">Đăng nhập /</a><a href="{{url('register')}}" style="color:white"> Đăng ký</a></div>
                                <div class="account" style="display: flex;"><a style="color:white" href="">Tài khoản</a><a href=""><img style="width: 25px;height:auto" src="{{asset('smart/images/34939af2da1ceeeae9f95b7485784233.png')}}" alt=""></a></div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="dropdown" style="background-color:royalblue;width:200px;text-align:center;padding:10px;border:1px solid black">
                                <div class="login" style="background-color:aqua;margin-bottom:10px;border-radius:5px;padding:5px"><a style="color:black" href="{{url('login')}}">Đăng nhập</a></div>
                                <div class="reg" style="background-color:aqua;border-radius:5px;padding:5px"><a style="color:black" href="{{url('register')}}">Đăng ký</a></div>
                            </div>
                        </div>
                        @endif
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="?page=home" title="" id="logo" class="fl-left"><img src="{{asset('smart/images/logo.png')}}" /></a>
                        <div id="search-wp" class="fl-left">
                            <form method="GET" action="{{route('ajax')}}">
                                @csrf
                                <input type="text" name="search" id="s" class="search" value="" placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                <button type="submit" id="sm-s">Tìm kiếm</button>
                            </form>


                            <div id="list-seach"></div>


                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0987.654.321</span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="?page=cart" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num">2</span>
                            </a>
                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <a href="{{route('cart')}}"> <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                                    <span id="num">{{Cart::count()}}</span>
                                </div>
                                <div id="dropdown">
                                    <p class="desc">Có <span>{{Cart::count()}} sản phẩm</span> trong giỏ hàng</p>
                                    <ul class="list-cart">
                                        @foreach(Cart::content() as $product)
                                        <li class="clearfix">
                                            <a href="{{route('product_detail',$product->id)}}" title="" class="thumb fl-left">
                                                <img src="{{asset('uploads/product')}}/{{$product->options->img_product}}" alt="" }>
                                            </a>
                                            <div class="info fl-right">
                                                <a href="{{route('product_detail',$product->id)}}" title="" class="product-name">{{$product->name}}</a>
                                                <p class="price">{{number_format($product->price)}}.đ</p>
                                                <p class="qty">Số lượng: <span>{{$product->qty}}</span}>
                                                </p>
                                            </div>
                                        </li>
                                        @endforeach

                                    </ul>
                                    <div class="total-price clearfix">
                                        <p class="title fl-left">Tổng:</p>
                                        <p class="price fl-right">{{Cart::total()}}.đ</p>
                                    </div>
                                    <dic class="action-cart clearfix">
                                        <a href="{{route('cart')}}" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                        <a href="{{route('checkout')}}" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                    </dic>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="head-footer">
                    <div class="wp-inner">
                        <ul class="main-menu">
                            <a href="{{route('product',25)}}">
                                <li><i class="fas fa-mobile-alt"></i> Điện thoại
                                </li>
                            </a>
                            <a href="{{route('product',30)}}">
                                <li><i class="fas fa-laptop"></i> Laptop</li>
                            </a>
                            <a href="">
                                <li><i class="fas fa-tablet-alt"></i> Máy tính bảng</li>
                            </a>
                            <a href="">
                                <li><i class="far fa-keyboard"></i> Phụ kiện</li>
                            </a>
                            <a href="">
                                <li></i> Đồng hồ thời trang</li>
                            </a>
                            <a href="">
                                <li>Sim thẻ cào</li>
                            </a>
                            <a href="">
                                <li>Trả góp</li>
                            </a>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="head-copyright">
                    <div class="wp-inner">
                        <div class="section" id="slider-wp">
                            <div class="section-detail">
                                <div class="item">
                                    <img src="{{asset('smart/images/slider_1.jpg')}}" alt="">
                                </div>
                                <div class="item">
                                    <img src="{{asset('smart/images/s20-plus-pc-banner.jpg')}}" alt="">
                                </div>
                                <div class="item">
                                    <img src="{{asset('smart/images/bl-1200x450-banner-samsung-sieu-sale1-min.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="section" id="support-wp">
                            <div class="section-detail">
                                <ul class="list-item clearfix">
                                    <li>
                                        <div class="thumb">
                                            <img src="{{asset('smart/images/icon-1.png')}}">
                                        </div>
                                        <h3 class="title">Miễn phí vận chuyển</h3>
                                        <p class="desc">Tới tận tay khách hàng</p>

                                    </li>
                                    <li>
                                        <div class="thumb">
                                            <img src="{{asset('smart/images/icon-2.png')}}">
                                        </div>
                                        <h3 class="title">Tư vấn 24/7</h3>
                                        <p class="desc">1900.9999</p>
                                    </li>
                                    <li>
                                        <div class="thumb">
                                            <img src="{{asset('smart/images/icon-3.png')}}">
                                        </div>
                                        <h3 class="title">Tiết kiệm hơn</h3>
                                        <p class="desc">Với nhiều ưu đãi cực lớn</p>
                                    </li>
                                    <li>
                                        <div class="thumb">
                                            <img src="{{asset('smart/images/icon-4.png')}}">
                                        </div>
                                        <h3 class="title">Thanh toán nhanh</h3>
                                        <p class="desc">Hỗ trợ nhiều hình thức</p>
                                    </li>
                                    <li>
                                        <div class="thumb">
                                            <img src="{{asset('smart/images/icon-5.png')}}">
                                        </div>
                                        <h3 class="title">Đặt hàng online</h3>
                                        <p class="desc">Thao tác đơn giản</p>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="main-content-wp" class="home-page clearfix">
                <div class="wp-inner">
                    @yield('main-content')

                </div>
            </div>
            <div id="footer-wp">
                <div id="foot-body">
                    <div class="wp-inner clearfix">
                        <div class="block" id="info-company">
                            <h3 class="title">ISMART</h3>
                            <p class="desc">ISMART luôn cung cấp luôn là sản phẩm chính hãng có thông tin rõ ràng, chính sách ưu đãi cực lớn cho khách hàng có thẻ thành viên.</p>
                            <div id="payment">
                                <div class="thumb">
                                    <img src="public/images/img-foot.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="block menu-ft" id="info-shop">
                            <h3 class="title">Thông tin cửa hàng</h3>
                            <ul class="list-item">
                                <li>
                                    <p>106 - Trần Bình - Cầu Giấy - Hà Nội</p>
                                </li>
                                <li>
                                    <p>0987.654.321 - 0989.989.989</p>
                                </li>
                                <li>
                                    <p>vshop@gmail.com</p>
                                </li>
                            </ul>
                        </div>
                        <div class="block menu-ft policy" id="info-shop">
                            <h3 class="title">Chính sách mua hàng</h3>
                            <ul class="list-item">
                                <li>
                                    <a href="" title="">Quy định - chính sách</a>
                                </li>
                                <li>
                                    <a href="" title="">Chính sách bảo hành - đổi trả</a>
                                </li>
                                <li>
                                    <a href="" title="">Chính sách hội viện</a>
                                </li>
                                <li>
                                    <a href="" title="">Giao hàng - lắp đặt</a>
                                </li>
                            </ul>
                        </div>
                        <div class="block" id="newfeed">
                            <h3 class="title">Bảng tin</h3>
                            <p class="desc">Đăng ký với chung tôi để nhận được thông tin ưu đãi sớm nhất</p>
                        </div>
                    </div>
                </div>
                <div id="foot-bot">
                    <div class="wp-inner">
                        <p id="copyright">© Bản quyền thuộc về unitop.vn | Php Master</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="menu-respon">
            <a href="?page=home" title="" class="logo">VSHOP</a>
            <div id="menu-respon-wp">
                <ul class="" id="main-menu-respon">
                    <li>
                        <a href="?page=home" title>Trang chủ</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Điện thoại</a>
                        <ul class="sub-menu">
                            <li>
                                <a href="?page=category_product" title="">Iphone</a>
                            </li>
                            <li>
                                <a href="?page=category_product" title="">Samsung</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?page=category_product" title="">Iphone X</a>
                                    </li>
                                    <li>
                                        <a href="?page=category_product" title="">Iphone 8</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?page=category_product" title="">Nokia</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Máy tính bảng</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Laptop</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Đồ dùng sinh hoạt</a>
                    </li>
                    <li>
                        <a href="?page=blog" title>Blog</a>
                    </li>
                    <li>
                        <a href="#" title>Liên hệ</a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="btn-top"><img src="public/images/icon-to-top.png" alt="" /></div>
        <div id="fb-root"></div>

        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=849340975164592";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>

</body>

</html>
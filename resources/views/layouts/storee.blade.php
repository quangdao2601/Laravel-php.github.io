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

        $('input.search').keyup(function() { //b???t s??? ki???n keyup khi ng?????i d??ng g?? t??? kh??a tim ki???m
            var query = $(this).val(); //l???y g??a tr??? ng d??ng g??
            //  alert(query)
            var data = {
                query: query
            }
            $.ajax({
                url: "http://localhost:8080/unitop.vn/back-end/lavarel/project/smartkey/search/name", // ???????ng d???n khi g???i d??? li???u ??i 'search' l?? t??n route m??nh ?????t b???n m??? route l??n xem l?? hi???u n?? l?? c??i j.
                method: 'GET', // ph????ng th???c g???i d??? li???u.
                data: data,
                success: function(data) { //d??? li???u nh???n v???
                    // $('#list-seach').fadeIn();
                    $('#list-seach').html(data); //nh???n d??? li???u d???ng html v?? g??n v??o c???p th??? c?? id l?? countryList
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
                        <a href="" title="" id="payment-link" class="fl-left">H??nh th???c thanh to??n</a>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="{{url('')}}" title="">Trang ch???</a>

                                </li>
                                <li>
                                    <a href="?page=category_product" title="">S???n ph???m</a>
                                </li>
                                <li>
                                    <a href="?page=blog" title="">Blog</a>
                                </li>
                                <li>
                                    <a href="?page=detail_blog" title="">Gi???i thi???u</a>
                                </li>
                                <li>
                                    <a href="?page=detail_blog" title="">Li??n h???</a>
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
                                <div class="info">Th??ng tin c?? nh??n</div>
                                <div class="logout">
                                    <a class="dropdown-item" href="{{ route('logout') }}" style="color:black;" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        ????ng xu???t
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
                                <div class="login"> <a href="{{url('login')}}" style="color:white">????ng nh???p /</a><a href="{{url('register')}}" style="color:white"> ????ng k??</a></div>
                                <div class="account" style="display: flex;"><a style="color:white" href="">T??i kho???n</a><a href=""><img style="width: 25px;height:auto" src="{{asset('smart/images/34939af2da1ceeeae9f95b7485784233.png')}}" alt=""></a></div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="dropdown" style="background-color:royalblue;width:200px;text-align:center;padding:10px;border:1px solid black">
                                <div class="login" style="background-color:aqua;margin-bottom:10px;border-radius:5px;padding:5px"><a style="color:black" href="{{url('login')}}">????ng nh???p</a></div>
                                <div class="reg" style="background-color:aqua;border-radius:5px;padding:5px"><a style="color:black" href="{{url('register')}}">????ng k??</a></div>
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
                                <input type="text" name="search" id="s" class="search" value="" placeholder="Nh???p t??? kh??a t??m ki???m t???i ????y!">
                                <button type="submit" id="sm-s">T??m ki???m</button>
                            </form>


                            <div id="list-seach"></div>


                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">T?? v???n</span>
                                <span class="phone">0987.654.321</span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="?page=cart" title="gi??? h??ng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num">2</span>
                            </a>
                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <a href="{{route('cart')}}"> <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                                    <span id="num">{{Cart::count()}}</span>
                                </div>
                                <div id="dropdown">
                                    <p class="desc">C?? <span>{{Cart::count()}} s???n ph???m</span> trong gi??? h??ng</p>
                                    <ul class="list-cart">
                                        @foreach(Cart::content() as $product)
                                        <li class="clearfix">
                                            <a href="{{route('product_detail',$product->id)}}" title="" class="thumb fl-left">
                                                <img src="{{asset('uploads/product')}}/{{$product->options->img_product}}" alt="" }>
                                            </a>
                                            <div class="info fl-right">
                                                <a href="{{route('product_detail',$product->id)}}" title="" class="product-name">{{$product->name}}</a>
                                                <p class="price">{{number_format($product->price)}}.??</p>
                                                <p class="qty">S??? l?????ng: <span>{{$product->qty}}</span}>
                                                </p>
                                            </div>
                                        </li>
                                        @endforeach

                                    </ul>
                                    <div class="total-price clearfix">
                                        <p class="title fl-left">T???ng:</p>
                                        <p class="price fl-right">{{Cart::total()}}.??</p>
                                    </div>
                                    <dic class="action-cart clearfix">
                                        <a href="{{route('cart')}}" title="Gi??? h??ng" class="view-cart fl-left">Gi??? h??ng</a>
                                        <a href="{{route('checkout')}}" title="Thanh to??n" class="checkout fl-right">Thanh to??n</a>
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
                                <li><i class="fas fa-mobile-alt"></i> ??i???n tho???i
                                </li>
                            </a>
                            <a href="{{route('product',30)}}">
                                <li><i class="fas fa-laptop"></i> Laptop</li>
                            </a>
                            <a href="">
                                <li><i class="fas fa-tablet-alt"></i> M??y t??nh b???ng</li>
                            </a>
                            <a href="">
                                <li><i class="far fa-keyboard"></i> Ph??? ki???n</li>
                            </a>
                            <a href="">
                                <li></i> ?????ng h??? th???i trang</li>
                            </a>
                            <a href="">
                                <li>Sim th??? c??o</li>
                            </a>
                            <a href="">
                                <li>Tr??? g??p</li>
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
                                        <h3 class="title">Mi???n ph?? v???n chuy???n</h3>
                                        <p class="desc">T???i t???n tay kh??ch h??ng</p>

                                    </li>
                                    <li>
                                        <div class="thumb">
                                            <img src="{{asset('smart/images/icon-2.png')}}">
                                        </div>
                                        <h3 class="title">T?? v???n 24/7</h3>
                                        <p class="desc">1900.9999</p>
                                    </li>
                                    <li>
                                        <div class="thumb">
                                            <img src="{{asset('smart/images/icon-3.png')}}">
                                        </div>
                                        <h3 class="title">Ti???t ki???m h??n</h3>
                                        <p class="desc">V???i nhi???u ??u ????i c???c l???n</p>
                                    </li>
                                    <li>
                                        <div class="thumb">
                                            <img src="{{asset('smart/images/icon-4.png')}}">
                                        </div>
                                        <h3 class="title">Thanh to??n nhanh</h3>
                                        <p class="desc">H??? tr??? nhi???u h??nh th???c</p>
                                    </li>
                                    <li>
                                        <div class="thumb">
                                            <img src="{{asset('smart/images/icon-5.png')}}">
                                        </div>
                                        <h3 class="title">?????t h??ng online</h3>
                                        <p class="desc">Thao t??c ????n gi???n</p>

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
                            <p class="desc">ISMART lu??n cung c???p lu??n l?? s???n ph???m ch??nh h??ng c?? th??ng tin r?? r??ng, ch??nh s??ch ??u ????i c???c l???n cho kh??ch h??ng c?? th??? th??nh vi??n.</p>
                            <div id="payment">
                                <div class="thumb">
                                    <img src="public/images/img-foot.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="block menu-ft" id="info-shop">
                            <h3 class="title">Th??ng tin c???a h??ng</h3>
                            <ul class="list-item">
                                <li>
                                    <p>106 - Tr???n B??nh - C???u Gi???y - H?? N???i</p>
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
                            <h3 class="title">Ch??nh s??ch mua h??ng</h3>
                            <ul class="list-item">
                                <li>
                                    <a href="" title="">Quy ?????nh - ch??nh s??ch</a>
                                </li>
                                <li>
                                    <a href="" title="">Ch??nh s??ch b???o h??nh - ?????i tr???</a>
                                </li>
                                <li>
                                    <a href="" title="">Ch??nh s??ch h???i vi???n</a>
                                </li>
                                <li>
                                    <a href="" title="">Giao h??ng - l???p ?????t</a>
                                </li>
                            </ul>
                        </div>
                        <div class="block" id="newfeed">
                            <h3 class="title">B???ng tin</h3>
                            <p class="desc">????ng k?? v???i chung t??i ????? nh???n ???????c th??ng tin ??u ????i s???m nh???t</p>
                        </div>
                    </div>
                </div>
                <div id="foot-bot">
                    <div class="wp-inner">
                        <p id="copyright">?? B???n quy???n thu???c v??? unitop.vn | Php Master</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="menu-respon">
            <a href="?page=home" title="" class="logo">VSHOP</a>
            <div id="menu-respon-wp">
                <ul class="" id="main-menu-respon">
                    <li>
                        <a href="?page=home" title>Trang ch???</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title>??i???n tho???i</a>
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
                        <a href="?page=category_product" title>M??y t??nh b???ng</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Laptop</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title>????? d??ng sinh ho???t</a>
                    </li>
                    <li>
                        <a href="?page=blog" title>Blog</a>
                    </li>
                    <li>
                        <a href="#" title>Li??n h???</a>
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
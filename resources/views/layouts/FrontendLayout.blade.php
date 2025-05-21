<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', "Home") - {{ env('APP_NAME') }}</title>
    <link rel="shortcut icon" href="{{ asset('frontend/assets/img/fav.png')}}" type="image/x-icon">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />

    <!-- *Swipper Cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- *Swipper Cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>
    <!-- *Icon Cdn -->
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <!-- *Icon Cdn -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
</head>

<body>
    <header>
        <!-- *Top Bar Section start -->
        <section id="topBar">
            <div class="container">
                <div class="row align-items-center">
                    <div
                        class="col-lg-6 col d-flex align-items-center justify-content-lg-start justify-content-center location">
                        <iconify-icon icon="fluent:location-20-regular"></iconify-icon>
                        <p>Store Location: Lincoln- 344, Illinois, Chicago, USA </p>
                    </div>
                    <div class="col-lg-6 d-lg-flex d-none align-items-center justify-content-end quickActions">
                        <form action="">
                            <select>
                                <option>Eng</option>
                                <option>Bn</option>
                                <option>Hin</option>
                            </select>
                            <select>
                                <option>USD</option>
                                <option>BDT</option>
                                <option>RP</option>
                            </select>
                        </form>
                        <a href="{{ route('login') }}">Sign In / Sign Up</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- *Top Bar Section end -->

        <!-- *Middle Bar Section Desktop start -->
        <section id="middleBar" class="d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Logo -->
                    <div class="col-lg-3">
                        <div class="logo">
                            <a href="{{ route('homepage') }}">
                                <img class="img-fluid" src="{{ asset('frontend/assets/img/Logo.png') }}" alt="Logo">
                            </a>
                        </div>
                    </div>

                    <!-- Search Box -->
                    <div class="col-lg-6 d-flex align-items-center">
                        <div class="searchBoxLg">
                            <iconify-icon icon="cuida:search-outline"></iconify-icon>
                            <input type="search" placeholder="Search">
                        </div>
                        <button class="searchBtn" type="button">Search</button>
                    </div>

                    <!-- Cart & Wishlist -->
                    <div class="col-lg-3 d-flex align-items-center justify-content-end actionLinks">
                        <iconify-icon icon="solar:heart-outline"></iconify-icon>

                        @php
                        $cart = session('cart', []);
                        $total = 0;
                        foreach ($cart as $item) {
                        $price = $item['price'] ?? 0;
                        $quantity = $item['quantity'] ?? 0;
                        $total += $price * $quantity;
                        }
                        @endphp

                        <!-- Cart Icon -->
                        <div class="cartIcon">
                            <button type="button" data-bs-toggle="offcanvas" data-bs-target="#cartSideBar"
                                aria-controls="cartSideBar">
                                <iconify-icon icon="lets-icons:bag-alt"></iconify-icon>
                                <div class="quantity">{{ count($cart) }}</div>
                            </button>
                        </div>

                        <!-- Cart Total -->
                        <div class="paymentdetails text-start">
                            <p>Shopping cart:</p>
                            <h5>${{ $total }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cart Sidebar -->
            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="cartSideBar"
                aria-labelledby="cartSideBarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="cartSideBarLabel">Shopping Cart ({{ count($cart) }})</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="cardProduct my-1">
                        @if (!empty($cart))
                        @foreach ($cart as $value)
                        <div class="row align-items-center product">
                            <div class="col-3">
                                <img class="img-fluid" width="100px"
                                    src="{{ isset($value['image']) ? asset('storage/'.$value['image']) : asset('frontend/assets/img/default.png') }}"
                                    alt="{{ $value['title'] ?? 'Product' }}">
                            </div>
                            <div class="col-7">
                                <h6>{{ $value['title'] ?? 'No title' }}</h6>
                                <p>1 kg x <span>${{ $value['price'] ?? 0 }}</span></p>
                                <span>Quantity: {{ $value['quantity'] ?? 0 }}</span>
                            </div>

                            <div class="col-2 text-end">
                                <iconify-icon icon=" charm:cross"></iconify-icon>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="row align-items-center product">
                            <div class="col-12 text-center">
                                <h6>No Product Found</h6>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Checkout Button -->
                    <div class="checkoutBtnBox">
                        <div class="d-flex justify-content-between">
                            <span class="cardQuantity">{{ count($cart) }} Product</span>
                            <span class="totalPrice">${{ $total }}</span>
                        </div>
                        <a class="checkout d-block text-center" href="{{ route('checkout') }}">Checkout</a>
                        <a class="cart d-block text-center" href="{{ route('cart') }}">Go To Cart</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- *Middle Bar Section Desktop end -->

        <!-- *Middle Bar Section Mobile start -->
        <section id="middleBarSm" class="d-lg-none">
            <div class="container">
                <div class="row align-items-center">
                    <!-- *Menu Sidebar Start-->
                    <div class="col-3">
                        <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling"
                            aria-controls="offcanvasScrolling">
                            <iconify-icon icon="gg:menu-left-alt"></iconify-icon>
                        </button>
                    </div>
                    <!-- *Menu Sidebar End-->
                    <div class="col-6 d-flex justify-content-center">
                        <div class="logo">
                            <a href="{{ route('homepage') }}"><img src="{{ asset('frontend/assets/img/Logo.png')}}" alt=""></a>
                        </div>
                    </div>
                    <div class="col-3 text-end searchMob">
                        <iconify-icon icon="cuida:search-outline"></iconify-icon>
                    </div>
                </div>
            </div>

            <!-- *Menu sidebar body start -->
            <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
                id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasScrollingLabel"><img class="img-fluid"
                            src="{{ asset('frontend/assets/img/Logo.png')}}" alt=""></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body text-start menuSide">
                    <ul>
                        <li><a href="{{ route('homepage') }}">Home</a></li>
                        <li class="shopCollapse">
                            <div class="row align-items-center">
                                <div class="col-6"><a href="shop.html">Shop</a></div>
                                <div class="col-6 text-end">
                                    <iconify-icon icon="ep:arrow-right-bold"></iconify-icon>
                                </div>
                            </div>
                            <nav>
                                <ul class="shopOpen">
                                    @foreach ($categories as $category)
                                    <li><a href="#">{{ $category->title }}</a></li>
                                    @endforeach
                                </ul>
                            </nav>
                        </li>
                        <li class="shopCollapse">
                            <div class="row">
                                <div class="col-6"><a href="#">Pages</a></div>
                                <div class="col-6 text-end">
                                    <iconify-icon icon="ep:arrow-right-bold"></iconify-icon>
                                </div>
                            </div>
                            <ul class="shopOpen">
                                <li><a href="#">24/7 Support</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <!-- *Menu sidebar body End -->

            <!-- *Search Box Mobile Start Here -->
            <section id="searchBoxMobile" class="searchBoxMobile">
                <div class="container">
                    <div class="closeBtnSearch">
                        <iconify-icon icon="charm:cross"></iconify-icon>
                    </div>
                    <div class="row">
                        <div class="col d-flex searchBoxMenu">
                            <iconify-icon icon="majesticons:search-line"></iconify-icon>
                            <input type="search" placeholder="Search">
                            <button>Search</button>
                        </div>
                    </div>
                    <div class="searchResult">
                        <p>Showing Result for: <span>Search</span></p>
                    </div>
                    <div class="row">
                        <div class="col-6 searchProductCnt">
                            <a href="#"><img class="img-fluid" src="{{ asset('frontend/assets/img/Product Image.png')}}"></a>
                            <div class="productdetails text-start">
                                <h5>Indian Green Apple</h5>
                                <p>$14.99 <del>$20.99</del></p>
                            </div>
                        </div>
                        <div class="col-6 searchProductCnt">
                            <a href="#"><img class="img-fluid"
                                    src="{{ asset('frontend/assets/img/Product Image (1).png')}}"></a>
                            <div class="productdetails text-start">
                                <h5>Surjapur Mango</h5>
                                <p>$14.99</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- *Search Box Mobile End Here -->
        </section>
        <!-- *Middle Bar Section Mobile end -->

        <!-- *Bottom NavBar Mobile Start -->
        <section id="bottomNavBar" class="bottomNavBar d-lg-none">
            <div class="container">
                <div class="row justify-content-evenly align-items-center mt-3">
                    <div class="col-3 active">
                        <iconify-icon icon="lucide:home"></iconify-icon>
                    </div>
                    <div class="col-3">
                        <a href="shop.html">
                            <iconify-icon icon="mage:shop"></iconify-icon>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="cart.html">
                            <iconify-icon icon="lets-icons:bag-alt"></iconify-icon>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="Register.html">
                            <iconify-icon icon="basil:user-outline"></iconify-icon>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- *Bottom NavBar Mobile End -->


        <!-- *Desktop Nav Bar Start -->
        <section id="nabBarDesk">
            <nav class="d-none d-lg-block navBarDesktop">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <div class="dropdown">
                                <button class="categoryDrop d-flex align-items-center justify-content-evenly" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <iconify-icon icon="lucide:menu"></iconify-icon><span>All
                                        Categories</span>
                                    <iconify-icon icon="iconamoon:arrow-down-2-thin"></iconify-icon>
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach ($categories as $category)
                                    <li><a class="dropdown-item" href="#">{{ $category->title }}</a></li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        <div class="col-7 middleNav">
                            <ul class="d-flex align-items-center justify-content-start">
                                <li><a class="active" href="{{ route('homepage') }}">Home</a></li>
                                <li class="desktopParent">
                                    <a class="d-flex align-items-center" href="shop.html">Shop <iconify-icon
                                            icon="iconamoon:arrow-down-2-bold"></iconify-icon></a>
                                    <ul class="desktopChild">

                                        @foreach ($categories as $category)
                                        <li><a href="#">{{ $category->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="desktopParent"><a class="d-flex align-items-center" href="#">Pages
                                        <iconify-icon icon="iconamoon:arrow-down-2-bold"></iconify-icon>
                                    </a>
                                    <ul class="desktopChild">
                                        <li><a href="#">24/7 Support</a></li>
                                        <li><a href="#">Privacy Policy</a></li>
                                    </ul>
                                </li>
                                <li><a class="" href="blog.html">Blog</a></li>
                                <li><a class="" href="about.html">About Us</a></li>
                                <li><a class="" href="contact.html">Contact Us</a></li>
                            </ul>
                        </div>
                        <div class="col-2 d-flex align-items-center quickCall">
                            <iconify-icon icon="ph:phone-call-light"></iconify-icon>
                            <a href="tel:219555-0114">(219) 555-0114</a>
                        </div>
                    </div>
                </div>
            </nav>
        </section>
        <!-- *Desktop Nav Bar End -->
    </header>

    <!-- *Body Part Start -->

    <main>

        @yield('frontend')
        <!-- *Newsletter Start Here -->
    </main>

    <!-- *Body Part End -->





    <!-- *Footer Start Here -->
    <footer>
        <!-- *Footer top Start Here -->
        <section id="FooterTop">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 leftSide">
                        <div class="logo d-flex align-items-center">
                            <img class="img-fluid" src="{{ asset('frontend/assets/img/fav.png')}}"
                                alt="Logo.png')}}"><span>Ecobazar</span>
                        </div>
                        <p>Morbi cursus porttitor enim lobortis molestie. Duis gravida turpis dui, eget bibendum magna congue
                            nec.
                        </p>
                        <span><a href="tel:555-0114">(219) 555-0114</a> or</span>
                        <span><a href="mailto:Proxy@gmail.com">Proxy@gmail.com</a></span>
                    </div>
                    <div class="col-lg-8 rightSide">
                        <div class="row">
                            <ul class="col-lg-3 col-6">
                                <h4>My Account</h4>
                                <li><a href="">My Account</a></li>
                                <li><a href="">Order History</a></li>
                                <li><a href="">Shoping Cart</a></li>
                                <li><a href="">Wishlist</a></li>
                            </ul>
                            <ul class="col-lg-3 col-6">
                                <h4>Helps</h4>
                                <li><a href="">Contact</a></li>
                                <li><a href="">Faqs</a></li>
                                <li><a href="">Terms & Condition</a></li>
                                <li><a href="">Wishlist</a></li>
                            </ul>
                            <ul class="col-lg-3 col-6">
                                <h4>Proxy</h4>
                                <li><a href="">About</a></li>
                                <li><a href="">Shop</a></li>
                                <li><a href="">Product</a></li>
                                <li><a href="">Track Order</a></li>
                            </ul>
                            <ul class="col-lg-3 col-6">
                                <h4>Categories</h4>
                                <li><a href="">Fruit & Vegetables</a></li>
                                <li><a href="">Meat & Fish</a></li>
                                <li><a href="">Bread & Bakery</a></li>
                                <li><a href="">Beauty & Health</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- *Footer top End Hear -->
        <!-- *copy Right Start Here -->
        <section id="copyRight">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6">
                        <p>Ecobazar eCommerce © 2021. All Rights Reserved</p>
                    </div>
                    <div class="col-12 col-lg-6 text-lg-end">
                        <a href="#">
                            <img src="{{ asset('frontend/assets/img/ApplePay.png')}}" alt="">
                        </a>
                        <a href="#">
                            <img src="{{ asset('frontend/assets/img/Visa.png')}}" alt="">
                        </a>
                        <a href="#">
                            <img src="{{ asset('frontend/assets/img/Discover.png')}}" alt="">
                        </a>
                        <a href="#">
                            <img src="{{ asset('frontend/assets/img/Mastercard.png')}}" alt="">
                        </a>
                        <a href="#">
                            <img src="{{ asset('frontend/assets/img/Cart.png')}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- *copy Right End Hear -->
    </footer>
    <!-- *Footer End Hear -->



    <!-- *Popup Box Start -->
    {{-- <section id="popup" class="popup d-none">
      <div class="popup2">
         <div class="container">
            <div class="row align-items-center justify-content-center">
               <div class="close-btn text-end">
                  <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
               </div>
               <div class="col-lg-5 col mt-3">
                  <img class="img-fluid" src="{{ asset('frontend/assets/img/BG.png')}}" alt="">
    </div>
    <div class="col-lg-7 col text-center popText">
        <h3>Subcribe to Our Newsletter</h3>
        <p class="sub">Subscribe to our newlletter and Save your <span>20% money</span> with discount code
            today.</p>
        <div class="subscribe d-flex">
            <input type="email" placeholder="Enter your email address">
            <button>Subscribe</button>
        </div>
        <div class="dontShow d-flex justify-content-center align-items-center mt-4 mb-2">
            <input type="checkbox">
            <p>Don't show this popup again</p>
        </div>
    </div>
    </div>
    </div>
    </div>
    </section> --}}
    <!-- *Popup Box End -->


    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/venobox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
@extends('layouts.FrontendLayout')
@section('frontend')
<section class="product-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="row image-gallery align-items-center">
                    <!-- Thumbnails -->
                    <div class="col-lg-3 col-12 order-2 order-lg-1">
                        <div class="thumbnail-list">
                            @foreach ($product->gallery_images ?? [$product->featured_image] as $key=>$image)
                            <img src="{{ getImage($image) }}" class="thumb {{ $key == 0 ? 'active' : '' }}"
                                alt="{{ $product->title }}">
                            @endforeach
                        </div>
                    </div>

                    <!-- Main Image -->
                    <div class="col-lg-9 col-12 order-1 order-lg-2">
                        <div class="main-image text-center">
                            <img src="{{ getImage($product->featured_image)  }}" id="mainPreview"
                                alt="{{ $product->title }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="details">
                    <h1>{{ $product->title }} <span>{{ $product->qty > 0 ? 'In Stock' : 'Out of Stock' }}</span></h1>
                    <div class="review-ro-sku d-flex align-items-center">
                        <div class="review d-flex align-items-center">
                            <div class="star">
                                <ul class="d-flex">
                                    <li>
                                        <span class="iconify-icon">
                                            <iconify-icon icon="material-symbols-light:star"></iconify-icon>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="iconify-icon">
                                            <iconify-icon icon="material-symbols-light:star"></iconify-icon>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="iconify-icon">
                                            <iconify-icon icon="material-symbols-light:star"></iconify-icon>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="iconify-icon">
                                            <iconify-icon icon="material-symbols-light:star"></iconify-icon>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="iconify-icon">
                                            <iconify-icon icon="material-symbols-light:star"></iconify-icon>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div class="total-star">4 Review</div>
                        </div>
                        <div class="doted"></div>
                        <div class="sku">SKU: <span>{{ $product->sku }}</span></div>
                    </div>
                    <div class="price-ro-offer d-flex align-items-center">
                        @if ($product->selling_price)
                        <div class="price d-flex align-items-center">
                            <span class="old">{{ $product->price }} tk</span>
                            <span class="new">{{ $product->selling_price }} tk</span>
                        </div>
                        <div class="offer"><span>{{ ceil(100 - ((100 / $product->price) * $product->selling_price))
                                }}%</span>
                            Off</div>
                        @else
                        <div class="price d-flex align-items-center">
                            <span class="new">{{ $product->price }} tk</span>
                        </div>
                        @endif

                    </div>
                    <div class="brand-ro-share row align-items-center">
                        <div class="brand col-lg-6 col-12 d-flex align-items-center">
                            <span class="brand-name">Brand:</span>
                            @if ($product->brand->icon)
                            <img src="{{ asset('storage/'.$product->brand->icon ) }}" alt="{{ $product->brand->title }}"
                                class="img-fluid ms-2">
                            @else
                            <h4 class="ms-2">{{ $product->brand->title }}</h4>
                            @endif
                        </div>
                        <div class="share col-lg-6 col-12 d-flex align-items-center">
                            <span>Share item:</span>
                            <ul class="d-flex ms-1">
                                <li><a href="">
                                        <iconify-icon icon="gg:facebook"></iconify-icon>
                                    </a></li>
                                <li><a href="">
                                        <iconify-icon icon="mdi:twitter"></iconify-icon>
                                    </a></li>
                                <li><a href="">
                                        <iconify-icon icon="dashicons:pinterest"></iconify-icon>
                                    </a></li>
                                <li><a href="">
                                        <iconify-icon icon="ix:instagram-logo"></iconify-icon>
                                    </a></li>
                            </ul>
                        </div>
                        <p>{!! $product->short_detail !!}</p>
                    </div>
                    <div class="quan-catd-wish row align-items-center">
                        <div class="quantity col-lg-3 col-4 d-flex align-items-center justify-content-center">
                            <button class="qty-btn minus">−</button>
                            <span class="qty-value mx-2">1</span>
                            <button class="qty-btn plus">+</button>
                        </div>
                        <div class=" col-lg-8 col-6 text-center">
                            <div class="card-btn">
                                <button class="add-to-cart-btn  text-center">
                                    <span>Add to Cart</span> <span class="iconify-icon">
                                        <iconify-icon icon="carbon:shopping-bag"></iconify-icon>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="wishlist col-lg-1 col-2 text-end">
                            <button class="wishlist-btn">
                                <span class="iconify-icon">
                                    <iconify-icon icon="ri:heart-line"></iconify-icon>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="category-ro-tag">
                        <div class="category">Category: <span>{{ $product->category->title }}</span></div>
                        <div class="tag">Tag: <span>Vegetables <span>Healthy </span> <span class="this-p-name">Chinese
                                </span>Cabbage <span>Green
                                    Cabbage</span></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="ouder-details">
    <div class="container">
        <div class="DAC-btn text-center">
            <button class="tab-btn active" data-tab="description">Descriptions</button>
            <button class="tab-btn" data-tab="additional">Additional Information</button>
            <button class="tab-btn" data-tab="feedback">Customer Feedback</button>
        </div>
        <div class="tab-content description ">
            {!! $product->long_detail !!}
        </div>
        <div class=" tab-content additional d-none">
            <div class="row">
                <div class="col-lg-6 order-lg-1 order-2">
                    <table>
                        <tr>
                            <th>Weight:</th>
                            <td>03</td>
                        </tr>
                        <tr>
                            <th>Color:</th>
                            <td>Green</td>
                        </tr>
                        <tr>
                            <th>Type:</th>
                            <td>Organic</td>
                        </tr>
                        <tr>
                            <th>Category:</th>
                            <td>Vegetables</td>
                        </tr>
                        <tr>
                            <th>Stock Status:</th>
                            <td>Available (5,413)</td>
                        </tr>
                        <tr>
                            <th>Tags:</th>
                            <td>Vegetables, Healthy, Chinese, Cabbage, Green Cabbage</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6 text-center order-lg-2 order-1">
                    <div class="video-wrapper">
                        <div class="video-thumbnail" onclick="playVideo()">
                            <img class="img-fluid" src="./assets/img/video-cover.png" alt="Video Thumbnail">
                        </div>
                    </div>
                    <div class="discount-ro-organic row align-items-center justify-content-center">
                        <div class="col-lg-6 discount row align-items-center ">
                            <div class="col-2">
                                <img src="./assets/img/svg-icon/discount-tag.svg" alt="">
                            </div>
                            <div class="discount-text col-10 text-start">
                                <h6><span>64%</span> Discount</h6>
                                <p>Save your <span>64%</span> money with us</p>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-3 organic row align-items-center ">
                            <div class="col-2">
                                <img src="./assets/img/svg-icon/organic.svg" alt="">
                            </div>
                            <div class="discount-text col-10 text-start">
                                <h6><span>100%</span> Organic</h6>
                                <p><span>100%</span> Organic Vegetables</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" tab-content feedback d-none">
            <div class="row">
                <div class="col-lg-6 order-lg-1 order-2">
                    <div class="card">
                        <div class="d-flex align-items-start">
                            <img src="./assets/img/client-image/client-1.png" alt="User">
                            <div class="ms-3 w-100">
                                <div class="d-flex justify-content-between">
                                    <h4>Kristin Watson</h4>
                                    <small class="text-muted">2 min ago</small>
                                </div>
                                <div class="star-rating mb-1">
                                    <ul class="d-flex">
                                        <li>
                                            <span class="iconify-icon">
                                                <iconify-icon icon="material-symbols:star"></iconify-icon>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="iconify-icon">
                                                <iconify-icon icon="material-symbols:star"></iconify-icon>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="iconify-icon">
                                                <iconify-icon icon="material-symbols:star"></iconify-icon>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="iconify-icon">
                                                <iconify-icon icon="material-symbols:star"></iconify-icon>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="iconify-icon">
                                                <iconify-icon icon="material-symbols:star"></iconify-icon>
                                            </span>
                                        </li>
                                </div>
                            </div>
                        </div>
                        <div class="descirption">
                            <p class="">Duis et ullamcorper nulla, eu dictum eros. </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="d-flex align-items-start">
                            <img src="./assets/img/client-image/client-2.png" alt="User">
                            <div class="ms-3 w-100">
                                <div class="d-flex justify-content-between">
                                    <h4>Jane Cooper</h4>
                                    <small class="text-muted">30 Apr, 2021</small>
                                </div>
                                <div class="star-rating mb-1">
                                    <ul class="d-flex">
                                        <li>
                                            <span class="iconify-icon">
                                                <iconify-icon icon="material-symbols:star"></iconify-icon>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="iconify-icon">
                                                <iconify-icon icon="material-symbols:star"></iconify-icon>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="iconify-icon">
                                                <iconify-icon icon="material-symbols:star"></iconify-icon>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="iconify-icon">
                                                <iconify-icon icon="material-symbols:star"></iconify-icon>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="iconify-icon">
                                                <iconify-icon icon="material-symbols:star"></iconify-icon>
                                            </span>
                                        </li>
                                </div>
                            </div>
                        </div>
                        <div class="descirption">
                            <p class="">Keep the soil evenly moist for the healthiest growth. If the sun gets
                                too hot, Chinese cabbage tends to "bolt" or go to
                                seed; in long periods of heat, some kind of shade may be helpful. Watch out for
                                snails, as they will harm the plants.</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="d-flex align-items-start">
                            <img src="./assets/img/client1.png" alt="User">
                            <div class="ms-3 w-100">
                                <div class="d-flex justify-content-between">
                                    <h4>Jacob Jones</h4>
                                    <small class="text-muted">2 day ago</small>
                                </div>
                                <div class="star-rating mb-1">
                                    <ul class="d-flex">
                                        <li>
                                            <span class="iconify-icon">
                                                <iconify-icon icon="material-symbols:star"></iconify-icon>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="iconify-icon">
                                                <iconify-icon icon="material-symbols:star"></iconify-icon>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="iconify-icon">
                                                <iconify-icon icon="material-symbols:star"></iconify-icon>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="iconify-icon">
                                                <iconify-icon icon="material-symbols:star"></iconify-icon>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="iconify-icon">
                                                <iconify-icon icon="material-symbols:star"></iconify-icon>
                                            </span>
                                        </li>
                                </div>
                            </div>
                        </div>
                        <div class="descirption">
                            <p class="">Vivamus eget euismod magna. Nam sed lacinia nibh, et lacinia lacus.</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="d-flex align-items-start">
                            <img src="./assets/img/client-image/client-4.png" alt="User">
                            <div class="ms-3 w-100">
                                <div class="d-flex justify-content-between">
                                    <h4>Ralph Edwards</h4>
                                    <small class="text-muted">2 min ago</small>
                                </div>
                                <div class="star-rating mb-1">
                                    <ul class="d-flex">
                                        <li>
                                            <span class="iconify-icon">
                                                <iconify-icon icon="material-symbols:star"></iconify-icon>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="iconify-icon">
                                                <iconify-icon icon="material-symbols:star"></iconify-icon>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="iconify-icon">
                                                <iconify-icon icon="material-symbols:star"></iconify-icon>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="iconify-icon">
                                                <iconify-icon icon="material-symbols:star"></iconify-icon>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="iconify-icon">
                                                <iconify-icon icon="material-symbols:star"></iconify-icon>
                                            </span>
                                        </li>
                                </div>
                            </div>
                        </div>
                        <div class="descirption">
                            <p class="">200+ Canton Pak Choi Bok Choy Chinese Cabbage Seeds Heirloom Non-GMO
                                Productive Brassica rapa VAR. chinensis, a.k.a.
                                Canton's Choice, Bok Choi, from USA
                            </p>
                        </div>
                    </div>
                    <!-- Lood More Botton -->
                    <div class="load-more-btn text-center">
                        <button>Load More</button>
                    </div>
                </div>
                <div class="col-lg-6 text-center order-lg-2 order-1">
                    <div class="video-wrapper">
                        <div class="video-thumbnail" onclick="playVideo()">
                            <img class="img-fluid" src="./assets/img/video-cover.png" alt="Video Thumbnail">
                        </div>
                    </div>
                    <div class="discount-ro-organic row align-items-center justify-content-center">
                        <div class="col-lg-6 discount row align-items-center ">
                            <div class="col-2">
                                <img src="./assets/img/svg-icon/discount-tag.svg" alt="">
                            </div>
                            <div class="discount-text col-10 text-start">
                                <h6><span>64%</span> Discount</h6>
                                <p>Save your <span>64%</span> money with us</p>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-3 organic row align-items-center ">
                            <div class="col-2">
                                <img src="./assets/img/svg-icon/organic.svg" alt="">
                            </div>
                            <div class="discount-text col-10 text-start">
                                <h6><span>100%</span> Organic</h6>
                                <p><span>100%</span> Organic Vegetables</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<section id="featureProduct">
    <section id="ProductCardBox">
        <div class="container">
            <h2 class="head" style="margin: 80px 0 20px;">Featured Products</h2>
            <div class="row">
                <div class="swiper mySwiper swiper-initialized swiper-horizontal swiper-backface-hidden">
                    <div class="swiper-wrapper" id="swiper-wrapper-bf47ffe1a22e101fd" aria-live="polite">
                        @foreach ($relatedProducts as $product)
                        @php
                        $url = route('frontend.single_products', $product->slug);
                        @endphp
                        <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 10"
                            style="width: 251.2px; margin-right: 10px;">
                            <div class="cart {{ $product->category->slug }}">
                                <a href="{{ $url }}">
                                    <div class="imgBox">
                                        <img class="img-fluid"
                                            src="{{ $product->featured_image ? asset('storage/' . $product->featured_image) : 'https://i0.wp.com/mikeyarce.com/wp-content/uploads/2021/09/woocommerce-placeholder.png'}}"
                                            alt="{{ $product->title }}">
                                    </div>
                                    <div class="details">
                                        <a href="{{ $url }}">{{ $product->title }}</a>
                                        <div class="priceAndCard d-flex align-items-center justify-content-between">
                                            <div class="price">
                                                <span class="col-2">${{ $product->selling_price }}</span>
                                                <span class="col-2" style="text-decoration: line-through;">${{
                                                    $product->price }}</span>
                                            </div>
                                            <a href="#" class="addToCartBtn" data-id="{{ $product->id }}">
                                                <span class="text-end col-6 addCatdBtn">
                                                    <iconify-icon icon="ph:handbag" width="20" height="20">
                                                    </iconify-icon>
                                                </span>
                                            </a>



                                        </div>
                                        <div class="review">
                                            <iconify-icon icon="twemoji:star" width="20" height="20"></iconify-icon>
                                            <iconify-icon icon="twemoji:star" width="20" height="20"></iconify-icon>
                                            <iconify-icon icon="twemoji:star" width="20" height="20"></iconify-icon>
                                            <iconify-icon icon="twemoji:star" width="20" height="20"></iconify-icon>
                                            <iconify-icon icon="heroicons:star-20-solid" width="20" height="20"
                                                style="color: #b3b3b3">
                                            </iconify-icon>
                                        </div>
                                    </div>
                                </a>

                                <!-- *Hover Effect Start Here -->

                                <div class="iconBox">
                                    <div class="Wishlist">
                                        <iconify-icon icon="meteor-icons:heart" width="20" height="20"></iconify-icon>
                                    </div>
                                    <div class="View">
                                        <iconify-icon icon="ant-design:eye-outlined" width="20" height="20">
                                        </iconify-icon>
                                    </div>
                                </div>

                                <!-- *Hover Effect End Here -->
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
                        aria-controls="swiper-wrapper-bf47ffe1a22e101fd" aria-disabled="false">
                        <iconify-icon icon="mynaui:arrow-right"></iconify-icon>
                    </div>
                    <div class="swiper-button-prev swiper-button-disabled" tabindex="-1" role="button"
                        aria-label="Previous slide" aria-controls="swiper-wrapper-bf47ffe1a22e101fd"
                        aria-disabled="true">
                        <iconify-icon icon="mynaui:arrow-left"></iconify-icon>
                    </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection

@push('scripts')
<script>
    $('.thumb').click(function () {
        let imgSrc = $(this).attr('src');
        $('#mainPreview').attr('src', imgSrc);
        $('.thumb').removeClass('active');
        $(this).addClass('active');
        });
</script>
@endpush
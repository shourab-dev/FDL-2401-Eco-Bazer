@extends('layouts.FrontendLayout')
@section('frontend')


<!-- *Breadcrumbs Start Here -->
<section id="Breadcrumbs">
    <div class="container">
        <ul>
            <li class="d-flex align-items-center">
                <a href="index.html" class="homeIcom">
                    <iconify-icon icon="fluent:home-16-regular" width="20" height="22"></iconify-icon>
                </a>
                <iconify-icon icon="formkit:right" width="15" height="15" style="color: #999"></iconify-icon>
            </li>
            <li class="d-flex align-items-center">
                <a href="#">Cart</a>
                <iconify-icon icon="formkit:right" width="15" height="15" style="color: #999"></iconify-icon>
            </li>
            <li>
                <a href="#" class="active">Checkout</a>
            </li>
        </ul>
    </div>
</section>
<!-- *Breadcrumbs End Hear -->

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-12 ">
            <div class="formBox">
                <h2>Billing Information</h2>
                <form>
                    <div class="row">
                        <div class="F-name col-lg col-12">
                            <label for="F-name">First name</label>
                            <input type="text" id="F-name" placeholder="First name" value="{{ 'hellow' }}">
                        </div>
                        <div class="L-name col-lg col-12">
                            <label for="F-name">Last name</label>
                            <input type="text" id="L-name" placeholder="Last name">
                        </div>
                        <div class="C-name col-lg col-12">
                            <label for="C-name">Company Name (optional)</label>
                            <input type="text" id="C-name" placeholder="Company Name">
                        </div>
                        <div class="address col-12">
                            <label for="address">Street Address</label>
                            <input type="text" id="address" placeholder="Street Address">
                        </div>
                        <div class="Country col-lg-4 col-12">
                            <label for="Country">Country / Region</label>
                            <select name="Country" id="Country">
                                <option value="1">Select</option>
                            </select>
                        </div>
                        <div class="States col-lg-4 col-12">
                            <label for="States">States</label>

                            <select name="States" id="States">
                                <option value="1">Select</option>
                            </select>
                        </div>
                        <div class="zipCode col-lg-4 col-12">
                            <label for="zipCode">Zip Code</label>
                            <input type="email" id="zipCode" placeholder="Zip Code">
                        </div>
                        <div class="email col-lg col-12">
                            <label for="email">Email</label>
                            <input type="email" id="email" placeholder="Email">
                        </div>
                        <div class="phone col-lg col-12">
                            <label for="phone">Phone number</label>
                            <input type="phone" id="phone" placeholder="Phone number">
                        </div>
                        <div class="different col-12 d-flex align-items-center">
                            <input type="checkbox" id="differentAddress" placeholder="">
                            <label for="differentAddress">Ship to a different address</label>
                        </div>
                        <h2>Additional Info</h2>
                        <div class="textarea col-12">
                            <label for="notes">Order Notes (Optional)</label>
                            <textarea name="" id="notes"
                                placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-4 col-12 ">
            <div class="orderSummery">
                <h4>Order Summery</h4>
                <div class="row mt-3">
                    @php
                    $total = 0;
                    @endphp
                    @foreach ($carts as $item)
                    <div class="orderCart d-flex align-items-center justify-content-between">
                        <div class="imgAndname">
                            <img class="img-fluid" src="{{ getImage($item->product->featured_image) }}" alt="">
                            <span class="proName">{{ $item->product->title }} <span>x{{ $item->qty }}</span></span>
                        </div>
                        <span class="price"> {{ $productPrice = ($item->product->selling_price) * $item->qty ??
                            $item->product->price }} .tk</span>
                    </div>
                    @php
                    $total += $productPrice;
                    @endphp
                    @endforeach
                </div>




                <div class="Subtotal d-flex align-items-center justify-content-between">
                    <span>Subtotal:</span>
                    <span>{{ $total }} .tk</span>
                </div>
                <div class="Subtotal d-flex align-items-center justify-content-between">
                    <span>Delivery Charge:</span>
                    <span>{{ 100 }} .tk</span>
                </div>

                <div class="Total d-flex align-items-center justify-content-between">
                    <span>Total:</span>
                    <span>{{ $total = $total + 100 }} .tk</span>
                </div>
                <h5>Payment Method</h5>
                <div class="d-flex Payment">
                    <input type="radio" name="Payment" id="Cash" checked>
                    <label for="Cash">Cash on Delivery</label>
                </div>
                <div class="d-flex Payment">
                    <input type="radio" name="Payment" id="Cash" checked>
                    <label for="Cash">SSL Commerze</label>
                </div>

                <button type="button">Place Order</button>
                <button class="btn btn-primary btn-lg btn-block" id="sslczPayBtn"
                    token="if you have any token validation"
                    postdata="your javascript arrays or objects which requires in backend"
                    order="If you already have the transaction generated for current order"
                    endpoint="{{ url('/pay-via-ajax') }}"> Pay
                    Now
                </button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    var obj = {};
    // If you want to pass some value from frontend, you can do like this, but be aware, this value can be modified by anyone, so it's not secure to pass total_amount, store_passwd etc from frontend.
    
    $('#sslczPayBtn').prop('postdata', obj);
    $('#sslczPayBtn').click(function(){
        obj.cus_name = $('#F-name').val();
        obj.cus_last_name = $('#L-name').val();
        obj.cus_company = $('#C-name').val();
        obj.cus_addr1 = $('#address').val();
        obj.cus_zip = $('#zipCode').val();
        obj.cus_email = $('#email').val();
        obj.cus_phone = $('#phone').val();
        obj.cus_notes = $('#notes').val();
        obj.total_amount = `{{ $total }}`;

    });

    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>
@endpush
@endsection
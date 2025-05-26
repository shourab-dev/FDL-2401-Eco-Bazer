@extends('layouts.FrontendLayout')
@section('title', 'Cart Page')
@section('frontend')
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
                <a class="active" href="cart.html">Shopping Cart</a>
            </li>
        </ul>
    </div>
</section>
<!-- *Breadcrumbs End Hear -->

<!-- *Cart Main Body Part Section start -->
<section id="cart">
    <div class="container">
        <div class="heading">
            <h2>My Shopping Cart</h2>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <table class="table table-bordered text-center align-middle">
                    <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $cart = session('cart', []);
                        $total = 0;
                        @endphp

                        @forelse ($cart as $key => $value)
                        @php
                        $subtotal = ($value['price'] ?? 0) * ($value['quantity'] ?? 1);
                        $total += $subtotal;
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img class="img-fluid" width="100px"
                                    src="{{ isset($value['image']) ? asset('storage/' . $value['image']) : asset('frontend/assets/img/default.png') }}"
                                    alt="{{ $value['title'] ?? 'Product Image' }}">
                            </td>
                            <td>{{ $value['title'] ?? 'N/A' }}</td>
                            <td>${{ number_format($value['price'] ?? 0, 2) }}</td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center quantity" data-id="{{ $key }}">
                                    <iconify-icon icon="ic:baseline-minus" class="decrease" style="cursor: pointer;"></iconify-icon>
                                    <input type="number" class="form-control mx-1 quantity-input text-center"
                                        value="{{ $value['quantity'] ?? 1 }}" min="1" max="100" style="width: 60px;">
                                    <iconify-icon icon="ic:baseline-plus" class="increase" style="cursor: pointer;"></iconify-icon>
                                </div>
                            </td>
                            <td>${{ number_format($subtotal, 2) }}</td>
                            <td>
                                <button class="btn btn-danger btn-sm delete-item" data-id="{{ $key }}">
                                    <iconify-icon icon="ic:baseline-delete"></iconify-icon>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">No products in the cart.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="row actionBtns">
                    <div class="col-lg-6 col-12">
                        <a href="shop.html"><button>Resume to Shop</button></a>
                    </div>
                    <div class="col-lg-6 col-12 text-lg-end">
                        <a href=""><button>Update Cart</button></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-2 mt-lg-0">
                <div class="cartCnt">
                    <h5>Cart Total</h5>
                    <div id="cart-total-section">
                        @include('Frontend.cart.cart-total', ['total' => $total])
                    </div>

                    <a href=""><button>Proceed to Checkout</button></a>
                </div>
            </div>



        </div>
</section>
<!-- *Cart Main Body Part Section end -->

<!-- *cupon Section start -->
<section id="cupon" class="d-none d-lg-block">
    <div class="container">
        <div class="row cupon mt-3">
            <div class="col-12">
                <div class="cuponCnt d-flex align-items-center">
                    <h4>Cupon Code</h4>
                    <div class="cuponInput d-flex">
                        <input type="text" placeholder="Enter Code">
                        <button>Apply Cupon</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- *cupon Section end -->
@endsection
@push('scripts')
<script>
    $(function() {
        // quantity +/-
        $("body").on("click", ".increase, .decrease", function() {
            let box = $(this).closest(".quantity"),
                id = box.data("id"),
                input = box.find(".quantity-input"),
                qty = parseInt(input.val()) || 1;

            if ($(this).hasClass("increase")) qty++;
            else if (qty > 1) qty--;

            input.val(qty);

            $.post("{{ route('cartUpdate') }}", {
                _token: "{{ csrf_token() }}",
                Product_id: id,
                quantity: qty
            }, function(res) {
                if (res.success) {
                    $("#cart-total-section").html(res.cart_total_html);
                }
            });
        });

        // delete item
        $("body").on("click", ".delete-item", function() {
            if (!confirm("Remove this item?")) return;
            let btn = $(this),
                id = btn.data("id");

            $.post("{{ route('cart.remove.ajax') }}", {
                _token: "{{ csrf_token() }}",
                id: id
            }, function(res) {
                if (res.success) {
                    btn.closest("tr").remove();
                    $("#cart-total-section").html(res.cart_total_html);
                }
            });
        });
    });
</script>
@endpush
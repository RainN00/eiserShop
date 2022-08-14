@extends('client.layouts.master')
@section('title')
Carts
@endsection
@section('wrapper')
@include('client.carts.breadcrum')
<!--================Cart Area =================-->
<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            @if (Session::has('cart-item-number') && isset($productsCart))
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productsCart as $product)
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="d-flex">
                                        <img style="width: 150px;height: 100px" src="{{ asset($product->thumbnail) }}" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <p>{{ $product->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5>${{ number_format($product->price,2) }}</h5>
                            </td>
                            <td>
                                <div class="product_count">
                                    <input type="text" name="itemQuantity" id="sst" maxlength="12" value="@foreach($brokenProductAndQuantity as $id => $quantity)@if($product->id == $id){{ $quantity }}@endif @endforeach" title="Quantity:"
                                        class="input-text qty" />
                                    <button class="increase items-count cart-plus" data-product="{{ $product->id }}" type="button">
                                        <i class="lnr lnr-chevron-up"></i>
                                    </button>
                                    <button class="reduced items-count cart-minus" data-product="{{ $product->id }}" type="button">
                                        <i class="lnr lnr-chevron-down"></i>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <h5>
                                    @foreach($brokenProductAndQuantity as $id => $quantity)
                                        @if($product->id == $id)
                                            ${{ number_format($quantity*$product->price,2) }}
                                        @endif
                                    @endforeach
                                </h5>
                            </td>
                            <td>
                                <a href="javascript:;" class="active remove-item-cart" data-product="{{ $product->id }}"><i class="ti-close"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        <tr class="bottom_button">
                            <td colspan="3">
                                <a class="gray_btn" href="{{ route('client.carts.index') }}">Update Cart</a>
                            </td>
                            <td colspan="2">
                                <div class="cupon_text">
                                    <input type="text" placeholder="Coupon Code" />
                                    <a class="main_btn" href="#">Apply</a>
                                </div>
                            </td>
                        </tr>
                        <tr class="out_button_area">
                            <td colspan="4"></td>
                            <td>
                                <div class="checkout_btn_inner">
                                    <a class="gray_btn" href="{{ route('client.categories.index') }}">Continue Shopping</a>
                                    <a class="main_btn" href="{{ route('client.order.checkout') }}">Proceed to checkout</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @else
            Empty cart
            @endif
        </div>
    </div>
</section>
<!--================End Cart Area =================-->
@endsection
@section('script')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".cart-minus").on('click',function (e) {
        e.preventDefault();

        var ele = $(this);
        $.ajax({
            url: '{{ route('client.carts.minus_quantity_item') }}',
            method: "get",
            data: {
                _token: '{{ csrf_token() }}',
                itemId: ele.attr("data-product")
            },
            success: function (data) {
                $('.cart_inner').html(data.html);
            }
        });
    });
    $(".cart-plus").on('click',function (e) {
        e.preventDefault();

        var ele = $(this);
        $.ajax({
            url: '{{ route('client.carts.plus_quantity_item') }}',
            method: "get",
            data: {
                _token: '{{ csrf_token() }}',
                productsId: ele.attr("data-product")
            },
            success: function (data) {
                $('.cart_inner').html(data.html);
            }
        });
    });
    $(".remove-item-cart").on('click',function (e) {
        e.preventDefault();

        var ele = $(this);
        $.ajax({
            url: '{{ route('client.carts.remove') }}',
            method: "get",
            data: {
                _token: '{{ csrf_token() }}',
                itemId: ele.attr("data-product")
            },
            success: function (data) {
                $('.cart_inner').html(data.html);
            }
        });
    });
</script>
@endsection

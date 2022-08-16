@extends('client.layouts.master')
@section('title')
Checkout
@endsection
@section('wrapper')
@include('client.orders.breadcrum')
<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
    <div class="container">
        {{-- <div class="cupon_area">
            <div class="check_title">
                <h2>
                    Have a coupon?
                    <a href="#">Click here to enter your code</a>
                </h2>
            </div>
            <input type="text" placeholder="Enter coupon code" />
            <a class="tp_btn" href="#">Apply Coupon</a>
        </div> --}}
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Billing Details</h3>
                    <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" value="{{ Auth::user()->firstname }}" id="first"
                                name="name" />
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" value="{{ Auth::user()->lastname }}" id="last"
                                name="name" />
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" value="{{ Auth::user()->phone }}" id="phone"
                                name="phone" />
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="email" class="form-control" value="{{ Auth::user()->email }}" id="email"
                                name="email" />
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" value="{{ Auth::user()->address }}" id="address"
                                name="address" />
                        </div>
                        <div class="col-md-12 form-group">
                            <textarea class="form-control" name="message" id="message" rows="1"
                                placeholder="Order Notes"></textarea>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="order_box">
                        <h2>Your Order</h2>
                        <ul class="list">
                            <li>
                                <a href="#">Product
                                    <span>Total</span>
                                </a>
                            </li>
                            @foreach ($productsCart as $product)
                            <li>
                                <a href="{{ route('client.product.index', ['id'=>$product->id]) }}">{{ $product->name }}
                                    @foreach ($brokenProductAndQuantity as $id => $quantity)
                                    @if ($product->id == $id)
                                    <span class="middle">x {{ $quantity }}</span>
                                    @endif
                                    @endforeach
                                    <span class="last">${{ number_format($product->price,2) }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        <ul class="list list_2">
                            {{-- <li>
                                <a href="#">Subtotal
                                    <span>$2160.00</span>
                                </a>
                            </li> --}}
                            <li>
                                <a href="#">Shipping
                                    <span>Flat rate: $5.00</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">Total
                                    @php
                                    $total = 0;
                                    $totalPrice = 0;
                                    @endphp
                                    @foreach ($productsCart as $product)
                                    @foreach ($brokenProductAndQuantity as $id => $quantity)
                                    @if ($product->id == $id)
                                    @php
                                    $total = ($product->price*$quantity);
                                    @endphp
                                    @endif
                                    @endforeach
                                    @php
                                    $totalPrice += $total
                                    @endphp
                                    @endforeach
                                    <span>$
                                        @php
                                        echo number_format($totalPrice,2);
                                        @endphp
                                    </span>
                                </a>
                            </li>
                        </ul>
                        @foreach ($payments as $payment)
                        <div class="payment_item active">
                            <div class="radion_btn">
                                <input type="radio" id="f-option{{ $payment->id }}" value="{{ $payment->id }}"
                                    name="selector payment"/>
                                <label for="f-option{{ $payment->id }}">{{ $payment->name }}</label>
                                <div class="check"></div>
                            </div>
                            <p>{{ $payment->description }}</p>
                        </div>
                        @endforeach
                        <div class="creat_account">
                            <input type="checkbox" id="f-option4" name="selector payment" />
                            <label for="f-option4">I’ve read and accept the </label>
                            <a href="#">terms & conditions*</a>
                        </div>
                        <a class="main_btn btn-proceed-to-paypal" href="#">Proceed to Paypal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Checkout Area =================-->
@endsection
@section('script')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".btn-proceed-to-paypal").on('click',function (e) {
        e.preventDefault();

        var ele = $(this);
        $.ajax({
            url: '{{ route('client.order.checkout') }}',
            type:'POST',
            data: {
                _token: '{{ csrf_token() }}',
                payment: $("input[name='selector payment']:checked").val(),
                notes: $('#message').val()
            },
            dataType: 'json',
            success: function(data) {
                if(data.urlString != null){
                    window.location.href = data.urlString
                }
            }
        });
    });
</script>
@endsection

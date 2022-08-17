@extends('client.layouts.master')
@section('title')
Carts
@endsection
@section('wrapper')
@include('client.users.breadcrum')
<!--================Cart Area =================-->
<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            @if (isset($orders))
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
                        @foreach($orders as $order)
                        <tr>
                            <td colspan="5" style="color:#000;font-weight: 700">
                                Daily orders {{ date($order->created_at) }}
                            </td>
                        </tr>
                        @foreach($order->orderDetail as $itemOrderDetail)
                        @foreach($itemOrderDetail->product as $product)
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="d-flex">
                                        <img style="width: 150px;height: 100px" src="{{ asset($product->thumbnail) }}"
                                            alt="" />
                                    </div>
                                    <div class="media-body">
                                        <h4>{{ $product->name }}</h4>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5>${{ number_format($product->price,2) }}</h5>
                            </td>
                            <td>
                                <div class="product_count">
                                    <h5>x {{ $itemOrderDetail->quantity }}</h5>
                                </div>
                            </td>
                            <td>
                                <h5>
                                    @php
                                    $total = $itemOrderDetail->quantity*$product->price;
                                    echo '$'.number_format($total,2);
                                    @endphp
                                </h5>
                            </td>
                            <td>
                                @if ($order->status == 1)
                                <span class="genric-btn warning-border radius disable">
                                    Waiting for the package
                                </span>
                                @endif
                                @if($order->status == 2)
                                <span class="genric-btn info-border radius">
                                    Being transported
                                </span>
                                @endif
                                @if($order->status == 3)
                                <span class="genric-btn success-border radius disable">
                                    Has received the goods
                                </span>
                                @endif
                                @if($item->status == 4)
                                <span class="btn btn-success" @disabled(true)>
                                    Item has been returned
                                </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else You don't have an order yet. Let's shop to have relaxing moments
            @endif
        </div>
    </div>
</section>
<!--================End Cart Area =================-->
@endsection

@extends('admin.layouts.index')
@section('title')
Order
@endsection
@section('wrapper')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Order show detail</h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>List order detail</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @foreach ($order->products as $product)
                    <div class="item-order_detail">
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="product-image">
                                <img src="{{ asset($product->thumbnail) }}" alt="..." />
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-6" style="border:0px solid #e5e5e5;">

                            <h3 class="prod_title">{{ $product->name }}</h3>
                            <div>
                                <h2><strong>Brand: </strong>{{ $product->brand->name }}</h2>
                            </div>
                            <div>
                                <h2><strong>Nation: </strong>{{ $product->nation->name }}</h2>
                            </div>
                            <div>
                                <h2><strong>Price: </strong>{{ number_format($product->price,2) }}</h2>
                            </div>
                            <div>
                                <h2><strong>Quantity: </strong>
                                    @foreach ($order->orderDetail as $item)
                                        @if ($product->id == $item->product_id)
                                            {{ $item->quantity }}
                                        @endif
                                    @endforeach
                                </h2>
                            </div>

                            <div class="">
                                <div class="product_price">
                                    <h2>Total: </h2>
                                    <h1 class="price">
                                        @foreach ($order->orderDetail as $item)
                                            @if ($product->id == $item->product_id)
                                                {{ number_format($product->price*$item->quantity,2) }}
                                            @endif
                                        @endforeach
                                    </h1>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

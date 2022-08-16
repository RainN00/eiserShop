@extends('client.layouts.master')
@section('title')
Shop category
@endsection
@section('wrapper')
@include('client.categories.breadcrum')
<!--================Category Product Area =================-->
<section class="cat_product_area section_gap">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="product_top_bar">
                    <div class="left_dorp">
                        <select name="sorting" class="sorting" wire:model="sorting">
                            <option value="default">Default sorting</option>
                            <option value="date">Sorting by newness</option>
                            <option value="name">Sorting by name: A-Z</option>
                            <option value="name-desc">Sorting by name: Z-A</option>
                            <option value="price">Sorting by price: low to high</option>
                            <option value="price-desc">Sorting by price: high to low</option>
                        </select>
                    </div>
                </div>

                <div class="latest_product_inner">
                    <div class="row sorting_product">
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-6">
                                <div class="single-product">
                                    <div class="product-img">
                                        <img class="card-img" src="{{ asset($product->thumbnail) }}" alt="" />
                                        <div class="p_icon">
                                            <a href="{{ route('client.product.index', ['id'=>$product->id]) }}">
                                                <i class="ti-eye"></i>
                                            </a>
                                            <a href="#">
                                                <i class="ti-heart"></i>
                                            </a>
                                            <a  class="btn-add-to-cart" href="{{ route('client.ajax.addToCart') }}" data-product="{{ $product->id }}">
                                                <i class="ti-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-btm">
                                        <a href="{{ route('client.product.index', ['id'=>$product->id]) }}" class="d-block">
                                            <h4>{{ $product->name }}</h4>
                                        </a>
                                        <div class="mt-3">
                                            <span class="mr-4">${{ number_format($product->price,2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-lg-12 text-center">
                            <div class="pagination__option">
                                <a href="{{ $products->previousPageUrl() }}" class="{{ $products->onFirstPage() ? "disable" : "" }}"><i class="fa fa-angle-left"></i></a>
                                @for ($i = 1; $i <= $products->lastPage(); $i++)
                                    <a href="{{ $products->url($i) }}" class="{{ $products->currentPage() == $i ? "visiable" : "" }}">{{ $i }}</a>
                                @endfor
                                <a href="{{ $products->nextPageUrl() }}" class="{{ $products->lastPage() ==  $products->currentPage() ? "disable" : "" }}"><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="left_sidebar_area">
                    <aside class="left_widgets p_filter_widgets">
                        <div class="l_w_title">
                            <h3>Categories</h3>
                        </div>
                        <div class="widgets_inner">
                            <ul class="list">
                                @foreach ($categories as $category)
                                    @if (count($category->products) > 0)
                                        <li class="{{ Request::getRequestUri() == "/categories/".$category->id ? 'active' : '' }}">
                                            <a href="{{ route('client.categories.detail', ['id'=>$category->id]) }}">{{ $category->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </aside>

                    <aside class="left_widgets p_filter_widgets">
                        <div class="l_w_title">
                            <h3>Product Brand</h3>
                        </div>
                        <div class="widgets_inner">
                            <ul class="list">
                                @foreach ($brands as $brand)
                                    @if (count($brand->products) > 0)
                                        <li class="{{ Request::getRequestUri() == "/brands/".$brand->id ? 'active' : '' }}">
                                            <a href="{{ route('client.categories.brand', ['id'=>$brand->id]) }}">{{ $brand->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </aside>

                    <aside class="left_widgets p_filter_widgets">
                        <div class="l_w_title">
                            <h3>Product Nation</h3>
                        </div>
                        <div class="widgets_inner">
                            <ul class="list">
                                @foreach ($nations as $nation)
                                    @if (count($nation->products) > 0)
                                        <li class="{{ Request::getRequestUri() == "/nations/".$nation->id ? 'active' : '' }}">
                                            <a href="{{ route('client.categories.nation', ['id'=>$nation->id]) }}">{{ $nation->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </aside>

                    <aside class="left_widgets p_filter_widgets">
                        <div class="l_w_title">
                            <h3>Color Filter</h3>
                        </div>
                        <div class="widgets_inner">
                            <ul class="list">
                                <li>
                                    <a href="#">Black</a>
                                </li>
                                <li>
                                    <a href="#">Black Leather</a>
                                </li>
                                <li>
                                    <a href="#">Black with red</a>
                                </li>
                                <li>
                                    <a href="#">Gold</a>
                                </li>
                                <li>
                                    <a href="#">Spacegrey</a>
                                </li>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Category Product Area =================-->
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.card-item-expanded__comment-btn',function(e){
            e.preventDefault();

            $.ajax({
                url: '/add-comment',
                type:'POST',
                data: {
                    content: $('.card-item-expanded__comment-input').val(),
                    product_id: $(this).data('product')
                },
                dataType: 'json',
                success: function(data) {
                    $('.card-item-expanded__comment-list').html(data.html);
                    $('.card-item-expanded__comment-input').val('');
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });

        $(".btn-add-to-cart").on('click',function (e) {
            e.preventDefault();
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            var ele = $(this);
            $.ajax({
                url: '{{ route('client.ajax.addToCart') }}',
                method: "get",
                data: {
                    _token: '{{ csrf_token() }}',
                    productsId: ele.attr("data-product")
                },
                success: function (response) {
                    toastr.success("Add product to cart success");
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
                $('.sorting_product').html(data.html);
            }
        });
    });

    });
</script>
@endsection


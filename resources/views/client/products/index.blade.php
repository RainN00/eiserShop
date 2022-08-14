@extends('client.layouts.master')
@section('title')
{{ $productDetail->name }}
@endsection
@section('wrapper')
@include('client.products.breadcrum')
<!--================Single Product Area =================-->
<div class="product_image_area">
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-6">
                <div class="s_product_img">
                    <img class="d-block w-100" src="{{ asset($productDetail->thumbnail) }}"
                                    alt="First slide" />
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="s_product_text">
                    <h3>{{ $productDetail->name }}</h3>
                    <h2>${{ number_format($productDetail->price,2) }}</h2>
                    <ul class="list">
                        <li>
                            <a class="active" href="{{ route('client.categories.detail', ['id'=>$productDetail->category->id]) }}">
                                <span>Category</span> : {{ $productDetail->category->name }}</a>
                        </li>
                        <li>
                            <a href="#"> <span>Availibility</span> : In Stock</a>
                        </li>
                    </ul>
                    <p>{{ $productDetail->short_description }}</p>
                    <div class="product_count">
                        <label for="qty">Quantity:</label>
                        <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:"
                            class="input-text qty" />
                        <button
                            onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                            class="increase items-count" type="button">
                            <i class="lnr lnr-chevron-up"></i>
                        </button>
                        <button
                            onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                            class="reduced items-count" type="button">
                            <i class="lnr lnr-chevron-down"></i>
                        </button>
                    </div>
                    <div class="card_area">
                        <a class="main_btn btn-add-to-cart" href="{{ route('client.ajax.addToCart') }}" data-product="{{ $productDetail->id }}">Add to Cart</a>
                        <a class="icon_btn" href="#">
                            <i class="lnr lnr lnr-diamond"></i>
                        </a>
                        <a class="icon_btn" href="#">
                            <i class="lnr lnr lnr-heart"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================End Single Product Area =================-->
@include('client.products.description')
@endsection
@section('script')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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

    $(".btn-comment").on('click',function (e) {
        e.preventDefault();

        var ele = $(this);
        $.ajax({
            url: '{{ route('client.comment.post') }}',
            method: "post",
            data: {
                _token: '{{ csrf_token() }}',
                productId: ele.attr("data-productId"),
                content: $("#message").val()
            },
            success: function (data) {
                $('.comment_list').html(data.html);
            }
        });
    });

    $(".btn-rating").on('click',function (e) {
        e.preventDefault();

        var ele = $(this);
        $.ajax({
            url: '{{ route('client.product.rating') }}',
            method: "post",
            data: {
                _token: '{{ csrf_token() }}',
                fullname: $("#namerate").val(),
                productId: ele.attr("data-productIdRate"),
                content: $("#messagerate").val(),
                rating: $("input[name='rating']:checked").val(),
            },
            success: function (data) {
                $('.rate_list').html(data.html);
            }
        });
    });

</script>
@endsection

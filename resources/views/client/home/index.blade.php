@extends('client.layouts.master')
@section('title')
Home
@endsection
@section('wrapper')
@include('client.home.feature_product')
@include('client.home.hot_product')
@include('client.home.betseller_product')
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

</script>
@endsection

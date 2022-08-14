@extends('client.layouts.master')
@section('title')
Login
@endsection
@section('wrapper')
<div class="container">
    <div class="row section_gap_top">
        <div class="col-12 text-center">
            <h1 class="contact-title">Login account</h1>
        </div>
        <div class="col-3"></div>
        <div class="col-lg-6 mb-4 mb-lg-0">
            <form class="form-contact contact_form" id="contactForm"
                novalidate="novalidate">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input class="form-control" name="email" id="email" type="email"
                                placeholder="Enter email address">
                                <span style="color: red" id="err_email"></span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input class="form-control" name="password" id="password" type="password"
                                placeholder="Enter your password">
                                <span style="color: red" id="err_password"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-lg-3 text-center">
                    <button type="submit" class="main_btn btn-login">Login account</button>
                </div>
            </form>
        </div>
        <div class="col-3"></div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".btn-login").on('click',function (e) {
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
            url: '{{ route('client.users.login') }}',
            type:'POST',
            data: {
                _token: '{{ csrf_token() }}',
                email: $('#email').val(),
                password: $('#password').val()
            },
            dataType: 'json',
            beforeSend: function(){
                $('#err_email').html('')
                $('#err_password').html('')
            },
            success: function(data) {
                if(data.messages != null){
                    toastr.error(data.messages);
                }
                if(data.urlString != null){
                    window.location.href = data.urlString
                }
            },
            error: function(error){
                var errObj=jQuery.parseJSON(error.responseText)

                $('#err_email').html(errObj.errors.email)
                $('#err_password').html(errObj.errors.password)
            }
        });
    });
</script>
@endsection

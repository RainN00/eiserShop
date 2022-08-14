@extends('client.layouts.master')
@section('title')
Register
@endsection
@section('wrapper')
<div class="container">
    <div class="row section_gap_top">
        <div class="col-12 text-center">
            <h1 class="contact-title">Register account</h1>
        </div>
        <div class="col-3"></div>
        <div class="col-lg-6 mb-4 mb-lg-0">
            <form class="form-contact contact_form" id="contactForm" novalidate="novalidate">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-control" name="firstname" id="firstname" type="text"
                                placeholder="Enter your first name">
                                    <span style="color: red" id="err_firstname"></span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-control" name="lastname" id="lastname" type="text"
                                placeholder="Enter your last name">
                                <span style="color: red" id="err_lastname"></span>

                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input class="form-control" name="email" id="email" type="email"
                                placeholder="Enter email address">
                                <span style="color: #000" id="note_register">You can use letters, numbers and periods</span>
                                <span style="color: red" id="err_email"></span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input class="form-control" name="password" id="password" type="password"
                                placeholder="Enter your password">
                                <span style="color: #000" id="note_register2">Use 6 or more characters and combinations of letters, numbers, and symbols</span>
                                <span style="color: red" id="err_password"></span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input class="form-control" name="password_confirmation" id="password_confirmation" type="password"
                                placeholder="Enter your password confirmation">
                                <span style="color: red" id="err_passconfir"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-lg-3 text-center">
                    <button type="submit" class="main_btn btn-register">Register account</button>
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

    $(".btn-register").on('click',function (e) {
        e.preventDefault();

        var ele = $(this);
        $.ajax({
            url: '{{ route('client.users.register') }}',
            type:'POST',
            data: {
                _token: '{{ csrf_token() }}',
                firstname: $('#firstname').val(),
                lastname: $('#lastname').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                password_confirmation: $('#password_confirmation').val()
            },
            dataType: 'json',
            beforeSend: function(){
                $('#note_register').html('')
                $('#note_register2').html('')
                $('#err_firstname').html('')
                $('#err_lastname').html('')
                $('#err_email').html('')
                $('#err_password').html('')
            },
            success: function(data) {
                if(data.urlString != null){
                    window.location.href = data.urlString
                }
            },
            error: function(error){
                var errObj=jQuery.parseJSON(error.responseText)

                $('#err_firstname').html(errObj.errors.firstname)
                $('#err_lastname').html(errObj.errors.lastname)
                $('#err_email').html(errObj.errors.email)
                $('#err_password').html(errObj.errors.password)
            }
        });
    });
</script>
@endsection

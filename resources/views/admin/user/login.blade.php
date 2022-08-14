<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>EISER ADMIN | LOGIN</title>

        <!-- Bootstrap -->
        <link href="{{ asset('admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}"rel="stylesheet" />
        <!-- Font Awesome -->
        <link href="{{ asset('admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
        <!-- NProgress -->
        <link href="{{ asset('admin/vendors/nprogress/nprogress.css') }}" rel="stylesheet" />
        <!-- Animate.css -->
        <link href="{{ asset('admin/vendors/animate.css/animate.min.css') }}" rel="stylesheet" />

        <!-- Custom Theme Style -->
        <link href="{{ asset('admin/build/css/custom.min.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('customer/css/toastr.min.css') }}" />
    </head>

    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <form>
                            <h1>Login Form</h1>
                            <div>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email" required="" />
                            </div>
                            <div>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="" />
                            </div>
                            <div>
                                <a class="btn btn-default submit btn-admin-login" href="javascript:;">Log in</a>
                                <a class="reset_pass" href="#">Lost your password?</a>
                            </div>
                            <h4 style="color: red;font-style: italic">
                                @if (isset($errors))
                                    {{ $errors }}
                                @endif
                            </h4>
                            <div class="clearfix"></div>

                            <div class="separator">
                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1><img src="{{ asset('customer/img/logo.png') }}" alt=""></h1>
                                    <p>©2022 All Rights Reserved. Eiser! is a Bootstrap 4 template. Privacy and Terms</p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
        <script src="{{ asset('customer/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('customer/js/toastr.min.js') }}"></script>
        <script>
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".btn-admin-login").on('click',function (e) {
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
                    url: '{{ route('admin.user.login') }}',
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
        <!-- endinject -->
    </body>
</html>

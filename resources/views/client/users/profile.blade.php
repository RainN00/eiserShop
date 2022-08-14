@extends('client.layouts.master')
@section('title')
@if (Auth::check())
{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
@endif
@endsection
@section('wrapper')
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content d-md-flex justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <h2>Profile</h2>
                </div>
                <div class="page_link">
                    <a href="{{ route('client.home') }}">Home</a>
                    <span>profile</span>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!-- ================ contact section start ================= -->
<section class="section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-user"></i></span>
                    <div class="media-body">
                        <h3>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }} </h3>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-home"></i></span>
                    <div class="media-body">
                        <h3>{{ Auth::user()->address }}</h3>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                    <div class="media-body">
                        <h3><a href="tel:{{ Auth::user()->phone }}">{{ Auth::user()->phone }}</a></h3>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-email"></i></span>
                    <div class="media-body">
                        <h3><a href="mailto:{{ Auth::user()->email }}">{{ Auth::user()->email }}</a></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mb-4 mb-lg-0">
                <form class="form-contact contact_form" id="profileForm" action="{{ route('client.users.profile') }}" method="POST" novalidate="novalidate" enctype="multipart/form-data" action="javascript:void(0)">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 mx-auto">
                            <!-- Upload image input-->
                            <div class="input-group mb-3 px-2 rounded-pill bg-white shadow-sm">
                                <input id="upload" name="avatar" type="file" onchange="readURL(this);" class="form-control border-0">
                                <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                                <div class="input-group-append">
                                    <label for="upload" class="btn btn-dark m-2 rounded-pill"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                                </div>
                                <span class="text-danger error-text avatar_error"></span>
                            </div>
                            <!-- Uploaded image area-->
                            <p class="font-italic text-black text-center">The image uploaded will be rendered inside the box below.</p>
                            <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control" value="{{ Auth::user()->firstname }}" name="firstname" id="firstname" type="text" placeholder="Enter your firstname">
                                <span class="text-danger error-text fisrtname_error"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control" value="{{ Auth::user()->lastname }}" name="lastname" id="lastname" type="text" placeholder="Enter your lastname">
                                <span class="text-danger error-text lartname_error"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input class="form-control" value="{{ Auth::user()->email }}" name="email" id="email" type="email" placeholder="Enter email address" readonly>
                                <span class="text-danger error-text email_error"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control" value="{{ Auth::user()->address }}" name="address" id="address" type="text" placeholder="Enter your address">
                                <span class="text-danger error-text address_error"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control" value="{{ Auth::user()->phone }}" name="phone" id="phone" type="text" placeholder="Enter your phone number">
                                <span class="text-danger error-text phone_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-lg-3">
                        <button type="submit" class="main_btn btn-update-profile">update profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- ================ contact section end ================= -->
@endsection
@section('script')
<script type="text/javascript">
    /*  ==========================================
        SHOW UPLOADED IMAGE
    * ========================================== */
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imageResult').attr('src', e.target.result);
                $("#imageResult").css({ width: "200px",height:"150px0" });
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function () {
        $('#upload').on('change', function () {
            readURL(input);
        });
    });

    /*  ==========================================
        SHOW UPLOADED IMAGE NAME
    * ========================================== */
    var input = document.getElementById( 'upload' );
    var infoArea = document.getElementById( 'upload-label' );

    input.addEventListener( 'change', showFileName );
    function showFileName( event ) {
        var input = event.srcElement;
        var fileName = input.files[0].name;
        infoArea.textContent = 'File name: ' + fileName;
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#profileForm").on('submit', function (e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function(){
                $(form).find('span.error-text').text('')
            },
            success: function (data) {
                if (data.code == 0) {
                    $.each(data.error, function(prefix,val){
                        $(form).find('span.'+prefix+'_error').text(val[0])
                    });
                } else {
                    $(form)[0].reset();
                    alert(data.msg);
                }
            }
        });
    });
</script>
@endsection

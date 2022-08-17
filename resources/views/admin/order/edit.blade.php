@extends('admin.layouts.index')
@section('title')
Orders
@endsection
@section('wrapper')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Edit order</h3>
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

                    <form id="formUpdateOrder" class="form-horizontal form-label-left" action="{{ route('orders.update', ['order'=>$order->id]) }}" method="POST" novalidate enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <span class="section">Order Info</span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name customer <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" value="{{ $order->user->firstname }} {{ $order->user->lastname }}" @disabled(true)>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name payment <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" value="{{ $order->payment->name }}" @disabled(true)>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="notes">Notes
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="notes" id="notes" class="form-control col-md-7 col-xs-12">{{ $order->notes }}</textarea>
                                <span class="text-danger error-text notes_error"></span>

                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status *:</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="status" class="form-control" required>
                                    <option value="1" @if ($order->status == 1)@selected(true)@endif>
                                        Waiting for the package
                                    </option>
                                    <option value="2" @if ($order->status == 2)@selected(true)@endif>
                                        Being transported
                                    </option>
                                    <option value="3" @if ($order->status == 3)@selected(true)@endif>
                                        Has received the goods
                                    </option>
                                    <option value="4" @if ($order->status == 4)@selected(true)@endif>
                                        Item has been returned
                                    </option>
                                </select>
                                <span class="text-danger error-text status_error"></span>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">Cancel</button>
                                <button id="send" type="submit" class="btn btn-success btn-update-category">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#formUpdateOrder").on('submit' , function (e) {
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
            var form = this;
            formData = new FormData(form);
            var status = $("#status").val();
            formData.append('status', status);
            $.ajax({
                url: $(form).attr('action'),
                type: $(form).attr('method'),
                data: formData,
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
                        Swal.fire(
                            "Update order",
                            data.msg,
                            'success'
                        )
                    }
                }
            });
        });
    });
</script>
@endsection

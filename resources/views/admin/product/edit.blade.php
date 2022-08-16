@extends('admin.layouts.index') @section('title') Products @endsection @section('wrapper')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Create product</h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for..." />
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
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a></li>
                                <li><a href="#">Settings 2</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form id="formUpdateProduct" action="{{ route('products.update', ['product'=>$product->id]) }}" method="POST" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <span class="section">Prodcut Info</span>

                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Name <span class="required">*</span> </label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" value="{{ $product->name }}" data-validate-length-range="6" data-validate-words="2" name="name" required="required" type="text" />
                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="thumbnail">Thumbnail </label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="file" id="thumbnail" name="thumbnail" class="form-control col-md-7 col-xs-12" />
                                <span class="text-danger error-text thumbnail_error"></span>
                                <img style="width: 50%;height: 200px" src="{{ asset($product->thumbnail) }}" alt="" srcset="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="category">Category *:</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <select id="category" class="form-control" required>
                                    @foreach ($categories as $category)
                                        <option
                                        @if ($product->category_id == $category->id )
                                            @selected(true)
                                        @endif
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text category_error"></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="brand">Brand *:</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <select id="brand" class="form-control" required>
                                    @foreach ($brands as $brand)
                                        <option @if ($product->brand_id == $brand->id )
                                            @selected(true)
                                        @endif value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text brand_error"></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="nation">Nation *:</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <select id="nation" class="form-control" required>
                                    @foreach ($nations as $nation)

                                        <option @if ($product->nation_id == $nation->id )
                                            @selected(true)
                                        @endif value="{{ $nation->id }}">{{ $nation->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text nation_error"></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="short_description">Short description <span class="required">*</span> </label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <textarea id="short_description" required="required" name="short_description" class="form-control col-md-7 col-xs-12">{{ $product->short_description }}</textarea>
                                <span class="text-danger error-text short_description_error"></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="content">Content </label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                    <textarea name="content" id="content" class="ckeditor">{{ $product->content }}</textarea>
                                    <span class="text-danger text-error content_error"></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="quantity">Quantity <span class="required">*</span> </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="quantity" type="text" value="{{ $product->quantity }}" name="quantity" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12" />
                                <span class="text-danger text-error quantity_error"></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="price">Price <span class="required">*</span> </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="price" type="text" name="price" value="{{ $product->price }}" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12" />
                                <span class="text-danger text-error price_error"></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Gender *:</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <p>
                                  Active:
                                  <input type="radio" class="flat" name="status" id="genderM" value="1"
                                  @if ($product->status == 1)
                                    @checked(true)
                                  @endif
                                  required />
                                  Disable:
                                  <input type="radio" class="flat" name="status" id="genderF" @if ($product->status == 0)
                                  @checked(true)
                                @endif value="0" />
                                </p>
                            </div>
                          </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">Cancel</button>
                                <button id="send" type="submit" class="btn btn-success btn-create-product">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @section('script')
<script>
    $(document).ready(function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#formUpdateProduct").on("submit", function (e) {
            e.preventDefault();
            toastr.options = {
                closeButton: false,
                debug: false,
                newestOnTop: false,
                progressBar: false,
                positionClass: "toast-bottom-right",
                preventDuplicates: false,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                timeOut: "5000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
            };
            var form = this;
            formData = new FormData(form);
            var category = $('#category :selected').val();
            var brand = $('#brand :selected').val();
            var nation = $('#nation :selected').val();
            formData.append('category', category);
            formData.append('brand', brand);
            formData.append('nation', nation);
            $.ajax({
                url: $(form).attr("action"),
                method: $(form).attr("method"),
                data: formData,
                processData: false,
                dataType: "json",
                contentType: false,
                beforeSend: function () {
                    $(form).find("span.error-text").text("");
                },
                success: function (data) {
                    if (data.code == 0) {
                        $.each(data.error, function (prefix, val) {
                            $(form)
                                .find("span." + prefix + "_error")
                                .text(val[0]);
                        });
                    } else {
                        $(form)[0].reset();
                        toastr.success(data.msg);
                    }
                },
            });
        });
    });
</script>
@endsection

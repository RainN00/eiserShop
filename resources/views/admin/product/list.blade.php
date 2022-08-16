@extends('admin.layouts.index')
@section('title')
Products
@endsection
@section('wrapper')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Products list</h3>
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
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Thumbnail</th>
                                <th>Quantity sold</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td><img style="width: 100px;height: 100px" src="{{ asset($item->thumbnail) }}" alt=""></td>
                                    <td>{{ $item->quantity - $item->sold }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <a class="btn btn-round btn-success disable-product" data-urlDisable="{{ route('admin.products.disable', ['product'=>$item->id]) }}" href="javascript:void(0)" > Active </a>
                                        @else
                                            <a class="btn btn-round btn-warning active-product" data-urlActive="{{ route('admin.products.active', ['product'=>$item->id]) }}" href="javascript:void(0)" > Disable </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-default" href="{{ route('products.edit', ['product'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit </a>
                                        <a class="btn btn-danger delete-product" data-url="{{ route('products.destroy', $item->id) }}" href="javascript:void(0)" ><i class="fa fa-close"></i> Delete </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
        $(document).on('click', '.delete-product', function() {

            var userURL = $(this).data('url');
            var trObj = $(this);
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: userURL,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(data) {
                        Swal.fire(
                        "Delete",
                        data.msg,
                        "success"
                        );
                        trObj.parents("tr").remove();
                    }
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
                )
            }
            })
        });

        $(document).on('click', '.active-product', function() {

            var userURL = $(this).data('urlActive');
            var trObj = $(this);
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, active it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: userURL,
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {
                        Swal.fire(
                        "Active",
                        data.msg,
                        "success"
                        );
                        // trObj.parents("tr").reset();
                    }
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
                )
            }
            })
        });

        $(document).on('click', '.disable-product', function() {

            var userURL = $(this).data('urlDisable');
            var trObj = $(this);
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, disable it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: userURL,
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {
                        Swal.fire(
                        "Disable",
                        data.msg,
                        "success"
                        );
                        trObj.parents("tr").reset();
                    }
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
                )
            }
            })
        });

    });
</script>
@endsection

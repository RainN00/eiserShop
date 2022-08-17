@extends('admin.layouts.index')
@section('title')
Order
@endsection
@section('wrapper')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Order list</h3>
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
                                <th></th>
                                <th>Name customer</th>
                                <th>Name payment</th>
                                <th>Notes</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                                <tr>
                                    <td><a class="btn btn-default" href="{{ route('orders.show', ['order'=>$item->id]) }}"> Show detail </a></td>
                                    <td>{{ $item->user->firstname }} {{ $item->user->lastname }}</td>
                                    <td>{{ $item->payment->name }}</td>
                                    <td>{{ $item->notes }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                        <span class="btn btn-info" @disabled(true)>
                                            Waiting for the package
                                        </span>
                                        @endif
                                        @if($item->status == 2)
                                        <span class="btn btn-warning radius">
                                            Being transported
                                        </span>
                                        @endif
                                        @if($item->status == 3)
                                        <span class="btn btn-success" @disabled(true)>
                                            Has received the goods
                                        </span>
                                        @endif
                                        @if($item->status == 4)
                                        <span class="btn btn-danger" @disabled(true)>
                                            Item has been returned
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-default" href="{{ route('orders.edit', ['order'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit </a>
                                        <a class="btn btn-danger delete-order" data-url="{{ route('orders.destroy', $item->id) }}" href="javascript:void(0)" ><i class="fa fa-close"></i> Delete </a>
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
        $(document).on('click', '.delete-order', function() {

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

    });
</script>
@endsection

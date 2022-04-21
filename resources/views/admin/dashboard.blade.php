@extends('admin.admintemplate')

@section('content-area')
    <style type="text/css">
        .my-active span {
            background-color: #222 !important;
            color: white !important;
            border-color: #222 !important;
        }

    </style>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <section class="container-fluid admin-body">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="row">
                    <div class="col-md-3">
                        <div class="admin-details">
                            <span>Jhon Doe <br />
                                <small>Admin</small></span>
                            <div class="admin-right-nav">
                                <div class="admin-right-nav-item">New Orders</div>
                                <div class="admin-right-nav-item">Pending Orders</div>
                                <div class="admin-right-nav-item">Completed Orders</div>
                                <div class="admin-right-nav-item">Faq</div>
                            </div>
                            <div class="admin-bottom">
                                <div><a href="{{ url('admin/changeadminpass') }}"><i
                                            class="fas fa-cog text-white"></i></a>
                                </div>
                                <div><a href="{{url('adminsignout')}}"><i class="fas fa-sign-out-alt text-white"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 admin-content">
                        <div class="row admin-content-header">
                            <div class="col-md-1 text-center">O/N</div>
                            <div class="col-md-2 text-center">Order Date</div>
                            <div class="col-md-2 text-center">Total</div>
                            <div class="col-md-1 text-center">Status</div>
                            <div class="col-md-4 text-center">Progess</div>
                            <div class="col-md-2 text-center">Action</div>
                        </div>
                        @foreach ($orders as $item)
                            <div class="admin-content-body row d-flex align-content-center">
                                <div class="col-md-1 text-center">#{{ $item->id }}</div>
                                <div class="col-md-2 text-center">{{ $item->date }}</div>
                                <div class="col-md-2 text-center">¥{{ $item->total_amount }}</div>
                                <div class="col-md-1 text-center">
                                    <div class="text-primary">{{ $item->payment_status == 1 ? 'Paid' : 'Unpaid' }}</div>
                                </div>
                                <div class="col-md-4 text-center">
                                    <div class="text-success">
                                        <select name="" id="order-status" class="text-uppercase"
                                            onchange="orderstatuschange(this, {{ $item->id }})">
                                            <option @if ($item->delivery_status == 1) selected="selected" @endif value="1">
                                                Requested</option>
                                            <option @if ($item->delivery_status == 2) selected="selected" @endif value="2">
                                                checking purchase</option>
                                            <option @if ($item->delivery_status == 3) selected="selected" @endif value="3">
                                                purchase order payment</option>
                                            <option @if ($item->delivery_status == 4) selected="selected" @endif value="4">
                                                we
                                                are
                                                checking</option>
                                            <option @if ($item->delivery_status == 5) selected="selected" @endif value="5">
                                                shipping charge payment</option>
                                            <option @if ($item->delivery_status == 6) selected="selected" @endif value="6">
                                                delivery in progress</option>
                                            <option @if ($item->delivery_status == 7) selected="selected" @endif value="7">
                                                complete</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 text-center">
                                    <div class="d-flex justify-content-between align-content-center">
                                        <a href=""><i class="fas fa-eye text-primary"></i></a>
                                        <a href="{{ url('admin/orderedit/' . $item->id) }}"><i
                                                class="fas fa-edit text-secondary"></i></a>
                                        <div><i class="fas fa-trash text-danger"></i></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="admin-content-footer row">
                            {{ $orders->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function orderstatuschange(e, id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ url('admin/updatestatus') }}",
                data: {
                    'status_change': true,
                    "order_id": id,
                    "status": e.value
                },
                cache: false,
                success: function(response) {
                    console.log(response);
                },
                error: function() {

                }
            });
        }
    </script>
@endsection

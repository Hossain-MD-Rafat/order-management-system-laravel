@extends('admin.admintemplate')

@section('content-area')
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
                                <div><i class="fas fa-cog"></i></div>
                                <div><i class="fas fa-sign-out-alt"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 admin-content">
                        <div class="row admin-content-header">
                            <div class="col-md-1 text-center">O/N</div>
                            <div class="col-md-3 text-center">Order Date</div>
                            <div class="col-md-2 text-center">Total</div>
                            <div class="col-md-2 text-center">Status</div>
                            <div class="col-md-2 text-center">Progess</div>
                            <div class="col-md-2 text-center">Action</div>
                        </div>
                        @foreach ($orders as $item)
                            <div class="admin-content-body row d-flex align-content-center">
                                <div class="col-md-1 text-center">#{{ $item->id }}</div>
                                <div class="col-md-3 text-center">{{ $item->date }}</div>
                                <div class="col-md-2 text-center">¥{{ $item->total_amount }}</div>
                                <div class="col-md-2 text-center">
                                    <div class="text-primary">{{ $item->payment_status == 1 ? 'Paid' : 'Unpaid' }}</div>
                                </div>
                                <div class="col-md-2 text-center">
                                    <div class="text-success">
                                        @if ($item->delivery_status == 1)
                                            Requested
                                        @elseif($item->delivery_status == 2)
                                            checking purchase
                                        @elseif($item->delivery_status == 3)
                                            purchase order payment
                                        @elseif($item->delivery_status == 4)
                                            we are checking
                                        @elseif($item->delivery_status == 5)
                                            shipping charge payment
                                        @elseif($item->delivery_status == 6)
                                            delivery in progress
                                        @elseif($item->delivery_status == 7)
                                            complete
                                        @else
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2 text-center">
                                    <div class="d-flex justify-content-between align-content-center">
                                        <a href=""><i class="fas fa-eye text-primary"></i></a>
                                        <a href=""><i class="fas fa-edit text-secondary"></i></a>
                                        <div><i class="fas fa-trash text-danger"></i></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="admin-content-footer row">
                            <div class="admin-pagination">
                                <div>pages</div>
                                <a class="active" href="">1</a>
                                <a href="">1</a>
                                <a href="">1</a>
                                <a href="">1</a>
                            </div>
                            <div class="total-result">Result 1 to 7 of 1000</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <!-- <div class="panel-heading">Order</div> -->

                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#all_orders">All Orders</a></li>
                        <li><a data-toggle="tab" href="#ongoing">Ongoing</a></li>
                        <li><a data-toggle="tab" href="#completed">Completed</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="all_orders" class="tab-pane fade in active">
                            <h3>All Orders</h3>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Customer</th>
                                            <th>Waktu Order</th>
                                            <th>Harga</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $number => $order)
                                        <tr>
                                            <td>{{$number+1}}</td>
                                            <td>{{$order->customer->name}}</td>
                                            <td>{{$order->created_at}}</td>
                                            <td>{{$order->total_discount}}</td>
                                            <td>Ongoing</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="ongoing" class="tab-pane fade">
                            <h3>Ongoing Orders</h3>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Customer</th>
                                            <th>Waktu Order</th>
                                            <th>Harga</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $number => $order)
                                        <tr>
                                            <td>{{$number+1}}</td>
                                            <td>{{$order->customer->name}}</td>
                                            <td>{{$order->created_at}}</td>
                                            <td>{{$order->total_discount}}</td>
                                            <td>Ongoing</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div id="completed" class="tab-pane fade">
                            <h3>Completed Orders</h3>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Customer</th>
                                            <th>Waktu Order</th>
                                            <th>Harga</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

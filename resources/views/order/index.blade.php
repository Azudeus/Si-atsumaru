@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <!-- <div class="panel-heading">Order</div> -->

                <div class="panel-body">
                    <ul class="nav nav-tabs" onclick="load()">
                        <li class="active"><a data-toggle="tab" href="#checklist">Checklist</a></li>
                        <li><a data-toggle="tab" href="#all_orders">All Orders</a></li>
                        <li><a data-toggle="tab" href="#ongoing">Ongoing</a></li>
                        <li><a data-toggle="tab" href="#completed">Completed</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="checklist" class="tab-pane fade in active">
                            <h3>Checklist</h3>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Customer</th>
                                            <th>Menu</th>
                                            <th>Waktu Order</th>
                                            <th>Kuantitas</th>
                                            <th>Description</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders_menu as $number => $order_menu)
                                        <tr id="{{$order_menu->id}}">
                                            <td>{{$number+1}}</td>
                                            <td>{{$order_menu->order->customer->name}}</td>
                                            <td>{{$order_menu->menu->name}}</td>
                                            <td>{{$order_menu->created_at}}</td>
                                            <td>{{$order_menu->quantity}}</td>
                                            <td>{{$order_menu->description}}</td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-xs" onclick="FinishedChecklist({{$order_menu->id}})">
                                                  Finished
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="all_orders" class="tab-pane fade in">
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
                                            <td>
                                                @if ($order->status === 1)
                                                    Paid
                                                @else
                                                    Ongoing
                                                @endif
                                            </td>
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
                                    @foreach($orders_ongoing as $number => $order)
                                        <tr id="order{{$order->id}}">
                                            <td>{{$number+1}}</td>
                                            <td>{{$order->customer->name}}</td>
                                            <td>{{$order->created_at}}</td>
                                            <td>{{$order->total_discount}}</td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-xs" onclick="CheckOut({{$order->id}})">
                                                  Checkout
                                                </button>
                                            </td>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders_completed as $number => $order)
                                        <tr>
                                            <td>{{$number+1}}</td>
                                            <td>{{$order->customer->name}}</td>
                                            <td>{{$order->created_at}}</td>
                                            <td>{{$order->total_discount}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="#error"></div>
<script>
    function FinishedChecklist(id){
        $.ajax({
            method: 'POST', // Type of response and matches what we said in the route
            url: '/order/finishedChecklist', // This is the url we gave in the route
            data: {'id' : id, _token : '{{ csrf_token() }}'}, // a JSON object to send back
            success: function(response){ // What to do if we succeed
                $('#'+id).remove();
            },
            error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                $('#error').html(JSON.stringify(jqXHR['responseText']));
                console.log(JSON.stringify(jqXHR['responseText']));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        });
    };
    function CheckOut(id){
        $.ajax({
            method: 'POST', // Type of response and matches what we said in the route
            url: '/order/checkOut', // This is the url we gave in the route
            data: {'id' : id, _token : '{{ csrf_token() }}'}, // a JSON object to send back
            success: function(response){ // What to do if we succeed
                if(response['status']=='no'){
                    alert(response['msg']);
                } else {
                    $('#order'+id).remove();
                }
                console.log(response['status']);
            },
            error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                $('#error').html(JSON.stringify(jqXHR['responseText']));
                console.log(JSON.stringify(jqXHR['responseText']));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        });
    };
</script>
@endsection

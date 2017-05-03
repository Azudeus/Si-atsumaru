@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Dashboard</h3></div>

                <div class="panel-body">
                    <div class="col-md-12">
                        <h3>Latest Cash Inflows</h3>
                        <div id="myfirstchart" style="height: 250px;"></div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <label class="col-md-4 control-label" name="activity"><h3>Latest Activities</h3></label>
                    </div>
                    <div class="col-md-12 data_table">
                        <table class="table table-condensed">
                            <tr>
                                <th>Menu</th>
                                <th>Quantity</th>
                                <th>Time</th>
                                <th>Status</th>
                            </tr>
                            @foreach ($orders_menu as $order_menu)
                            <tr class="customers-card">
                                <td> {{$order_menu->menu_name}}</td>
                                <td> {{$order_menu->quantity}}</td>
                                <td> {{$order_menu->created_at}}</td>
                                <td> @if ($order_menu->status === 1)
                                        Finished
                                     @else
                                        Ongoing
                                     @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                     <div class="row">
                        <label class="col-md-4 control-label" name="inventory"><h3>Critical Inventories</h3></label>
                    </div>
                    <div class="col-md-12 data_table">
                        <table class="table table-condensed">
                            <tr>
                                <th>Menu</th>
                                <th>Stock</th>
                            </tr>
                            @foreach ($inventories as $inventory)
                            <tr class="customers-card">
                                <td> {{$inventory->name}}</td>
                                <td> <font color="red"> {{$inventory->stock}}  </font></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript">

$.get('/getChartData', function(data, status) {
    new Morris.Line({
    // ID of the element in which to draw the chart.
    element: 'myfirstchart',
    // Chart data records -- each entry in this array corresponds to a point on
    // the chart.
    data: data,
    // The name of the data record attribute that contains x-values.
    xkey: 'date',
    // A list of names of data record attributes that contain y-values.
    ykeys: ['cash inflow'],
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    labels: ['Cash Inflow']
    });
    console.log(data)
})
</script>
@endsection

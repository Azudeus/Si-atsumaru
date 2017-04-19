@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Dashboard</h3></div>

                <div class="panel-body">
                    <div class="col-md-6">
                        <a href="/img/chartExample.jpg" target=_blank><img src="/img/chartExample.jpg" class="resize"></a>
                    </div>
                    <div class="col-md-6">
                        <a href="/img/PieChartExample.png" target=_blank><img src="/img/PieChartExample.png" class="resize"></a>
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
                                <td> {{$order_menu->menu->name}}</td>
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
                        <label class="col-md-4 control-label" name="inventory"><h3>Inventories</h3></label>
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

<script type="text/javascript">
    function validate(e) {
        if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
            var search_term = e.target.value.toLowerCase()

            console.log('Searching: '+search_term)
            $(".inventory-card").each(function(index) {
                var inventory_name = $( this ).text().toLowerCase()
                if(inventory_name.includes(search_term)) {
                    $(this).show()
                }
                else {
                    $(this).hide()   
                }
            });
        }
    }
</script>

@endsection


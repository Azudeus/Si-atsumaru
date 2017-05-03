@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Inventory</h3></div>

                <div class="panel-body">
                    <div class="col-md-4">
                        <div class="page-header" style="margin-top: 20px;">
                             <h4>Add New Inventory</h4>
                        </div>
                        <form class="form-horizontal" role="form" method="POST" action="{{action('InventoryController@addInventory')}}">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            <div class=form-group>
                                <label for="name" class="col-md-2">Name</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="name" />
                                </div>
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif

                            <div class=form-group>
                                <label for="stock" class="col-md-2">Stock</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number" name="stock" />
                                </div>
                            </div>
                            @if ($errors->has('stock'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('stock') }}</strong>
                                </span>
                            @endif

                            <div class=form-group>
                                <label for="name" class="col-md-2">Price</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number" name="price" />
                                </div>
                            </div>
                            @if ($errors->has('price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                            <input type=submit class="btn btn-primary" value="Add Inventory"/>
                        </form>
                    </div>

                    <div class="col-md-8">
                        <div class="page-header" style="margin-top: 20px;">
                                 <h4>List of Inventory</h4>
                        </div>
                        <div class="col-md-12">
                            <label for="menu_name" class="col-md-2 control-label">Search Menu</label>
                            <div class="col-md-10">
                                <input id="menu_name" type="text" class="form-control" name="menu_name" onkeydown="validate(event)" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-12 data_table">
                            <table class="table table-condensed">
                                <tr>
                                    <th>Name</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th></th>
                                </tr>
                                @foreach ($inventories as $inventory)
                                <tr class="inventory-card">
                                    <td>{{$inventory->name}}</td>
                                    <td>{{$inventory->stock}}</td>
                                    <td>{{$inventory->price}}</td>
                                    <td>
                                         <div class="col-md-offset-4 col-md-4">
                                            @include('inventory.edit_inventory',[
                                                "id" => $inventory->id,
                                                "name" => $inventory->name,
                                                "stock" => $inventory->stock,
                                                "price" => $inventory->price,
                                            ])
                                        </div>
                                       <div class="col-md-4">
                                            <a href="#" data-toggle="modal" data-target="#myModalDelete-{{$inventory->id}}">
                                                <i class="fa fa-trash fa-lg" style="color:#e84646" aria-hidden="true"></i>
                                            </a>
                                            <!-- Modal -->
                                            <div id="myModalDelete-{{$inventory->id}}" class="modal fade" role="dialog">
                                              <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Delete this inventory?</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    <p>Are you sure you want to delete <strong>{{$inventory->name}}</strong>?</p>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <form method="POST" action="{{ route('delete_inventory') }}">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                                        <input type="hidden" name="id" value="{{$inventory->id}}">
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                  </div>
                                                </div>

                                              </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
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

    function deleteInventory(id) {
        $.post("{{ route('delete_inventory') }}",
        {
            id: id
        },
        function(data, status){
            alert("Data: " + data + "\nStatus: " + status);
        });
    }
</script>

@endsection

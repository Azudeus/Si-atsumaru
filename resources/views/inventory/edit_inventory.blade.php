<a href="#x" data-toggle='modal' data-target="#myModal{{$id}}" data-invenId="{{ $id }}" data-name="{{ $name }}" data-stock="{{ $stock }}" data-price="{{ $price }}">
  <i class="fa fa-pencil fa-lg" style="color:grey" aria-hidden="true"></i> 
</a>

<!-- Modal -->
<div class="modal fade" id="myModal{{$id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Inventory</h4>
      </div>

     <form class="form-horizontal" role="form" method="POST" action="{{action('InventoryController@editInventory')}}">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>                            
        <input id="id" type="hidden" name="id" value="{{$id}}">
         <div class="modal-body">
            <div class="row">
                <label for="name" class="col-md-2">Name</label>
                <div class="col-md-10">
                    <input id="name" class="form-control" type="text" name="name" value="{{$name}}"/>
                </div>
            </div>

            <div class="row">
                <label for="stock" class="col-md-2">Stock</label>
                <div class="col-md-10">
                    <input id="stock" class="form-control" type="number" name="stock" value="{{$stock}}"/>
                </div>
            </div>

            <div class="row">
                <label for="price" class="col-md-2">Price</label>
                <div class="col-md-10">
                    <input id="price" class="form-control" type="number" name="price" value="{{$price}}"/>
                </div>
            </div>

         </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Edit Inventory"/>
          </div>
      </form>
    </div>
  </div>
</div>


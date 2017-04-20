<a href="#" data-toggle='modal' data-target="#myModal{{$id}}" data-invenId="{{ $id }}" data-name="{{ $name }}" data-email="{{ $email }}" data-address="{{ $address }}">
  <i class="fa fa-pencil fa-lg" style="color:grey" aria-hidden="true"></i> 
</a>

<!-- Modal -->
<div class="modal fade" id="myModal{{$id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Customer</h4>
      </div>

     <form class="form-horizontal" role="form" method="POST" action="{{action('CustomerController@editCustomer')}}">
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
                <label for="email" class="col-md-2">Email</label>
                <div class="col-md-10">
                    <input id="email" class="form-control" type="email" name="email" value="{{$email}}"/>
                </div>
            </div>

            <div class="row">
                <label for="address" class="col-md-2">Address</label>
                <div class="col-md-10">
                    <input id="address" class="form-control" type="text" name="address" value="{{$address}}"/>
                </div>
            </div>

         </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Save Changes"/>
          </div>
      </form>
    </div>
  </div>
</div>


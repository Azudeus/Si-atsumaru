@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Customer</h3></div>

                <div class="panel-body">

                    <div class="col-md-4">
                        <div class="page-header" style="margin-top: 20px;">
                             <h4>Add New Customer</h4>
                        </div>
                        <form class="form-horizontal" role="form" method="POST" action="{{action('CustomerController@addCustomer')}}">
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
                                <label for="stock" class="col-md-2">Email</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="email" name="email" />
                                </div>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif

                            <div class=form-group>
                                <label for="name" class="col-md-2">Address</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="address" />
                                </div>
                            </div>
                            @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                            <input type=submit class="btn btn-primary" value="Add Customer"/>
                        </form>
                    </div>

                    <div class="col-md-8">
                        <div class="page-header" style="margin-top: 20px;">
                             <h4>List of Customer</h4>
                        </div>
                        <div class="col-md-12">
                            <label for="menu_name" class="col-md-2 control-label">Search Customer</label>
                            <div class="col-md-10">
                                <input id="menu_name" type="text" class="form-control" name="menu_name" onkeydown="validate(event)" autocomplete="off">
                            </div>
                        </div>


                        <div class="col-md-12 data_table">
                            <table class="table table-condensed">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                                @foreach ($customers as $customer)
                                <tr class="customers-card">
                                    <td> {{$customer->name}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td>{{$customer->address}}</td>
                                    <td>
                                        <div class="col-md-offset-4 col-md-4">
                                            @include('customer.edit_customer',[
                                                "id" => $customer->id,
                                                "name" => $customer->name,
                                                "email" => $customer->email,
                                                "address" => $customer->address,
                                            ])
                                        </div>
                                       <div class="col-md-4">
                                            <a href="#" data-toggle="modal" data-target="#myModalDelete-{{$customer->id}}">
                                                <i class="fa fa-trash fa-lg" style="color:#e84646" aria-hidden="true"></i>
                                            </a>
                                            <!-- Modal -->
                                            <div id="myModalDelete-{{$customer->id}}" class="modal fade" role="dialog">
                                              <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Delete this customer?</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    <p>Are you sure you want to delete <strong>{{$customer->name}}</strong>?</p>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <form method="POST" action="{{ route('delete_customer') }}">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                                        <input type="hidden" name="id" value="{{$customer->id}}">
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

                <div class="panel-body">

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
            $(".customer-card").each(function(index) {
                var customer_name = $( this ).text().toLowerCase()
                if(customer_name.includes(search_term)) {
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

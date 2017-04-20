@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Menu</h3></div>


                <div class="panel-body">

                    <div class="col-md-12" style="overflow: hidden;">
                        <div class="page-header" style="margin-top: 20px;">
                         <h4>Add New Menu</h4>
                        </div>
                        
                        <form class="form-horizontal" role="form" method="POST" action="{{action('MenuController@addMenu')}}" onkeydown="validate_enter(event)" enctype="multipart/form-data">
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

                            <div class=form-group>
                                <label for="name" class="col-md-2">Inventories</label>
                                <div class="col-md-10">
                                <div class="col-md-12" style="border: 1px solid #ccd0d2; border-radius: 4px; padding:10px;">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input id="madeof_name" type="text" class="form-control input-sm" name="madeof_name" onkeydown="validate_madeof(event)" autocomplete="off">
                                            <span class="input-group-addon"><span class="fa fa-search" aria-hidden="true"></span></span>
                                        </div>
                                    </div>
                                    @foreach ($inventories as $inventori)
                                    <div class="inventori col-md-3" style="display: inline-block; position: relative; margin:10px;">
                                         <div class="input-group">
                                          <span class="input-group-addon">
                                                <input type="checkbox" aria-label="Checkbox for following text input"  onchange="inv_checked(event)" value="{{ $inventori->id }}" name="madeof[]">
                                          </span>
                                          <span class="input-group-addon">{{ $inventori->name }}</span>
                                          <input type="number" class="form-control" aria-label="Text input with checkbox" id="madeof_{{ $inventori->id }}" name="madeof_{{ $inventori->id }}" disabled="" value="0">
                                        </div>
                                                 
                                    </div>
                                    @endforeach
                                </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-2">
                                    <label for="exampleInputFile">Upload Image</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="file" name="image" id="exampleInputFile">
                                    <p class="help-block">Add your menu's photo</p>
                                </div>
                            </div>
                            <input type=submit class="btn btn-primary" value="Add New Menu" style="float:right;"/>
                        </form>
                    </div>  

                
                    <div class="col-md-12 search_bar">
                     <div class="page-header" style="margin-top: 20px;">
                         <h4>List of Menu</h4>
                        </div>
                        <label for="menu_name" class="col-md-2 control-label">Search Menu</label>
                            <div class="col-md-10">
                                <input id="menu_name" type="text" class="form-control" name="menu_name" onkeydown="validate(event)" autocomplete="off">
                            </div>
                    </div>

                    <div class="col-md-12 data_table">
                        <table class="table table-condensed">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th> 
                                <th>Stock status</th>
                                <th></th>
                            </tr>
                            @foreach ($menus as $menu)
                            <tr class="menus-card" id="menu{{$menu->id}}">
                                <td>
                                    <img id="menu1" src="data:image/png;base64,{{ $menu->image }}" alt="Iced Tea" style="width: 100px; height: 100px;"class="img-thumbnail">
                                </td>
                                <td>{{$menu->name}}</td>
                                <td>{{$menu->price}}</td> 
                                <td><span class="label label-success">in stock</span></td>
                                <td>
                                    <div class="col-md-offset-4 col-md-4">
                                            @include('menu.edit_menu',[
                                                "id" => $menu->id,
                                                "name" => $menu->name,
                                                "image" => $menu->image,
                                                "price" => $menu->price,
                                            ])
                                        </div>
                                       <div class="col-md-4">
                                            <a href="#" data-toggle="modal" data-target="#myModalDelete">
                                                <i class="fa fa-trash fa-lg" style="color:#e84646" aria-hidden="true"></i>
                                            </a>
                                            <!-- Modal -->
                                            <div id="myModalDelete" class="modal fade" role="dialog">
                                              <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Delete this menu?</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    <p>Are you sure you want to delete <strong>{{$menu->name}}</strong>?</p>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <form method="POST" action="{{ route('delete_menu') }}">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                                        <input type="hidden" name="id" value="{{$menu->id}}">
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
<script type="text/javascript">
    function validate(e) {
        if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
            var search_term = e.target.value.toLowerCase()

            console.log('Searching: '+search_term)
            $(".menus-card").each(function(index) {
                var menu_name = $( this ).text().toLowerCase()
                if(menu_name.includes(search_term)) {
                    $(this).show()
                }
                else {
                    $(this).hide()   
                }
            });
        }
    }

    function del(id){
          $.ajax({
            method: 'POST', // Type of response and matches what we said in the route
            url: '/menu/delete', // This is the url we gave in the route
            data: {'id' : id, _token : '{{ csrf_token() }}'}, // a JSON object to send back
            success: function(response){ // What to do if we succeed
                location.load();
            },
            error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                $('#error').html(JSON.stringify(jqXHR['responseText']));
                console.log(JSON.stringify(jqXHR['responseText']));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        });
    }
    function validate_madeof(e) {
        if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
            var search_term = e.target.value.toLowerCase()

            console.log('Searching: '+search_term)
            $(".inventori").each(function(index) {
                var inv_name = $( this ).text().toLowerCase()
                if(inv_name.includes(search_term)) {
                    $(this).show()
                }
                else {
                    $(this).hide()   
                }
            });
        }
    }
     function validate_enter(e) {
        if(e.keyCode == 13) {
          e.preventDefault();
          return false;
        }
    }

    function inv_checked(e){
        var id = e.target.value.toLowerCase();
        $('#madeof_'+id).prop('disabled', !($(e.target).is(":checked")));
    }
</script>
@endsection

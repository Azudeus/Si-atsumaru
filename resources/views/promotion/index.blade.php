@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Promotion</h3></div>

                <div class="panel-body">

                    <div class="col-md-4">
                        <div class="page-header" style="margin-top: 20px;">
                             <h4>Add New Promotion</h4>
                        </div>
                        <form class="form-horizontal" role="form" method="POST" action="{{action('PromotionController@addPromotion')}}">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            <div class=form-group>
                                <label for="name" class="col-md-3">Promo's Name</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="name" />
                                </div>
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif

                            <div class=form-group>
                                <label for="discount" class="col-md-3">Discount</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="number" name="discount" />
                                </div>
                            </div>
                            @if ($errors->has('discount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('discount') }}</strong>
                                </span>
                            @endif

                            <div class=form-group>
                                <label for="name" class="col-md-3">Valid Until</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="datetime-local" name="valid_until" value="<?php date_default_timezone_set("Asia/Jakarta");echo date("Y-m-d")." ".date("h:i"); ?>"/>
                                </div>
                            </div>
                            @if ($errors->has('valid_until'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('valid_until') }}</strong>
                                </span>
                            @endif
                            <input type=submit class="btn btn-primary" value="Add Promotion"/>
                        </form>
                    </div>

                    <div class="col-md-8">
                        <div class="page-header" style="margin-top: 20px;">
                             <h4>List of Promotion</h4>
                        </div>
                        <div class="col-md-12">
                            <label for="menu_name" class="col-md-2 control-label">Search Promotion</label>
                            <div class="col-md-10">
                                <input id="menu_name" type="text" class="form-control" name="menu_name" onkeydown="validate(event)" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-12 data_table">
                            <table class="table table-condensed">
                                <tr>
                                    <th>Promo's Name</th>
                                    <th>Discount</th>
                                    <th>Valid Until</th>
                                    <th></th>
                                </tr>
                                @foreach ($promotions as $promotion)
                                <tr class="inventory-card">
                                    <td>{{$promotion->name}}</td>
                                    <td>{{$promotion->discount}}</td>
                                    <td>{{$promotion->valid_until}}</td>
                                    <td>
                                         <div class="col-md-offset-4 col-md-4">
                                            @include('promotion.edit_promotion',[
                                                "id" => $promotion->id,
                                                "name" => $promotion->name,
                                                "discount" => $promotion->discount,
                                                "valid_until" => $promotion->valid_until,
                                            ])
                                        </div>
                                       <div class="col-md-4">
                                            <a href="#" data-toggle="modal" data-target="#myModalDelete-{{$promotion->id}}">
                                                <i class="fa fa-trash fa-lg" style="color:#e84646" aria-hidden="true"></i>
                                            </a>
                                            <!-- Modal -->
                                            <div id="myModalDelete-{{$promotion->id}}" class="modal fade" role="dialog">
                                              <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Delete this promotion?</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    <p>Are you sure you want to delete <strong>{{$promotion->name}}</strong>?</p>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <form method="POST" action="{{ route('delete_promotion') }}">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                                        <input type="hidden" name="id" value="{{$promotion->id}}">
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
            $(".promotion-card").each(function(index) {
                var promotion_name = $( this ).text().toLowerCase()
                if(promotion_name.includes(search_term)) {
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

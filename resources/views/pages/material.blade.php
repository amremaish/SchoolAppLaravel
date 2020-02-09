@extends('layouts.app') @section('content')
<div class="semi-bold page-title">
    <h3>Materials</h3>
</div>
@if(Session::get('cur_user')["userType"] == "admin" || Session::get('cur_user')["userType"] == "teacher")
<div class="row">
    <div class="col-md-12">
        <button type="button" onclick="show_add_material_modal()" data-toggle="modal" data-target="#add_material_modal" class="btn btn-primary pull-right" data-dismiss="modal">Add material</button>
    </div>
</div>
@endif
@for ($x = 0; $x < count($data[ "materials"]); $x++) 

<br>
    <div class="row">
        <div class="col-md-12">
            <div class="widget-item " style="zoom: 1;">
                <div onclick="showMaterial({{$x}})" data-toggle="modal" data-target="#material_modal" class="tiles green  overflow-hidden full-height" style="max-height:214px ; cursor: pointer;">
                    <img src='{{$data["materials"][$x]["imgPath"]}}' id="material_img_{{$x}}" class="lazy hover-effect-img image-responsive-width">
                </div>
                <div class="tiles white ">
                    <div class="tiles-body">
                        <div class="row">
                            <div class="user-profile-pic text-left"> <img width="69" height="69" id="material_user_img" data-src-retina="{{$data["users"][$x]["imagePath"]}}" data-src="{{$data["users"][$x]["imagePath"]}}" src="{{$data["users"][$x]["imagePath"]}}" alt="">
                            </div>
                            <div class="col-md-2 no-padding">
                                <div class="user-comment-wrapper">
                                    <div class="user-comment-wrapper">
                                        <div class="row">
                                            <div class="comment">
                                                <div class="user-name text-black bold" id="material_username">{{$data["users"][$x]["username"]}}</div>
                                                <a href="javascript:;" class="remove"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10 no-padding">
                                <div class="col-md-12">
                                    <div class="scroller scrollbar-hidden scroll-content scroll-scrollx_visible scroll-scrolly_visible" data-height="220px" style="margin-bottom: -17px; margin-right: -17px; height: 237px;">
                                        <h3 id="material_title">{{$data["materials"][$x]["title"]}}</h3>
                                        <p style="height : 80%" id="material_desc">{{$data["materials"][$x]["desc"]}}</p>
                                    </div>
                                </div>
                            </div>
                            @if(Session::get('cur_user')["userType"] == "admin" || Session::get('cur_user')["userType"] == "teacher")
                            <div class="row">
                                <div class="col-md-offset-11">
                                    <i class="fa fa-cog  fa-2x" style="cursor: pointer;" data-toggle="modal" data-target="#update_material_modal"  onclick='show_update_material_modal("{{$data["materials"][$x]["id"]}}")'>&nbsp;</i>
                                    <i style="color:red; cursor: pointer;" data-toggle="modal" data-target="#delete_material_modal"onclick='show_delete_material_modal("{{$data["materials"][$x]["id"]}}")' class="fa fa-minus-circle fa-2x"></i>
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endfor
  
    <div class="modal fade in" id="material_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" onclick="close_view_modal()" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                </div>
                <div class="widget-item ">
                    <div class="tiles white ">
                        <div class="tiles-body">
                            <img id='mat_img_modal' alt="" class="image-responsive-width">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade in" id="add_material_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:None;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-question fa-7x"></i>
                    <h4 id="myModalLabel" class="semi-bold">Add new Material</h4>
                </div>
                <div class="modal-body">
                    <div class="row form-row">
                        <div class="col-md-12">
                            <input class="form-control" id="add_mat_title" placeholder="Title" type="text" required>
                        </div>
                    </div>
                    <div class="row form-row">
                        <div class="col-md-12">
                            <textarea type="text" id="add_mat_desc" placeholder="Description of material" style="height : 220px " class="form-control" rows="3"> </textarea>
                        </div>
                    </div>
                    <div class="row form-row">
                        <div class="col-md-12 col-sm-12 ">
                            <label for="file">Choose material image to upload</label>
                            <input class="form-control" id="material_img" type="file" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" onclick="add_mat_action('{{Session::get('cur_user')['email']}}')" class="btn btn-primary" data-dismiss="modal">submit</button>
                    <button onclick="close_add_modal()" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade in" id="update_material_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:None;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-question fa-7x"></i>
                    <h4 id="myModalLabel" class="semi-bold">Update this Material</h4>
                </div>
                <div class="modal-body">
                    <div class="row form-row">
                        <div class="col-md-12">
                            <input class="form-control" id="update_mat_title" placeholder="Title" type="text" required>
                        </div>
                    </div>
                    <div class="row form-row">
                        <div class="col-md-12">
                            <textarea type="text" id="update_mat_desc" style="height : 220px " class="form-control" rows="3"> </textarea>
                        </div>
                    </div>
                    <div class="row form-row">
                        <div class="col-md-12 col-sm-12 ">
                            <label for="file">Choose material image to upload</label>
                            <input class="form-control" id="update_material_img" type="file" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" onclick="update_mat_action('{{Session::get('cur_user')['email']}}')" class="btn btn-primary" data-dismiss="modal">submit</button>
                    <button onclick="close_add_modal()" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade in" id="delete_material_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:None;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-trash fa-5x"></i>
                    <h4 id="myModalLabel" class="semi-bold red">Delete this Material</h4>
                </div>
                <div class="modal-body">
                <div class="modal-footer ">
                    <button type="button" onclick="delete_mat_action()" class="btn btn-danger" data-dismiss="modal">submit</button>
                    <button onclick="close_delete_modal()" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
    <div style = "display:none" id = "cur_mat"></div>

    @endsection
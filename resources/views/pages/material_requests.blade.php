@extends('layouts.app') @section('content')
<div class="semi-bold page-title">
    <h3>Materials requests</h3>
</div>
@for ($x = 0; $x < count($data["materials"]); $x++) 
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
                            <div class="row">
                                    <div class="col-md-offset-4">
                                        <button style = "width:150px" onclick = 'sendStatus("{{$data["materials"][$x]["id"]}}" , "Accepted")' type="button" class="btn btn-primary" data-dismiss="modal">Accept</button>
                                        <button style = "width:150px" onclick = 'sendStatus("{{$data["materials"][$x]["id"]}}" , "Refused")' type="button" class="btn btn-danger" data-dismiss="modal">Reject</button>
                                    </div>
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
@endsection
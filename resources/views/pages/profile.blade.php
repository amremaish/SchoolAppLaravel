@extends('layouts.app') @section('content')
<div class="semi-bold page-title">
    <h3>Profile</h3>
</div>
<br>
    <div class="row">
        <div class="col-md-12">
            <div class="widget-item " style="zoom: 1;">
                <div onclick='showProfileImage("{{Session::get("cur_user")["imagePath"]}}")' data-toggle="modal" data-target="#profile_modal" class="tiles green  overflow-hidden full-height" style="max-height:214px ; cursor: pointer;">
                    <img src="{{Session::get('cur_user')['imagePath']}}" class="lazy hover-effect-img image-responsive-width">
                </div>
                <div class="tiles white ">
                     <div class="tiles-body">
                        <div role="tabpanel" class="tab-pane" id="tab_register">
                                <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                                    <div class="col-md-4 col-sm-4">
                                    <input class="form-control" value = "{{Session::get("cur_user")["username"]}}" id="pro_username" placeholder="Username" type="text" required> 
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                    <input class="form-control" disabled  value = "{{Session::get("cur_user")["email"]}}" id="pro_email"  placeholder="Email" type="text" required>
                                    </div>
                                </div>
                                <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                                    <div class="col-md-6 col-sm-6">
                                    <input class="form-control" id="pro_pass"  placeholder="Password" type="password" required>
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" id="pro_con_pass" type="password"  placeholder="Confirm password" type="email" required="">
                                    </div>
                                </div>
                                <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                                    <div class="col-md-6 col-sm-6">
                                    <input class="form-control" id="pro_age"  value = "{{Session::get("cur_user")["age"]}}"  placeholder="Age" type="text" required="">
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                    <input class="form-control" id="pro_phone_num"  value = "{{Session::get("cur_user")["phone_number"]}}" placeholder="Phone number" type="text" required="">
                                    </div>
                                </div> 
                                <br>
                                <div class=" row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10 " >
                                    <div class="col-md-6 col-sm-6">
                                        <label for="file">Choose profile image to upload</label>
                                        <input name ="profImg" id ="profImg" type="file" accept="image/*">
                                    </div>          
                                </div>
                                <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                                    <div class="col-md-6">
                                        <button id="submit_profile_btn" onclick="submit_profile()" class="btn btn-info btn-cons">Submit</button>
                                    </div>
                                </div>
                            </div>
        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade in" id="profile_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                </div>
                <div class="widget-item ">
                    <div class="tiles white ">
                        <div class="tiles-body">
                            <img id='profile_img_modal' alt="" class="image-responsive-width">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
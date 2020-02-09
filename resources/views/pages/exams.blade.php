@extends('layouts.app') @section('content')
<div class="semi-bold page-title">
    <h3>Exams</h3>
</div>
@if(Session::get('cur_user')["userType"] == "admin" || Session::get('cur_user')["userType"] == "teacher")
<div class="row">
    <div class="col-md-12">
        <button type="button" onclick="" data-toggle="modal" data-target="#add_exam_modal" class="btn btn-primary pull-right" data-dismiss="modal">Add Exam</button>
    </div>
</div>
@endif
<div class = "row">
@for ($x = 0; $x < count($data["exams"]); $x++) 
        <div  class="col-md-3"style = "margin-top : 20px">
            <div class="tiles added-margin" style = "background-color : #1B1E24 ;">
                <div class="tiles-body">
                    <div class="tiles-title">
                        <div class= "row">
                            <div class = "col-md-offset-5">
                              <div class  = "fa fa-question-circle fa-3x"> </div>
                            </div>
                        </div>
                        <h4 style = "color : white ;">Exam name : <span class= "bold">{{$data["exams"][$x]["name"]}}</span> </h4>
                    </div>
                    <h4 style = "color : white ;">Max Score : <span class= "bold">{{$data["exams"][$x]["maxScore"]}}</span> </h4>
                    <h4 style = "color : white ;">Created by : <span class= "bold">{{$data["exams"][$x]["teacherEmail"]}}</span> </h4>                     
                    <br>
                    <div class= "row">
                        <div class = "col-md-offset-4">
                            <a  href="/exams/{{$data["exams"][$x]["id"]}}" style = "color:white; cursor: pointer;">Click to open</a>
                        </div>
                    </div>
                    @if(Session::get('cur_user')["userType"] == "admin" || Session::get('cur_user')["userType"] == "teacher")
                    <div class="row">
                        <div class="col-md-offset-10">
                            <i class="fa fa-cog" onclick='open_update_modal("{{$data["exams"][$x]["name"]}}" , "{{$data["exams"][$x]["maxScore"]}}" , "{{$data["exams"][$x]["id"]}}")' style="cursor: pointer;" data-toggle="modal" data-target="#update_exam_modal">&nbsp;</i>
                            <i class="fa fa-minus-circle" onclick='open_delete_modal("{{$data["exams"][$x]["id"]}}")' style="color:red; cursor: pointer;" data-toggle="modal" data-target="#delete_exam_modal"></i>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
@endfor
 </div>


    <div class="modal fade in" id="add_exam_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:None;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-question fa-7x"></i>
                    <h4 id="myModalLabel" class="semi-bold">Add new exam</h4>
                </div>
                <div class="modal-body">
                    <div class="row form-row">
                        <div class="col-md-12">
                            <input class="form-control" id="add_exam_name" placeholder="Exam name" type="text" required>
                        </div>
                    </div>
                    <div class="row form-row">
                        <div class="col-md-12">
                            <input type="text" id="add_exam_score"  placeholder="Max grade of exam" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" onclick="add_exam_action('{{Session::get('cur_user')['username']}}')" class="btn btn-primary" data-dismiss="modal">submit</button>
                    <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade in" id="update_exam_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:None;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-question fa-7x"></i>
                    <h4 id="myModalLabel" class="semi-bold">update exam</h4>
                </div>
                <div class="modal-body">
                    <div class="row form-row">
                        <div class="col-md-12">
                            <input class="form-control" id="update_exam_name" placeholder="Exam name" type="text" required>
                        </div>
                    </div>
                    <div class="row form-row">
                        <div class="col-md-12">
                            <input type="text" id="update_exam_score"  placeholder="Max grade of exam" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" onclick="update_exam_action('{{Session::get('cur_user')['username']}}')" class="btn btn-primary" data-dismiss="modal">submit</button>
                    <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade in" id="delete_exam_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:None;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-trash fa-5x"></i>
                    <h4 id="myModalLabel" class="semi-bold red">Delete this exam</h4>
                </div>
                <div class="modal-body">
                <div class="modal-footer ">
                    <button type="button" onclick="delete_exam_action()" class="btn btn-danger" data-dismiss="modal">submit</button>
                    <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

 @endsection
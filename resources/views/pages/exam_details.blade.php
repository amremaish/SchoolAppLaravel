@extends('layouts.app') @section('content')
<div class="semi-bold page-title">
    <h3>Exam&nbsp;/&nbsp;{{$data["exam_name"]}}</h3>
</div>
<div class = "row">
@for ($x = 0; $x < count($data["students"]); $x++) 
    <div  class="col-md-3" style = "margin-top : 20px">
        <div class="tiles added-margin" style = "background-color : #1B1E24 ;">
            <div class="tiles-body">
                <div class="tiles-title">
                    <div class= "row">
                        <div class = "col-md-offset-5">
                            <div class  = "fa fa-question-circle fa-3x"> </div>
                        </div>
                    </div>
                    <h4 style = "color : white ;">Exam name : <span class= "bold">{{$data["exam_name"]}}</span> </h4>
                </div>
                <h4 style = "color : white ;">Student name : <span class= "bold">{{$data["students"][$x]["username"]}}</span></h4>  
                <h4 style = "color : white ;">Score : <span class= "bold">{{$data["student_exams"][$x]["grade"]}}/{{$data["max_score"]}}</span> </h4>           
                @if(Session::get('cur_user')["userType"] == "admin" || Session::get('cur_user')["userType"] == "teacher")
                <div class= "row">
                    <div class = "col-md-offset-2">
                        <a  data-toggle="modal" onclick ='open_exam_details_modal("{{$data["student_exams"][$x]["grade"]}}" , "{{$data["students"][$x]["email"]}}" , "{{$data["exam_id"]}}")' data-target="#exam_details_modal"  style = "color:white; cursor: pointer;">Click to Update or set value</a>
                    </div>
                </div> 
                @endif
            </div>
        </div>
    </div>
@endfor
</div>



  
<div class="modal fade in" id="exam_details_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button"   class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <br>
                    <i class="fa fa-question fa-7x"></i>
                    <h4 id="myModalLabel" class="semi-bold">Set student grade</h4>
                </div>
                <div class="widget-item ">
                    <div class="tiles white ">
                        <div class="tiles-body">
                            <div class="row form-row">
                                <div class="col-md-12">
                                    <input class="form-control" id="exam_grade" placeholder="Set grade of this student " type="text" required>
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer ">
                        <button type="button" onclick ='add_student_grade("{{$data["max_score"]}}")' class="btn btn-primary" data-dismiss="modal">submit</button>
                        <button  type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endsection
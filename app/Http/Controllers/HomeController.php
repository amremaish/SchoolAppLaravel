<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Illuminate\Routing\Route;

class HomeController extends Controller
{
    public  const Accepted = "Accepted";
    public  const rejected = "Refused";
    public  const None = "None";

    public function logout(Request $request){
          $request->session()->put( "cur_user" , null);
          return redirect('/');
    }

    public function getMaterials(Request $request){
        $cur_user =  $request->session()->get("cur_user");
        if ($cur_user ==null){
            return redirect('/login');
        }

        $factory = ServiceAccount::fromJsonFile(__DIR__.'\FirebaseKey.json');
        $firebase =  (new Factory())->withServiceAccount($factory)->create();
        $database = $firebase->getDatabase();
        $ref = $database->getReference("Material"); 
        $ref1 = $database->getReference("users");
        $fire_users = $ref1->getValue();  
        $fire_mat = $ref->getValue();
        $materials = array();
        $users = array();
        if (is_array($fire_mat)){
        foreach($fire_mat as $key => $mat){
            if ($mat["status"] == HomeController::Accepted){
                array_push($materials,$mat);
                foreach($fire_users as $key1 => $user){
                    if ($mat["user_email"] == $user["email"] ){
                       array_push($users,$user);  
                       break;   
                    }
                }
            }
        }
    }

        return view('pages.material') ->with("data" , ['materials' =>  $materials , 'users' => $users ]) ;
  }


  public function Profile(Request $request){
        $cur_user =  $request->session()->get("cur_user");
        if ($cur_user ==null){
            return redirect('/login');
        }
        $factory = ServiceAccount::fromJsonFile(__DIR__.'\FirebaseKey.json');
        $firebase =  (new Factory())->withServiceAccount($factory)->create();
        $database = $firebase->getDatabase();
        $ref = $database->getReference("users"); 
        $fire_users = $ref->getValue();
        foreach($fire_users as $key => $user){
            if ( $user["email"] == $cur_user["email"] ){
                $request->session()->put( "cur_user" , $user);
            }
        }
    return view('pages.profile') ;
}



  public function getMaterialRequests(Request $request){
    $cur_user =  $request->session()->get("cur_user");
    if ($cur_user ==null){
        return redirect('/login');
    }

    $factory = ServiceAccount::fromJsonFile(__DIR__.'\FirebaseKey.json');
    $firebase =  (new Factory())->withServiceAccount($factory)->create();
    $database = $firebase->getDatabase();
    $ref = $database->getReference("Material"); 
    $ref1 = $database->getReference("users");
    $fire_users = $ref1->getValue();  
    $fire_mat = $ref->getValue();
    $materials = array();
    $users = array();
    if (is_array($fire_mat)){
    foreach($fire_mat as $key => $mat){
        if ($mat["status"] == HomeController::None){
            array_push($materials,$mat);
            foreach($fire_users as $key1 => $user){
                if ($mat["user_email"] == $user["email"] ){
                   array_push($users,$user);  
                   break;   
                }
            }
        }
    }
}

    return view('pages.material_requests') ->with("data" , ['materials' =>  $materials , 'users' => $users ]) ;
}


  public function getExams(Request $request){
    $cur_user =  $request->session()->get("cur_user");
    if ($cur_user ==null){
        return redirect('/login');
    }

    $factory = ServiceAccount::fromJsonFile(__DIR__.'\FirebaseKey.json');
    $firebase =  (new Factory())->withServiceAccount($factory)->create();
    $database = $firebase->getDatabase();
    $ref = $database->getReference("Exam"); 
    $fire_exams = $ref->getValue();
    $exams = array();
    if (is_array($fire_exams)){
        foreach($fire_exams as $key => $exam){
            array_push($exams,$exam);
        }
    }

    return view('pages.exams') ->with("data" , ['exams' =>  $exams ]) ;
}

public function getExamDetails(Request $request){
    $cur_user =  $request->session()->get("cur_user");
    if ($cur_user ==null){
        return redirect('/login');
    }

    $exam_id = request()->route('id');
    $factory = ServiceAccount::fromJsonFile(__DIR__.'\FirebaseKey.json');
    $firebase =  (new Factory())->withServiceAccount($factory)->create();
    $database = $firebase->getDatabase();
    $ref1 = $database->getReference("Exam");
    $fire_exams = $ref1->getValue();  
    $ref2 = $database->getReference("Student_exams");
    $student_exams = $ref2->getValue();  
    $ref = $database->getReference("users");
    $fire_users = $ref->getValue();  
    $users = array();
    $student_exam = array();
    if (is_array($fire_users)){
        if ($cur_user["userType"] != "student"){
            foreach($fire_users as $key => $user){
                    if ($user["userType"] =="student"){
                        array_push($users,$user);  
                        $found = 0 ;
                        foreach($student_exams as $key => $se){
                            if ($exam_id == $se["exam_id"] && $user["email"] == $se["student_email"]){
                                array_push($student_exam,$se); 
                                $found = 1 ; 
                            }
                        }
                        if ($found == 0){
                            $empty_se = array(
                                "grade" => "?",
                                "student_email" => "?",
                            );
                            array_push($student_exam,$empty_se); 
                        }

                    }
                }
        }else {
            $found = 0 ;
            array_push($users,$cur_user);  
            foreach($student_exams as $key => $se){
                if ($exam_id == $se["exam_id"] && $cur_user["email"] == $se["student_email"]){
                    array_push($student_exam,$se); 
                    $found = 1 ; 
                }
            }
            if ($found == 0){
                $empty_se = array(
                    "grade" => "?",
                    "student_email" => "?",
                );
                array_push($student_exam,$empty_se); 
            }
        }

    }
    if (is_array($fire_exams)){
        foreach($fire_exams as $key => $exam){
            if ($exam["id"] = $exam_id){
                $exam_name = $exam["name"] ;
                $max_score = $exam["maxScore"] ;
                
            }
        }
    }
    return view('pages.exam_details') ->with("data" , ['students' =>  $users , 'student_exams' => $student_exam , 'exam_id' =>  $exam_id   , 'exam_name' =>  $exam_name, 'max_score' =>  $max_score]) ;
}


}

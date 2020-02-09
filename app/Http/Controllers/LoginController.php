<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use app\Http\Controllers\LoginController ;
use App\src\Firebase;
use App\src\FirebaseConstant;
class LoginController extends Controller
{
    public function login(Request $request){
         $cur_user =  $request->session()->get("cur_user");
        if ($cur_user !=null){
            return redirect('/material');
        }
        if ($request->isMethod('post')) {
            $email = $request->input('login_email');
            $pass = $request->input('login_pass');
            $factory = ServiceAccount::fromJsonFile(__DIR__.'\FirebaseKey.json');
            $firebase =  (new Factory())->withServiceAccount($factory)->create();
            $database = $firebase->getDatabase();
            $ref = $database->getReference("users");
            $values = $ref->getValue();
            $found = false ;
            foreach($values as $key => $data1){
                if ($data1["email"] == $email &&  $data1["pass"] ==$pass ){
                    $found  = true ;
                    $request->session()->put( "cur_user" , $data1);
                    $cur_user = $data1 ;
                }
            }
            if ($found){
                return redirect('/material');
            }else{
                  return view('pages.login') -> with ('correct' , "not_hide" ); 
            }
    }else {
           return view('pages.login') -> with ('correct' ,'hide');
        }
    }
}

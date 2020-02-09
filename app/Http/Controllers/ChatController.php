<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Illuminate\Routing\Route;


class ChatController extends Controller
{

    public function loadAllContacts(Request $request){
        $cur_user =  $request->session()->get("cur_user");
        if ($cur_user ==null){
            return redirect('/login');
        }
        $factory = ServiceAccount::fromJsonFile(__DIR__.'\FirebaseKey.json');
        $firebase =  (new Factory())->withServiceAccount($factory)->create();
        $database = $firebase->getDatabase();
        $ref1 = $database->getReference("Messages");
        $fire_Messages = $ref1->getValue();  
        $ref2 = $database->getReference("users");
        $fire_users = $ref2->getValue();  
        $messages = array();
        $rec_users = array();
        $send_users = array();
        if (is_array($fire_Messages)){
            foreach($fire_Messages as $key => $msg){
                array_push($messages,$msg);  
                foreach($fire_users as $key => $user){
                    if ($user["email"] == $msg["receivedEmail"]){
                        array_push($rec_users,$user);   
                    }
                    if ($user["email"] == $msg["sendEmail"]){
                        array_push($rec_users,$user);   
                    }
                }

            }
        }
            $chat_users = array();
            foreach($fire_users as $key => $user){
                if ($cur_user["email"] == $user["email"] ){
                    continue ;
                }
                if ($cur_user["userType"] == "admin"){
                    array_push($chat_users,$user);   
                }else if ($cur_user["userType"] == "teacher"){
                    array_push($chat_users,$user);  
                }else if ($cur_user["userType"] == "student" && $user["userType"] != "parent"){
                    array_push($chat_users,$user);
                }else if ($cur_user["userType"] == "parent" && $user["userType"] != "student" ){
                    array_push($chat_users,$user); 
                }
            }
        
        return view('pages.chat') ->with("data" , ['messages'=> $messages , 'send_users'=> $send_users, 'rec_users'=> $rec_users  ,'chat_users' =>  $chat_users]);
    }
}

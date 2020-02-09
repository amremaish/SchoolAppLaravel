var cur_exam_name , cur_exam_grade , cur_exam_id ;


function open_update_modal(cur_exam_name , cur_exam_grade , cur_exam_id){
    this.cur_exam_name = cur_exam_name ;
    this.cur_exam_grade = cur_exam_grade ;
    this.cur_exam_id = cur_exam_id ;
    document.getElementById("update_exam_name").value  = cur_exam_name;
    document.getElementById("update_exam_score").value = cur_exam_grade;
    $("#update_exam_modal").css("display" , "block");
}

function open_delete_modal(cur_exam_id){
    this.cur_exam_id = cur_exam_id ;
    $("#delete_exam_modal").css("display" , "block");
}

function delete_exam_action(){
    $('#loading_modal').modal('show');
    var rootRef = firebase.database().ref();
    var urlRef = rootRef.child("Exam");
    urlRef.once("value", function(snapshot) {
      snapshot.forEach(function(child) {
        if(child.val()["id"] == cur_exam_id){
            firebase.database().ref("Exam/" + child.key).remove();
            location.reload();
            $('#loading_modal').modal('hide');
            alert("successfully Deleted .");
        }
      });
    });
}



function update_exam_action(cur_user_name){
    var update_exam_name =  document.getElementById("update_exam_name").value ;
    var update_exam_score =  document.getElementById("update_exam_score").value ;
    if (update_exam_name ==""){
        alert("please write the exam name.");
        return ;
    }else if (update_exam_score ==""){
        alert("please write the exam score.");
        return ;  
    }else if (isNaN(update_exam_score)){
        alert("please write the exam as a number.");
        return ;  
    }
    $('#loading_modal').modal('show');
    var rootRef = firebase.database().ref();
    var urlRef = rootRef.child("Exam");
    urlRef.once("value", function(snapshot) {
      snapshot.forEach(function(child) {
        if(child.val()["id"] == cur_exam_id){
            firebase.database().ref("Exam/" + child.key).set({
               id: cur_exam_id,
               maxScore: update_exam_score,
               name: update_exam_name,
               teacherEmail: cur_user_name,
            });
            location.reload();
            $('#loading_modal').modal('hide');
            alert("successfully Updated .");
        }
      });
    });



}


function add_exam_action(cur_user_name){
    var add_exam_name =  document.getElementById("add_exam_name").value ;
    var add_exam_score =  document.getElementById("add_exam_score").value ;
  
    if (add_exam_name ==""){
        alert("please write the exam name.");
        return ;
    }else if (add_exam_score ==""){
        alert("please write the exam score.");
        return ;  
    }else if (isNaN(add_exam_score)){
        alert("please write the exam as a number.");
        return ;  
    }

    $('#loading_modal').modal('show');
    var rootRef = firebase.database().ref();
    var storesRef = rootRef.child('Exam');
    var newStoreRef = storesRef.push();
    newStoreRef.set({
        id: makeid(),
        maxScore: add_exam_score,
        name: add_exam_name, 
        teacherEmail: cur_user_name,
    });
    $('#loading_modal').modal('hide');
    alert("successfully added .");
    location.reload();
}




function makeid() {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < 12; i++ ) {
       result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
 }


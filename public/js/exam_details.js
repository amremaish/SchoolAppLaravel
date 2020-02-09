var cur_student_email ,cur_exam_id , cur_grade  ;


function open_exam_details_modal(grade , cur_student_email , cur_exam_id){
    $("#exam_details_modal").css("display" , "block");
    this.cur_student_email = cur_student_email ;
    this.cur_exam_id = cur_exam_id ;
    this.cur_grade = grade ;
    if (grade != "?"){
        document.getElementById("exam_grade").value =  grade ; 
    }
}
function add_student_grade(max_score){
    //update
    var exam_grade =  document.getElementById("exam_grade").value ;
    if (exam_grade == ""){
        alert("please write the student grade.");
        return ;
      }

    if (isNaN(exam_grade)){
        alert("please make sure the grade has only numbers");
        return ;
    }

    
    if (parseInt(max_score) < exam_grade){
        alert("must student grade lower than exam grade");
        return ;
    }
      $('#loading_modal').modal('show');
    if (cur_grade != "?"){
        var rootRef = firebase.database().ref();
        var urlRef = rootRef.child("Student_exams");
        urlRef.once("value", function(snapshot) {
          snapshot.forEach(function(child) {
            if(child.val()["exam_id"] == cur_exam_id){
                firebase.database().ref("Student_exams/" + child.key).set({
                    exam_id: cur_exam_id,
                    grade: exam_grade,
                    student_email: cur_student_email,
                });
                location.reload();
                $('#loading_modal').modal('hide');
                alert("successfully Updated .");
            }
          });
        });

        return ;
    }
    // add new 
  
    var rootRef = firebase.database().ref();
    var storesRef = rootRef.child('Student_exams');
    var newStoreRef = storesRef.push();
    newStoreRef.set({
        exam_id: cur_exam_id,
        grade: exam_grade,
        student_email: cur_student_email,
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




function upload() {

    var reg_email=document.getElementById("reg_email").value;
    var reg_pass =document.getElementById("reg_pass").value;
    var reg_username =document.getElementById("reg_username").value;
    var reg_con_pass =document.getElementById("reg_con_pass").value;
    var reg_age =document.getElementById("reg_age").value;
    var reg_phone_num = document.getElementById("reg_phone_num").value;
    var teacher_radio = document.getElementById("teacher_radio").checked;
    var parent_radio = document.getElementById("parent_radio").checked;
    var student_radio = document.getElementById("student_radio").checked;
    var image=document.getElementById("profImg").files[0];  
    var userType ;

    if (teacher_radio){
        userType = "teacher";
    }else if (parent_radio){
        userType = "parent";
    }
    else if (student_radio){
        userType = "student";
    }else{
        $('#error_reg').removeClass('hide');
        $('#error_reg').text('Check user type.');
    }

    // validation

    if (reg_email == ""  || !validateEmail(reg_email)){
        $('#error_reg').removeClass('hide');
        $('#error_reg').text('Check email is not correct.');
        return ;
    }else if (reg_username ==""){
        $('#error_reg').removeClass('hide');
        $('#error_reg').text('Check username is empty.');
        return ;
    }else if (reg_pass ==""){
        $('#error_reg').removeClass('hide');
        $('#error_reg').text('Check pass is empty.');
        return ;
    }else if (reg_pass !=reg_con_pass ){
        $('#error_reg').removeClass('hide');
        $('#error_reg').text('password and confirm password are not equal.');
        return ;
    }else if (reg_age =="" || !isNumeric(reg_age)){
        $('#error_reg').removeClass('hide');
        $('#error_reg').text('Check age is not correct.');
        return ;
    }else if (reg_phone_num ==""){
        $('#error_reg').removeClass('hide');
        $('#error_reg').text('Check phone number is empty.');
        return ;
    }else if (image == null){
        $('#error_reg').removeClass('hide');
        $('#error_reg').text('Please select a profile image.');
        return ;
    }else if (reg_pass.length < 6){
        $('#error_reg').removeClass('hide');
        $('#error_reg').text('Please choose password greater than 6.');
        return ;
    }



    $('#loading_modal').modal('show');
    // firebase auth
    firebase.auth().createUserWithEmailAndPassword(reg_email, reg_pass).catch(function(error) {
    // Handle Errors here.
    var errorCode = error.code;
    var errorMessage = error.message;
    if (errorCode == 'auth/weak-password') {
        alert(errorMessage);
        window.location.pathname = '/login'
        return ;
    } else {
        $('#error_reg').text(errorMessage);
        alert(errorMessage);
        window.location.pathname = '/login'
        return ;
    }
    });

    var storageRef=firebase.storage().ref( reg_email+'/profile_pic');
    //upload image to selected storage reference
    var uploadTask=storageRef.put(image);
    uploadTask.on('state_changed',function (snapshot) {
        //observe state change events such as progress , pause ,resume
        //get task progress by including the number of bytes uploaded and total
        //number of bytes
        var progress=(snapshot.bytesTransferred/snapshot.totalBytes)*100;
        console.log("upload is " + progress +" done");
    },function (error) {
        //handle error here
        console.log(error.message);
    },function () {
       //handle successful uploads on complete

        uploadTask.snapshot.ref.getDownloadURL().then(function (downlaodURL) {
            
              firebase.database().ref('users/' + firebase.auth().currentUser.uid).set({
                email: reg_email,
                pass: reg_pass,
                age: reg_age,
                phone_number: reg_phone_num,
                imagePath: downlaodURL,
                userType: userType,
                username: reg_username
            });
            $('#loading_modal').modal('hide');
            alert("successfully signed up . ");
            document.getElementById("reg_email").value ="";
            document.getElementById("reg_pass").value="";
            document.getElementById("reg_username").value="";
            document.getElementById("reg_con_pass").value="";
            document.getElementById("reg_age").value="";
            document.getElementById("reg_phone_num").value="";
        });
    });
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function isNumeric(num){
    return !isNaN(num)
  }

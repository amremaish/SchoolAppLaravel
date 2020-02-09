function showProfileImage(imgPath){
    console.log(imgPath);
    $("#profile_img_modal").attr("src", imgPath );
}

function submit_profile(){
    var  pro_username = document.getElementById("pro_username").value ;
    var  pro_email =document.getElementById("pro_email").value ; 
    var  pro_con_pass =document.getElementById("pro_con_pass").value  ; 
    var  pro_pass = document.getElementById("pro_pass").value  ; 
    var  pro_phone_num = document.getElementById("pro_phone_num").value  ; 
    var  pro_age = document.getElementById("pro_age").value ; 
    var image = document.getElementById("profImg").files[0];  


    if (pro_username == ""){
        Messenger().post("please write your username");
        return ;
      }else if ( pro_pass == "" || pro_pass != pro_con_pass ){
        Messenger().post("Password and passwrod and confirm password isn't equal");
        return ;
      }else if ( pro_phone_num == "" ){
        Messenger().post("please write your phone number");
        return ;
      }else if ( pro_age == "" ){
        Messenger().post("please write your age");
        return ;
      }

      $('#loading_modal').modal('show');
      if ( image == null){
        var rootRef = firebase.database().ref();
        var urlRef = rootRef.child("users");
        urlRef.once("value", function(snapshot) {
        snapshot.forEach(function(child) {
            
            if (child.val()["email"] == pro_email){
                console.log(pro_age);
                firebase.database().ref('users/' +child.key).update({
                    email: pro_email,
                    pass: pro_pass,
                    age: pro_age,
                    phone_number: pro_phone_num,
                    userType: child.val()["userType"] ,
                    username: pro_username
                });
            }
          });
        });
        $('#loading_modal').modal('hide');
        alert("successfully Updated .");
        window.location.pathname = '/profile'
        return ;
      }



      firebase.storage().ref( pro_email+'/profile_pic').delete();
      var storageRef=firebase.storage().ref( pro_email+'/profile_pic');
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
            var rootRef = firebase.database().ref();
            var urlRef = rootRef.child("users");
            urlRef.once("value", function(snapshot) {
            snapshot.forEach(function(child) {
                if (child.val()["email"] == pro_email){
                    firebase.database().ref('users/' +child.key).update({
                        email: pro_email,
                        pass: pro_pass,
                        age: pro_age,
                        phone_number: pro_phone_num,
                        imagePath: downlaodURL,
                        userType: child.val()["userType"] ,
                        username: pro_username
                    });

                    $('#loading_modal').modal('hide');
                    alert("successfully Updated .");
                    window.location.pathname = '/profile'
                }
              });
            });
     

          });
      });

}
function showMaterial(id) {
    $("#mat_img_modal").attr("src",$('#material_img_'+id).prop('src'));
 
  }
  function close_view_modal(){
    $("#material_modal").css("display" , "none");
  }

    function close_add_modal(){
    $("#add_material_modal").css("display" , "none");
  }

  function show_add_material_modal(){
    $("#add_material_modal").css("display" , "block");
  }

  function close_update_modal(){
    $("#update_material_modal").css("display" , "none");
  }

  function close_delete_modal(){
    $("#delete_material_modal").css("display" , "none");
  }


  
  function show_update_material_modal(id){
    $("#update_material_modal").css("display" , "block");
    $("#cur_mat").text(id);

    var rootRef = firebase.database().ref();
    var urlRef = rootRef.child("Material");
    urlRef.once("value", function(snapshot) {
      snapshot.forEach(function(child) {
        if(child.val()["id"] == id){
          document.getElementById("update_mat_title").value =  child.val()["title"]
          document.getElementById("update_mat_desc").value =  child.val()["desc"] ; 
        }
      });
    });
  }


  function show_delete_material_modal(id){
    $("#delete_material_modal").css("display" , "block");
    $("#cur_mat").text(id);
 }

  function add_mat_action(user_email){
    var add_mat_title=document.getElementById("add_mat_title").value;
    var add_mat_desc =document.getElementById("add_mat_desc").value;
    var image = document.getElementById("material_img").files[0];  

    if (add_mat_title == ""){
      alert("please write the title");
      return ;
    }else if ( add_mat_desc == ""){
      alert("please write the Description.");
      return ;
    }else if ( image == null){
      alert("please select the material Image.");
      return ;
    }
    $('#loading_modal').modal('show');
    const None = "None";
    var id  = makeid() ;
    var storageRef=firebase.storage().ref( user_email+'/'+id);
    //upload image to selected storage reference
    var uploadTask=storageRef.put(image);
    uploadTask.on('state_changed',function (snapshot) {
        },function (error) {
            //handle error here
            console.log(error.message);
        },function () {
       //handle successful uploads on complete
        uploadTask.snapshot.ref.getDownloadURL().then(function (downlaodURL) {
                var rootRef = firebase.database().ref();
                var storesRef = rootRef.child('Material');
                var newStoreRef = storesRef.push();
                newStoreRef.set({
                desc: add_mat_desc,
                id: id,
                imgPath: downlaodURL,
                status: None,
                title: add_mat_title,
                user_email: user_email,
            });
            $("#add_material_modal").css("display" , "none");
            $('#loading_modal').modal('hide');
            alert("successfully added please wait the admin .");
            window.location.pathname = '/material'
        });
    });
}


function update_mat_action(user_email){
  var mat_id =  $("#cur_mat").text();
  var update_mat_title =document.getElementById("update_mat_title").value;
  var update_mat_desc =document.getElementById("update_mat_desc").value;
  var image = document.getElementById("update_material_img").files[0];  

  if (update_mat_title == ""){
    alert("please write the title");
    return ;
  }else if ( update_mat_desc == ""){
    alert("please write the Description.");
    return ;
  }
  $('#loading_modal').modal('show');
  const Accepted = "Accepted";

  if (image == null){ 
    var rootRef = firebase.database().ref();
    var urlRef = rootRef.child("Material");
    urlRef.once("value", function(snapshot) {
      snapshot.forEach(function(child) {
        if(child.val()["id"] == mat_id){
            firebase.database().ref("Material/" + child.key).set({
            desc: update_mat_desc,
            id: mat_id,
            imgPath: child.val()["imgPath"] ,
            status: Accepted,
            title: update_mat_title,
            user_email: user_email,
        });
        after_update_material();

        }
      });
    });
    return ;
  }

  var id  = makeid() ;
  var storageRef=firebase.storage().ref( user_email +'/'+id);
  //upload image to selected storage reference
  var uploadTask=storageRef.put(image);

  uploadTask.on('state_changed',function (snapshot) {
      },function (error) {
          //handle error here
          console.log(error.message);
      },function () {
     //handle successful uploads on complete
      uploadTask.snapshot.ref.getDownloadURL().then(function (downlaodURL) { 
        var rootRef = firebase.database().ref();
        var urlRef = rootRef.child("Material");
        urlRef.once("value", function(snapshot) {
          snapshot.forEach(function(child) {
            if(child.val()["id"] == mat_id){
                firebase.database().ref("Material/" + child.key).set({
                desc: update_mat_desc,
                id: mat_id,
                imgPath: downlaodURL ,
                status: Accepted,
                title: update_mat_title,
                user_email: user_email,
            });
            after_update_material();
    
            }
          });
        });

      });
  });
}


function delete_mat_action(){
    var mat_id =  $("#cur_mat").text();
    $('#loading_modal').modal('show');
    var rootRef = firebase.database().ref();
    var urlRef = rootRef.child("Material");
    urlRef.once("value", function(snapshot) {
      snapshot.forEach(function(child) {
        if(child.val()["id"] == mat_id){
            firebase.database().ref("Material/" + child.key).remove();
            $("#udelete_material_modal").css("display" , "none");
            $('#loading_modal').modal('hide');
            alert("successfully Deleted .");
            window.location.pathname = '/material'
        }
      });
    });

}

function after_update_material(){
  $("#update_material_modal").css("display" , "none");
  $('#loading_modal').modal('hide');
  alert("successfully Updated .");
  window.location.pathname = '/material'
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
 

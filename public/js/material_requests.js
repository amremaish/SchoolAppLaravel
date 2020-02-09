function sendStatus(id , status){
    $('#loading_modal').modal('show');
    var rootRef = firebase.database().ref();
	var urlRef = rootRef.child("Material");
	urlRef.once("value", function(snapshot) {
	snapshot.forEach(function(child) {
		if(child.val()["id"] == id ){
			firebase.database().ref("Material/" + child.key).update({
				status: status,
            });
            $('#loading_modal').modal('hide');
            alert("successfully " + status);
            window.location.pathname = '/mat_requests'
        }  

	});
    });

}

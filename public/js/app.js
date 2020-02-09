// notification message
var  cur_email ;
//--------------------------------------------------------
cur_email = $("#cur_email").text();
var ref = firebase.database().ref("Messages");
firebase.database().ref().on('value', function(snapshot) {
	$("#msg_list").empty();
	var rootRef = firebase.database().ref();
	var urlRef = rootRef.child("Messages");
	urlRef.once("value", function(snapshot) {
	snapshot.forEach(function(child) {
		if (child.val()["receivedEmail"] == cur_email && child.val()["seenFromReceiver"]  == "false"){
            Messenger().post("You have got Message from " + child.val()["send_user_name"] +" ." );
            $("#notifi_counter").text(counter);
            $("#notifi_counter").removeClass("hide");
            firebase.database().ref("Messages/" + child.key).update({
				seenFromReceiver: "true",
			});
		}

    });
	});

});

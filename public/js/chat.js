
var  cur_email , open_email ,OpenedImg , Opend_name , cur_name ;
$(".messages").animate({ scrollTop: $(document).height() }, "fast");

//--------------------------------------------------------
$("#msg_list").empty();
cur_email = $("#cur_email").text();

var ref = firebase.database().ref("Messages");
firebase.database().ref().on('value', function(snapshot) {
	$("#msg_list").empty();
	var rootRef = firebase.database().ref();
	var urlRef = rootRef.child("Messages");
	urlRef.once("value", function(snapshot) {
	snapshot.forEach(function(child) {
		if(open_email != null &&child.val()["receivedEmail"] == cur_email && child.val()["sendEmail"] == open_email ){
			newMessageReceive(OpenedImg ,child.val()["messageText"] );
			firebase.database().ref("Messages/" + child.key).update({
				seenFromReceiver: "true",
			});

		}
		if( open_email != null && child.val()["receivedEmail"] == open_email && child.val()["sendEmail"] == cur_email ){
			newMessageSent(child.val()["messageText"]);
		}
		if (child.val()["receivedEmail"] == cur_email && child.val()["seenFromReceiver"]  == "false" && child.val()["sendEmail"] != open_email){	
			Messenger().post("You have got Message from " + child.val()["send_user_name"] +" ." );
			firebase.database().ref("Messages/" + child.key).update({
				seenFromReceiver: "true",
			});
		}

	});
	});

});

$(".contact").click(function() {
	$(".contact").removeClass("active");
	$(this).addClass("active");
  });

function openChat(cur_email , open_email ,OpenedImg , Opend_name , cur_name){
	this.open_email = open_email;
	this.cur_email = cur_email;
	this.Opend_name = Opend_name;
	this.cur_name = cur_name;
	this.OpenedImg = OpenedImg;

	$("#opend_img").attr("src",OpenedImg);
	$("#opend_name").text(Opend_name);
	$("#msg_list").empty();
	var rootRef = firebase.database().ref();
	var urlRef = rootRef.child("Messages");
	urlRef.once("value", function(snapshot) {
	snapshot.forEach(function(child) {
		if(child.val()["receivedEmail"] == cur_email && child.val()["sendEmail"] == open_email ){
			newMessageReceive(OpenedImg ,child.val()["messageText"] );
			firebase.database().ref("Messages/" + child.key).update({
				seenFromReceiver: "true",
			});
		}
		if(child.val()["receivedEmail"] == open_email && child.val()["sendEmail"] == cur_email ){
			newMessageSent(child.val()["messageText"]);
		}
	});
	});
}

function addMsgToFirebase(msg){
	if($.trim(message) == '' || open_email == null) {
		return false;
	}
	var today = new Date();
	var rootRef = firebase.database().ref();
    var storesRef = rootRef.child('Messages');
    var newStoreRef = storesRef.push();
    newStoreRef.set({
        messageText: msg,
        messageTime: today,
		receivedEmail: open_email,
		received_user_name: Opend_name,
		seenFromReceiver: "false",
		seenFromSender: "true",
		sendEmail: cur_email,
		send_user_name: cur_name,
    });
}


function newMessageSent(msg) {
	if($.trim(msg) == '' || open_email == null) {
		return false;
	}
	$('<li class="replies"><p style = "background-color:#32465a;color:#F5F5F5" >' + msg + '</p></li>').appendTo($('.messages ul'));
	$('.message-input input').val(null);
	$('.contact.active .preview').html('<span>You: </span>' + msg);
	$(".messages").animate({ scrollTop: $(document).height() }, "fast");
};

function newMessageReceive(imgPath,msg) {
	if($.trim(msg) == ''|| open_email == null) {
		return ;
	}
	$('<li class="sent"><img src="'+imgPath+'" alt="" /><p style = "background-color:#F5F5F5;color:#32465a" >' + msg + '</p></li>').appendTo($('.messages ul'));
	$('.message-input input').val(null);
	$('.contact.active .preview').html('<span>You: </span>' + msg);
	$(".messages").animate({ scrollTop: $(document).height() }, "fast");
};


$('.submit').click(function() {
	message = $(".message-input input").val();
	addMsgToFirebase(message);

});

$(window).on('keydown', function(e) {
  if (e.which == 13) {
	message = $(".message-input input").val();
	addMsgToFirebase(message);
    return false;
  }
});


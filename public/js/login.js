$(document).ready(function() {		

	$('#tab_btn_login').click(function(){
        $('#tab_register').removeClass('active');
        $('#tab_login').addClass('active');
	})
    $('#tab_btn_register').click(function(){
        $('#tab_register').addClass('active');
        $('#tab_login').removeClass('active');
	})

	
});
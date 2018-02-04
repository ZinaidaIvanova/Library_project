$("#reg_btn").click(function() {
    var login = $("#login").val();
    var email = $("#email").val();
    var pass = $("#pass").val();
    var passReapit = $("#passReapit").val();
    if (pass == passReapit) {
   	    var data = {"login": login, "email": email, "pass": pass};
   	    $.post("/library/reghandler.php", data, regResponse, "json");
    } else {
        $("#reg_info").html("Пароли не совпадают");
    	$("#reg_info").css("display","block");
    }
    return false;
});

function regResponse(response) {
	if (response.success){
        window.location = 'http://localhost/library/profile.php';
    } else if (response.error) {
		$("#reg_info").html(response.error);
	} else {
		$("#reg_info").html("Ошибка передачи данных");
	}
	$("#reg_info").css("display","block");
}
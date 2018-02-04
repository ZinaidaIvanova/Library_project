$("#auth_btn").click(function() {
    event.preventDefault();
    var login = $("#login").val();
    var pass = $("#pass").val();
 	var data = {"login": login, "pass": pass};
   	$.post("/library/auth.php", data, authResponse, "json");
});

function authResponse(response) {
	if (response.success){
        if (response.rights == 'user') {
            window.location = 'http://localhost/library/profile.php';
        } else if (response.rights == 'admin') {
            window.location = 'http://localhost/library/administrator.php';
        } 
    } else { 
        if (response.error) {
		     $("#reg_info").html(response.error);
        } else {
		$("#reg_info").html("Ошибка передачи данных");
        }
        $("#reg_info").css("display","block");
	}
}
$("#login_insert").change(function() {
	var login = $("#login_insert").val();
	$("#user_insert_form").children("input").val("");
	$("#login_insert").val(login);
    $("#user_insert_info").removeAttr("class");
    $("#user_insert_info").html("");
});

$("#user_insert_btn").click(function() {
	var login = $("#login_insert").val();
	var email = $("#email_insert").val();
	var pass = $("#pass_insert").val();
	var data = {"login": login, "email": email, "pass": pass};
	$.post("/library/user_insert.php", data, onUserAddResponse, "json");
	return false;
});

function onUserAddResponse(response) {
	if (response.success) {
		$("#user_insert_info").html(response.success);
		$("#user_insert_info").addClass("hidden_info_success");
	} else {
		$("#user_insert_info").addClass("hidden_info_error");
		if (response.error) {
			$("#user_insert_info").html(response.error);
		} else {
			$("#user_insert_info").html("Ошибка передачи данных");
		}
	}
}
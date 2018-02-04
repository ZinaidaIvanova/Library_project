$("#old_login_edit").change(function() {
	var login = $("#old_login_edit").val();
	$("#user_edit_form").children("input").val("");
	$("#old_login_edit").val(login);
	$("#user_edit_info").removeAttr("class");
	$("#user_edit_info").html("");
});

$("#user_edit_btn").click(function() {
	var old_login = $("#old_login_edit").val();
	var new_login = $("#new_login_edit").val();
	var new_email = $("#new_email_edit").val();
	var new_pass = $("#new_pass_edit").val();
	var data = {"old_login": old_login, "new_login": new_login, "new_email": new_email, "new_pass": new_pass};
	$.post("/library/user_edit.php", data, onUserEditResponse, "json");
	return false;
});

function onUserEditResponse(response) {
	if (response.success) {
		$("#user_edit_info").html(response.success);
		$("#user_edit_info").addClass("hidden_info_success");
	} else {
		$("#user_edit_info").addClass("hidden_info_error");
		if (response.error) {
			$("#user_edit_info").html(response.error);
		} else {
			$("#user_edit_info").html("Ошибка передачи данных");
		}
	}
}
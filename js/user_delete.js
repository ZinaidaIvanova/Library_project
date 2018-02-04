$("#login_delete").change(function() {
	$("#user_delete_info").removeAttr("class");
	$("#user_delete_info").html("");
});

$("#user_delete_btn").click(function() {
	var login = $("#login_delete").val();
	var data = {"login": login};
	$.post("/library/user_delete.php", data, onUserDeleteResponse, "json");
	return false;
});

function onUserDeleteResponse(response) {
	if (response.success) {
		$("#user_delete_info").html(response.success);
		$("#user_delete_info").addClass("hidden_info_success");
	} else {
		$("#user_delete_info").addClass("hidden_info_error");
		if (response.error) {
			$("#user_delete_info").html(response.error);
		} else {
			$("#user_delete_info").html("Ошибка передачи данных");
		}
	}
}
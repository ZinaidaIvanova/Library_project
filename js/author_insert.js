$("#author_insert").change(function() {
  $("#author_insert_info").removeAttr("class");
  $("#author_insert_info").html("");	
});

$("#author_insert_btn").click(function(){
  var author = $("#author_insert").val();
  var data = {"author": author};
  console.log(data);
  $.post("/library/author_insert.php", data, onAddAuthorResponse, "json");
  return false;
});

function onAddAuthorResponse(response) {
	if (response.success) {
		$("#author_insert_info").html(response.success);
		$("#author_insert_info").addClass("hidden_info_success");
	} else {
		$("#author_insert_info").addClass("hidden_info_error");
		if (response.error) {
			$("#author_insert_info").html(response.error);
		} else {
			$("#author_insert_info").html("Ошибка передачи данных");
		}
	}
}
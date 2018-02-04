function currDate() {
	var date = new Date();
	var dd = date.getDate();
    if (dd < 10) {
    	dd = '0' + dd;
    }
    var mm = date.getMonth() + 1;
    if (mm < 10) {
    	mm = '0' + mm;
    }
    var yy = date.getFullYear();
    //alert(yy + '-' + mm + '-' + dd); 
    return yy + '-' + mm + '-' + dd;
}


$("#send_comment_btn").click(function() {
	var mark = $("#mark").val();
	var comment_text = $("#comment_text").val();
	var book_id = $("#book_id").val();
	var user_id = $("#user_id").val();
	var login = $("#login").val();
	var data = {"mark": mark, "comment_text": comment_text, "book_id": book_id, "user_id": user_id};
	$.post("/library/comment_handler.php", data, commentResponse, "json");
	return false;
})

function commentResponse(response) {
	if (response.success) {
     console.log(response.avg);
     $("#avg").html('');
     $("#avg").html(response.avg);
     $("#comment_info").html(response.success);
     $("#comment_info").addClass("hidden_info_success");
     $("#new_comment_login").html($("#login").val());
     $("#new_comment_mark").html("Оценка " + $("#mark").val() + " из 10");
     $("#new_comment_text").html($("#comment_text").val());
     	var com_date = currDate();
      console.log(com_date);
     $("#new_comment_date").html(currDate());
     $("#new_comment").css("display","block");
     $(".info").css("display", "none");
  } else if (response.error) {
   	 $("#comment_info").html(response.error);
     $("#comment_info").addClass("hidden_info_error");
  } else {
   	 $("#comment_info").html("Ошибка передачи данных");
     $("#comment_info").addClass("hidden_info_error");
  }
}
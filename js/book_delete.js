$("#author_delete").change(function() {
  var author = $("#author_delete").val();
  $("#book_delete_form").children("input").val("");
  $("#author_delete").val(author);
  var data = {"author": author};
  $.post("/library/book_list.php", data, onLoadBookList, "json");
  $("#book_delete_form").children("input").removeAttr("disabled");
  $("#book_delete_info").removeAttr("class");
  $("#book_delete_info").html(""); 
});

function onLoadBookList(response) {
  console.log(response);
  $("#books").empty();
  for (var i = 0; i < response.length; i++) {
    var newElem = document.createElement('option');
    newElem.innerHTML = response[i];
    console.log(newElem);
    $("#books").append(newElem);  
  }
}

$("#book_delete_btn").click(function() {
	var author = $("#author_delete").val();
	var title = $("#title_delete").val();
	var data = {"author": author, "title": title};
	$.post("/library/book_delete.php", data, onDeleteBookResponse, "json");
	return false;
})

function onDeleteBookResponse(response) {
    console.log(response);
   if (response.success) {
     $("#book_delete_info").html(response.success);
     $("#book_delete_info").addClass("hidden_info_success");
   } else if (response.error) {
   	 $("#book_delete_info").html(response.error);
     $("#book_delete_info").addClass("hidden_info_error");
   } else {
   	 $("#book_delete_info").html("Ошибка передачи данных");
     $("#book_delete_info").addClass("hidden_info_error");
   }  
}
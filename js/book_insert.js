$("#authorInsertBook").change(function() {
  var author = $("#authorInsertBook").val();
  $("#insert_book_form").children("input").val("");
  $("#insert_book_form").children("textarea").val("");  
  $("#authorInsertBook").val(author);
  $("#book_insert_info").removeAttr("class");
  $("#book_insert_info").html("");
});

$("#book_insert_btn").click(function() { 
	var author = $("#authorInsertBook").val();
	var title = $("#titleInsert").val();
	var genre = $("#genreInsert").val();
	var isbn = $("#isbnInsert").val();
	var description = $("#descriptionInsert").val();	
  var data = {"author": author, "title": title, "genre": genre, "isbn": isbn, "description":description};
	console.log(data);
  $.post("/library/add_book_handler.php", data, onAddBookResponse, "json");
  return false;
});

function onAddBookResponse(response) {
   if (response.success) {
     $("#book_insert_info").html(response.success);
     $("#book_insert_info").addClass("hidden_info_success");
   } else if (response.error) {
   	 $("#book_insert_info").html(response.error);
     $("#book_insert_info").addClass("hidden_info_error");
   } else {
   	 $("#book_insert_info").html("Ошибка передачи данных");
     $("#book_insert_info").addClass("hidden_info_error");
   }  
}
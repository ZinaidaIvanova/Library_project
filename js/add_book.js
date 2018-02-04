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
     window.location = 'http://localhost/library/index.php';
   } else if (response.error) {
     $("#book_insert_info").html(response.error);
     $("#book_insert_info").addClass("hidden_info_error");
   } else {
     $("#book_insert_info").html("Ошибка передачи данных");
     $("#book_insert_info").addClass("hidden_info_error");
   }  
}
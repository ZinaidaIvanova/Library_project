$("#author_old_edit").change(function() {
  console.log("click");
  var author = $("#author_old_edit").val();
  $("#book_edit").children("input").val("");
  $("#book_edit").children("textarea").val("");
  $("#author_old_edit").val(author);
  var data = {"author": author};
  $.post("/library/book_list.php", data, onLoadBookList, "json");
  console.log($("#book_edit").children("input"));
  $("#book_edit").children("input").removeAttr("disabled");
  $("#book_edit").children("textarea").removeAttr("disabled");
  $("#book_edit_info").removeAttr("class");
  $("#book_edit_info").html("");
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

$("#book_edit_btn").click(function() {
	var old_author = $("#author_old_edit").val();
	var old_title = $("#title_old_edit").val();
	var author = $("#author_new_edit").val();
	var title = $("#title_new_edit").val();
	var genre = $("#genre_new_edit").val();
	var isbn = $("#isbn_new_edit").val();
	var description = $("#description_new_edit").val();	
  var data = {"old_author": old_author, "old_title": old_title, "author": author, "title": title, "genre": genre, "isbn": isbn, "description":description};
  $.post("/library/change_book.php", data, onEditBookResponse, "json");
  return false;
});

function onEditBookResponse(response) {
   if (response.success) {
     $("#book_edit_info").html(response.success);
     $("#book_edit_info").addClass("hidden_info_success");
   } else if (response.error) {
   	 $("#book_edit_info").html(response.error);
     $("#book_edit_info").addClass("hidden_info_error");
   } else {
   	 $("#book_edit_info").html("Ошибка передачи данных");
     $("#book_edit_info").addClass("hidden_info_error");
   }  
}
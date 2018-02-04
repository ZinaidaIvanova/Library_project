$("#author_insert").change(function() {
  $("#author_insert_info").removeAttr("class");
  $("#author_insert_info").html("");	
});

$("#author_insert_btn").click(function(){
  var author = $("#author_insert").val();
  var data = {"author": author};
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


$("#author_image_edit").change(function() {
  console.log("click");
  var author = $("#author_image_edit").val();
  $("#image_insert").children("input").val("");
  $("#author_image_edit").val(author);
  
  var data = {"author": author};
  $.post("/library/book_list.php", data, onLoadBookList, "json");
  
  $("#image_edit_info").removeAttr("class");
});

$('#image_insert_btn').click(function() {
	event.stopPropagation();
	event.preventDefault();

	var author = $("#author_image_edit").val();
	var title = $("#title_image_edit").val();
	var file_data = $('#upload').prop('files')[0];
	var form_data = new FormData();
	form_data.append('uploadFile', file_data);
	form_data.append('author', author);
	form_data.append('title', title);

	$.ajax({
		 url: '/library/change_image.php',
		 dataType: 'json',
		 cache: false,
     contentType: false,
     processData: false,
         data: form_data,
         type: 'post',
         success: function(response, status, jqXHR) {
         	console.log(response);
         	if (response.success) {
                $("#image_edit_info").html(response.success);
                $("#image_edit_info").addClass("hidden_info_success");
            } else if (response.error) {
   	          $("#image_edit_info").html(response.error);
              $("#image_edit_info").addClass("hidden_info_error");
            }
         },
         error: function( jqXHR, status, errorThrown ){
			   console.log( 'ОШИБКА AJAX запроса: ' + status, jqXHR );
		 }	
	});
});


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
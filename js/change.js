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
            if (response.error) {
   	          $("#image_edit_info").html(response.error);
              $("#image_edit_info").addClass("hidden_info_error");
            } else {
              var address = 'http://localhost/library/book.php?book_id=' + $("#book_id").val();
              window.location = address;
            }

         },
         error: function( jqXHR, status, errorThrown ){
			console.log( 'ОШИБКА AJAX запроса: ' + status, jqXHR );
		 }	
	});
});

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
      var address = 'http://localhost/library/book.php?book_id=' + $("#book_id").val();
      window.location = address;
   } else if (response.error) {
   	 $("#book_edit_info").html(response.error);
     $("#book_edit_info").addClass("hidden_info_error");
   } else {
   	 $("#book_edit_info").html("Ошибка передачи данных");
     $("#book_edit_info").addClass("hidden_info_error");
   }  
}
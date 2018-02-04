$("#author_image_edit").change(function() {
  console.log("click");
  var author = $("#author_image_edit").val();
  $("#image_insert").children("input").val("");
  $("#author_image_edit").val(author);
  
  var data = {"author": author};
  $.post("/library/book_list.php", data, onLoadBookList, "json");
  
  $("#image_edit_info").removeAttr("class");
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
  console.log($("#image_insert").children("input"));
  $("#image_insert").children("input").removeAttr("disabled");
}

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
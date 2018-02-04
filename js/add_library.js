$("#add_book_in_library").click(function() {
	event.stopPropagation();
	event.preventDefault();
	var form_data = new FormData();
	form_data.append('book_id', $('#book_id').val());
	var lib_elem = $('div.lib_info');
	lib_elem.each(function(ind, elem){
       var lib_index = 'lib_' + ind;
       var lib = $(elem).children();
       var lib_info = [];
       lib_info.push(lib.filter("[name = lib_id]").val());
       lib_info.push(lib.filter("[name = num]").val());
       form_data.append(lib_index, lib_info);
	});
	$.ajax({
	url: '/library/add_library_handler.php',
	dataType: 'json',
	cache: false,
    contentType: false,
    processData: false,
    data: form_data,
    type: 'post',
    success: function(response, status, jqXHR) {
        if (response.success) {
        	$("#library_info").html(response.success);
          $("#library_info").addClass("hidden_info_success");
          var address = 'http://localhost/library/book.php?book_id=' + $("#book_id").val();
          window.location = address;
        } else {
        	$("#library_info").html(response.error);
          $("#library_info").addClass("hidden_info_error");
        }
    },
    error: function( jqXHR, status, errorThrown ) {
		console.log( 'ОШИБКА AJAX запроса: ' + status, jqXHR );
	  }	
	});
});

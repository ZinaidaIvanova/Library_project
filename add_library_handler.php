<?php
require_once("include/common.inc.php");
$bookId = intval(getIfPost('book_id'));
$index = 'lib_';
$success = '';
$error = '';
for ($i=0; $i < (count($_POST) - 1); $i++) { 
	$temp = explode(",", getIfPost($index . $i));
    $libId = intval($temp[0]);
    $num = intval($temp[1]);
    if(editBookInLibrary($libId, $bookId, $num)) {
    	$success .= 'Данные в ' . ($i + 1) . ' библиотеку успешно добавлены. ';
    } else {
    	$error .= 'Ошибка добваления данных в базу';
    }
}
sendResponse($success, $error);
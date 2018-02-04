<?php
require_once("include/common.inc.php");
$authorName = getIfPost('author');
$title = getIfPost('title');
$success = '';
$error = '';
$book_id = getBookIdByAuthorAndName($authorName, $title);

if (empty($book_id)) {
    $error = 'Ошибка! Книга с таким автором и названием не найдена!';
}

if (empty($error) && (deleteBook($book_id)) && (deleteBookFromMarks($bookId)) && (deleteBookFromComment($bookId))) {
    $success = 'Книга успешно удалена';
} else {
	$error = 'Ошибка при удалении из базы данных';
} 

sendResponse($success, $error);
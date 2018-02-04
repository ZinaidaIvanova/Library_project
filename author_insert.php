<?php
require_once("include/common.inc.php");
$authorName = getIfPost('author');
$success = '';
$error = '';

if (empty($authorName)) {
	$error = "Ошибка! Автор не указан!";
}

if (empty($error) && (!empty(getAuthorId($authorName)))) {
	$error = 'Ошибка! Данный автор уже существует!';
}

if (empty($error) && addAuthor($authorName)) {
	$success = 'Автор успешно добавлен';
} else {
	$error = 'Ошибка добавления автора в базу';
}

sendResponse($success, $error);
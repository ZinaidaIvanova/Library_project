<?php
require_once("include/common.inc.php");
$authorName = ltrim(getIfPost('author'));
$success = '';
$error = '';

if (empty($authorName)) {
	$error = "Ошибка! Автор не указан!";
}

if (empty($error) && empty(getAuthorId($authorName))) {
    addAuthor($authorName);
    $success = 'Автор успешно добавлен';
} else {
	$error = 'Ошибка! Данный автор уже существует!';
}

sendResponse($success, $error);
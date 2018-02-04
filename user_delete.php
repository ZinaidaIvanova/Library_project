<?php
require_once("include/common.inc.php");
$login = getIfPost('login');
$success = '';
$error = '';

if (empty($login)) {
	$error = 'Логин не указан';
}

if (empty($error) && checkLogin($login)) {
	$error = 'Указанный логин не существует ';
}

if (empty($error) && userDelete(getUserId($login)) && deleteUserFromMarks(getUserId($login)) && deleteUserFromComment(getUserId($login))) {
	$success = 'Пользователь успешно удален';
} else {
	$error = 'Ошибка удаления пользователя из базы';
}

sendResponse($success, $error);
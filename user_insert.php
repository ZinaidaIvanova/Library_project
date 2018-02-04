<?php
require_once("include/common.inc.php");
$login = getIfPost('login');
$email = getIfPost('email');
$pass = getIfPost('pass');
$success = '';
$error = '';

if (empty($login)) {
	$error = 'Логин не указан!';
}

if (empty($error) && empty($email)) {
	$error = 'E-mail не указан!';
}

if (empty($error) && empty($pass)) {
	$error = 'Пароль не указан!';
}

if (empty($error) && (!checkLogin($login))) {
	$error = 'Пользователь с таким логином уже существует';
}

if (empty($error) && addUser($login, $mail, $pass)) {
	$success = 'Пользователь успешно добавлен';
} else {
	$error = 'Ошибка добавления пользователя в базу данных';
}
sendResponse($success, $error);
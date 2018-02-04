<?php
require_once("include/common.inc.php");
$login = getIfPost('login');
$pass = getIfPost('pass');
$mail = getIfPost('email');
$success ='';
$error = '';

if (empty($login)) {
	$error = 'Логин не указан';
}

if (empty($error) && empty($mail)) {
	$error = 'e-mail не указан';
}

if (empty($error) && empty($pass)) {
	$error = 'Пароль не указан';
}

if (empty($error) && (!checkLogin($login))) {
	$error = 'Логин занят';
}

if (empty($error)) {
	addUser($login, $mail, $pass);
    $userInfo = findUserByLogin($login, $pass);
    saveSessionUser($userInfo);
    $success = 'Пользователь успешно зарегистрирован';
}

sendResponse($success, $error);
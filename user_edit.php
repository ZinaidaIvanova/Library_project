<?php
require_once("include/common.inc.php");
$oldLogin = getIfPost('old_login');
$login = getIfPost('new_login');
$email = getIfPost('new_email');
$pass = getIfPost('new_pass');
$success = '';
$error = '';
$userId = getUserId($oldLogin);

if (empty($oldLogin)) {
    $error =  'Текущий логин не указан!';
}

if (empty($error) && checkLogin($oldLogin)) {
    $error = 'Указанный логин не существует! ';
}

if (empty($error) && empty($login) && empty($email) && empty($pass)) {
   $error = 'Не указан ни один новый параметр! '; 
}

if (empty($error) && (!checkLogin($login)) {
    $error = 'Пользователь с таким логином уже существует ';
}

if (empty($error) && (!loginEdit($userId, $login)) {
    $error = 'Ошибка добавления нового логина в базу данных';
}

if (empty($error) && (!emailEdit($userId, $email)) {
    $error = 'Ошибка добавления e-mail в базу данных';
}

if (empty($error) && (!passEdit($userId, $pass))) {
    $error = 'Ошибка добавления нового пароля в базу данных';
}

if (empty($error)) {
    $success = 'Данные успешно изменены';
}
sendResponse($success, $error);
<?php
require_once("include/common.inc.php");
$login = isset($_POST['login']) ? $_POST['login'] : '';
$pass = isset($_POST['pass']) ? $_POST['pass'] : '';
$userInfo = findUserByLogin($login, $pass);
$success ='';
$error = '';
$rights = '';
if (!empty($userInfo)) {
	saveSessionUser($userInfo);
	$rights = ($userInfo['rights'] == 'admin') ? 'admin' : 'user';
    $success = 'Вы успешно авторизовались';
} else {
    $error = 'Проверьте правильность логина и пароля';
}
$message = array('success' => $success, 'rights' => $rights, 'error' => $error);
echo json_encode($message);
<?php
require_once("include/common.inc.php");
$userId = getIfPost('user_id');
$login = getIfPost('login');
$lastName = getIfPost('last_name');
$firstName = getIfPost('first_name');
$email = getIfPost('e_mail');
$pass = getIfPost('pass');
if (!empty($login)) {
    loginEdit($userId, $login);
}
if (!empty($lastName)) {
    lastNameEdit($lastName, $userId);
}
if (!empty($firstName)) {
    firstNameEdit($firstName, $userId);
}
if (!empty($email)) {
    emailEdit($userId, $email);
}
if (!empty($pass)) {
    passEdit($userId, $pass);
}
if ((isset($_FILES['upload'])) && (checkImageFile($_FILES['upload']['tmp_name'])) && (checkImageSize($_FILES['upload']['tmp_name']))) {
	$uploaddir = './upload/';
	    $fileName = basename($_FILES['upload']['name']);
        $uploadFile = $uploaddir . $fileName;
        if (move_uploaded_file($_FILES['upload']['tmp_name'], $uploadFile)) {
            $newFileName = $uploaddir . 'user_id_' . $userId . '.' .  getExtension($uploadFile);
            rename($uploadFile, $newFileName);
            addUserImageToDB(ltrim($newFileName, "./"), $userId));           
        }
}
header('Location:/library/profile.php');
exit(0);
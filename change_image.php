<?php
require_once("include/common.inc.php");
$error = '';
$success = '';
$authorName = getIfPost('author');
$title = getIfPost('title');

if (empty($authorName) && empty($title)) {
    $error = 'Автор и название книги должны быть указаны';
}

if (empty($error) && (!isset($_FILES['uploadFile'])) {
    $error = 'Файл для загрузки не выбран';
}

if (empty($error) && (!checkImageFile($_FILES['uploadFile']['tmp_name'])) {
    $error = 'Файл должен иметь расширение .jpeg, .png, .bmp';
}

if (empty($error) && (!checkImageSize($_FILES['uploadFile']['tmp_name']))) {
    $error = 'Размер файла не должен превышать 2Мб';
}

if (empty($error)) {
    $id = getBookIdByAuthorAndName($authorName, $title);
    $uploaddir = './upload/';
    $fileName = basename($_FILES['uploadFile']['name']);
    $uploadFile = $uploaddir . $fileName;
}

if (empty($error) && (!move_uploaded_file($_FILES['uploadFile']['tmp_name'], $uploadFile))) {
    $error = 'Файл не загружен';
}

if (empty($error)) {
    $newFileName = $uploaddir . 'book_id_' . $id . '.' .  getExtension($uploadFile);
    rename($uploadFile, $newFileName);
    if(addBookImageToDB(ltrim($newFileName, "./"), $id)){
        $success = 'Обложка успешно загружена';
    } else {
        $error = 'Ошибка добавления обложки в базу данных';
    }
}
sendResponse($success, $error);
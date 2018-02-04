<?php
require_once("include/common.inc.php");
$oldAuthor = getIfPost('old_author');
$oldTitle = getIfPost('old_title');
$authorName = getIfPost('author');
$title = getIfPost('title');
$genre = getIfPost('genre');
$description = ltrim(getIfPost('description')); 
$isbn = getIfPost('isbn');
$error = '';
$success = '';
$book_id = getBookIdByAuthorAndName($oldAuthor, $oldTitle);

if (empty($book_id)) {
    $error = 'Ошибка! Книга с таким автором и названием не найдена!';
}

if (empty($error) && (!empty($authorName)) && (!getAuthorId($authorName))) {
    $error = 'Указанный автор не существует!';
}

if (empty($error) && (!empty($genre)) && (!getGenreId($genre))) {
    $error = 'Указанный жанр не существует!';
}

if (empty($error) && (!emptyBook((getAuthorId($authorName)), $title))) {
    $error = 'Книга с таким названием у данного автора уже существует!';
}

if (empty($error) && empty($authorName) && empty($title) && empty($genre) && empty($description) && empty($isbn)) {
    $error = 'Не заполнены новые данные о книге!';
}

if (empty($error) && (!empty($authorName)) && (!editAuthor(getAuthorId($authorName), $book_id))) {
    $error = 'Ошибка добавления новых сведений об авторе книги';
}

if (empty($error) && (!empty($title)) && (!editTitle($title, $book_id))) {
    $error = 'Ошибка добавления новых сведений о названии книги';
}

if (empty($error) && (!empty($genre)) && (!editGenre(getGenreId($genre), $book_id))) {
    $error = 'Ошибка добавления новых сведений о жанре книги';
}

if (empty($error) && (!empty($description)) && (!editDescription($description, $book_id))) {
   $error = 'Ошибка добавления новых сведений об описании книги';
}

if (empty($error) && (!empty($isbn)) && (!editIsbn($isbn, $book_id))) {
   $error = 'Ошибка добавления новых сведений об ISBN книги';
}

if(empty($error)) {
    $success = 'Изменения успешно внесены';
}
sendResponse($success, $error);
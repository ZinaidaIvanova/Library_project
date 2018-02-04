<?php
require_once("include/common.inc.php");
$authorName = getIfPost('author');
$title = getIfPost('title');
$genre = getIfPost('genre');
$description = ltrim(getIfPost('description')); 
$isbn = getIfPost('isbn');
$success = '';
$error = '';

if (empty(getGenreId($genre))) {
    $error = 'Указанный жанр не существует! ';
}

if (empty($error) && empty(getAuthorId($authorName))) {
    $error = 'Указанный автор не существует!';
}

if (empty($error) && !emptyBook((getAuthorId($authorName)), $title)) {
    $error = 'Книга с таким названием у данного автора уже существует! ';
}

if (empty($error) && empty($title)) {
    $error = "Укажите описание новой книги"; 
}

if (empty($error) && empty($description)) {
    $error = "Укажите описание новой книги";
}

if (empty($error) && empty($isbn)) {
    $error = "Укажите ISBN книги";
}

if (empty($error) && addBook(getAuthorId($authorName), $title, getGenreId($genre), $description, $isbn)) {
    $ind = True;
    for ($i = 1; $i <= libraryNum(); $i++) { 
        if(!addBookInLibrary($i, getBookIdByAuthorAndName($authorName, $title))) {
            $ind = False;
            break;
        }    
    }
    if ($ind) {
        $success = 'Книга успешно добавлена';
    }    
}

if (empty($success)) {
    $error = "Ошибка при добавлении книги в базу";
}

sendResponse($success, $error);
/*if ((!empty(getGenreId($genre))) && (!empty(getAuthorId($authorName)))) {
  if(emptyBook((getAuthorId($authorName)), $title)) {
    if (!empty($title)) {
        if (!empty($description)) {
            if (!empty($isbn)) {
                if(addBook(getAuthorId($authorName), $title, getGenreId($genre), $description, $isbn)) {
                    for ($i = 1; $i <= libraryNum(); $i++) { 
                            addBookInLibrary($i, getBookIdByAuthorAndName($authorName, $title));
                        }
                        $success .= 'Книга успешно добавлена';
                } else {
                    $error .= "Ошибка при добавлении книги в базу";
                }    
            } else {
                $error .= "Укажите ISBN книги";
            }    
        } else {
            $error .= "Укажите описание новой книги";  
        }    
    } else {
        $error .= "Укажите название новой книги";
    }    
  } else {
      $error = 'Книга с таким названием у данного автора уже существует! ';
  }  
} else {
	$error = 'Ошибка! ';
    if (empty(getGenreId($genre))) {
    	$error .= ' Указанный жанр не существует! ';
    }
    if (empty(getAuthorId($authorName))) {
    	$error .= ' Указанный автор не существует!';
    }
}
sendResponse($success, $error);*/
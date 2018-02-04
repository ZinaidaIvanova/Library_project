<?php

function bookAccessibility($bookId)
{
  $query = "SELECT libraries.name_of_library, libraries.address,
            book_in_library.number_of_book, libraries.library_id
              FROM book_in_library
              LEFT JOIN  libraries ON libraries.library_id=book_in_library.library_id
              WHERE book_in_library.book_id=" . $bookId . ";";
  return dbQueryGetResult($query);
}

function libraryList()
{
  $query = "SELECT name_of_library AS name, address,
            library_id AS id
            FROM libraries;";
  return dbQueryGetResult($query);  
}

function editBookInLibrary($libId, $bookId, $num)
{
    $query = "UPDATE book_in_library
              SET number_of_book=" . $num . "
              WHERE library_id =" . $libId . "
              AND book_id=" . $bookId . ";";
    return dbQuery($query);  
}

function addBookInLibrary($libId, $bookId)
{
    $query = "INSERT INTO book_in_library(library_id, book_id)
              VALUES
              (" . $libId . ", " . $bookId . ");";
    return dbQuery($query); 
}

function libraryNum()
{
    $query = "SELECT count(*) AS num_of_lib
              FROM libraries;";
    $num = dbQueryGetResult($query)[0];
    return $num["num_of_lib"];
}

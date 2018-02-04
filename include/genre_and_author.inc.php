<?php
//Запрос для получения списка авторов с количеством книг
function getAuthorList()
{
	$query = "SELECT author.name AS item,
              author.author_id AS id,
              count(books.title) AS 'numberOfBooks'
              FROM books
              RIGHT JOIN author ON books.author_id=author.author_id
              GROUP BY author.name;";
  return dbQueryGetResult($query);
}

//Запрос для получения списка жанра с количеством книг
function getGenreList()
{
	$query = "SELECT genres.genre AS item,
              genres.genre_id AS id,
              count(books.title) AS 'numberOfBooks'
              FROM books
              RIGHT JOIN genres ON books.genre_id=genres.genre_id
              GROUP BY genres.genre;";
  return  dbQueryGetResult($query);
}

function getGenres()
{
  $query = "SELECT genres.genre AS item,
              genres.genre_id AS id
              FROM genres
              GROUP BY genres.genre_id;";
  return  dbQueryGetResult($query);
}

function getAuthors()
{
  $query = "SELECT author.name AS item,
              author.author_id AS id
              FROM author
              GROUP BY author.author_id;";
  return dbQueryGetResult($query);
}

function getGenreId($genre)
{
  $query = "SELECT genre_id
            FROM genres
            WHERE genre='" . dbQuote($genre) . "';";
  $var = '';
  if (!empty(dbQueryGetResult($query))) {
     $temp = dbQueryGetResult($query)[0];
     $var = $temp['genre_id'];
  } 
  return $var;
}

function getAuthorId($authorName)
{
  $query = "SELECT author_id 
            FROM author
            WHERE name='" . dbQuote($authorName) . "';";
  $var = '';
  if (!empty(dbQueryGetResult($query))) {
     $temp = dbQueryGetResult($query)[0];
     $var = $temp['author_id'];
  } 
  return $var;  
}

function addAuthor($authorName)
{
  $query = "INSERT INTO author
            (name)
            VALUES
            ('". dbQuote($authorName) ."');";
  return dbQuery($query);
}
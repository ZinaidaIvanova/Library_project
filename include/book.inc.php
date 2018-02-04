<?php
//Запрос на вывод данных о книге: название, автор, описание, isbn, картинка,  оценки, отзывы, даты отзыва
function getBookInfo($bookId)
{
	$query = "SELECT  books.title, author.name, books.description,
	          books.image, books.isbn, round(AVG(marks.mark),1)  AS avgVal, books.book_id AS id
              FROM books
              INNER JOIN author ON author.author_id = books.author_id
              RIGHT JOIN marks ON marks.book_id =books.book_id 
              WHERE books.book_id=" . dbQuote($bookId) . ";";
    $info  = dbQueryGetResult($query);
    return $info;
}

function isBookExist($bookId)
{
  $query = "SELECT *
            FROM books
            WHERE book_id=" . dbQuote($book_id) . ";";
  return (!empty(dbQueryGetResult($query)));
}

//функция для нахождения самых популярных книг
function getMostPopularBook($page)
{ 
  global $g_bookLimits;
  $first = ($page - 1) * $g_bookLimits;
  $query = "SELECT count(comments.book_id) AS number_of_comment,
            books.book_id, books.image, books.title, author.name, books.description, author.name
            FROM books
            INNER JOIN author ON author.author_id=books.author_id
            RIGHT JOIN comments ON comments.book_id=books.book_id
            GROUP BY comments.book_id
            ORDER BY number_of_comment DESC
            LIMIT " . $first . ", " . $g_bookLimits . ";";
	return dbQueryGetResult($query);
}

//Функция для нахождения количества книг в базе
function bookNum()
{
    $query = "SELECT count(*) AS number_of_books
              FROM books;";
    $num = dbQueryGetResult($query)[0];
    return $num["number_of_books"];
}

function bookNumByComments()
{
  $query = "SELECT count(comments.book_id) AS num
            FROM books
            INNER JOIN author ON author.author_id = books.author_id
            RIGHT JOIN comments ON comments.book_id=books.book_id
            GROUP BY comments.book_id;";
  $num = dbQueryGetResult($query)[0];
  return $num["num"];
}

function bookNumByGenre($genreId)
{
    $query = "SELECT count(*) AS number_of_books
              FROM books
              WHERE genre_id=" . $genreId . ";";
    $num = dbQueryGetResult($query)[0];
    return $num["number_of_books"];
}

function bookNumByAuthor($authorId)
{
    $query = "SELECT count(*) AS number_of_books
              FROM books
              WHERE author_id=" . $authorId . ";";
    $num = dbQueryGetResult($query)[0];
    return $num["number_of_books"];
}

//функция для нахождения последних добавленных книг
function getLastBooks()
{
	$limit = 20;
	$query = "SELECT books.title, books.description, books.image, books.book_id, author.name
              FROM books
              INNER JOIN author ON author.author_id = books.author_id
              GROUP BY  book_id DESC
              LIMIT " . $limit .";";
    return dbQueryGetResult($query);  
}

//Запрос для получения списка книг определенного автора
function getBooksByAuthorId($authorId, $page)
{
    global $g_bookLimits;
    $first = ($page - 1) * $g_bookLimits;
  	$query = "SELECT books.title, books.description, books.image, books.book_id, author.name
              FROM books
              INNER JOIN author ON author.author_id = books.author_id
              WHERE books.author_id=" . $authorId .
              " GROUP BY books.title 
              LIMIT " . $first . ", " . $g_bookLimits . ";";
    return dbQueryGetResult($query);
}

function getBookListByAuthorId($authorId)
{
  $query = "SELECT books.title
            FROM books
            INNER JOIN author ON author.author_id = books.author_id
            WHERE books.author_id=" . $authorId .
            " GROUP BY books.title;";
    return dbQueryGetResult($query);  
}

//Запрос для получения списка книг определенного жанра
function getBooksByGenreId($genreId, $page)
{
  global $g_bookLimits;
  $first = ($page - 1) * $g_bookLimits;
	$query = "SELECT books.title, books.description, books.image, books.book_id, author.name
            FROM books
            INNER JOIN author ON author.author_id = books.author_id
            WHERE books.genre_id=" . $genreId .
            " GROUP BY books.title
            LIMIT " . $first . ", " . $g_bookLimits . ";";
    return dbQueryGetResult($query);           
}

function getAllBooks($page)
{
    global $g_bookLimits;
    $first = ($page - 1) * $g_bookLimits;
    $query = "SELECT books.title, books.description, books.image, books.book_id, author.name
              FROM books
              INNER JOIN author ON author.author_id = books.author_id
              GROUP BY  books.book_id DESC
              LIMIT " . $first . ", " . $g_bookLimits . ";";
    return dbQueryGetResult($query);                
}

function getBookByKeyWord($KeyWords)
{
  $query = "SELECT books.title, books.description, books.image, books.book_id, author.name
            FROM books
            INNER JOIN author ON author.author_id = books.author_id
            WHERE books.title LIKE '%" . dbQuote($KeyWords) . "%' OR author.name LIKE '%" . dbQuote($KeyWords) . "%' OR
              books.description LIKE '%" . dbQuote($KeyWords) . "%';";
  return dbQueryGetResult($query);           
}

function getBookList()
{
    $query = "SELECT books.title AS item
              FROM books
              GROUP BY  books.book_id";
    return dbQueryGetResult($query);
}

function addBook($authorId, $title, $genreId, $description, $isbn)
{
    $query = "INSERT INTO books
              (title, author_id, isbn, genre_id, description)
              VALUES
              ('" . dbQuote($title) . "', '" . $authorId . "', '" . dbQuote($isbn) . "', '" . $genreId . "', '" . dbQuote($description) . "');";
    return dbQuery($query);
}

//Нахождение id книги по названию и автору
function getBookIdByAuthorAndName($authorName, $title)
{
  $author_id = getAuthorId($authorName);
  $query = "SELECT books.book_id as id
            FROM books
            INNER JOIN author ON author.author_id = books.author_id
            WHERE books.title ='". $title ."';";
  $temp = '';
  if (!empty(dbQueryGetResult($query))) {
    $arr = dbQueryGetResult($query)[0];
    $temp = $arr['id'];  
  }
  return $temp;
}

//редактирование книги 
function editTitle ($title, $bookId)
{
    $query = "UPDATE books
              SET title='" . dbQuote($title) . "'
              WHERE book_id=" . $bookId . ";";
    return dbQuery($query);
}

function editAuthor($authorId, $bookId)
{
    $query = "UPDATE books
              SET author_id='" . dbQuote($authorId) . "'
              WHERE book_id=" . $bookId . ";";
    return dbQuery($query);
}

function editGenre($genreId, $bookId)
{
    $query = "UPDATE books
              SET genre_id='" . dbQuote($genreId) . "'
              WHERE book_id=" . $bookId . ";";
    return dbQuery($query);
}

function editIsbn($isbn, $bookId)
{
    $query = "UPDATE books
              SET isbn='" . dbQuote($isbn) . "'
              WHERE book_id=" . $bookId . ";";
    return dbQuery($query);
}

function editDescription($description, $bookId)
{
    $query = "UPDATE books
              SET description='" . dbQuote($description) . "'
              WHERE book_id=" . $bookId . ";";
    return dbQuery($query);
}

//удаление книги 
function deleteBook($bookId)
{
    $query = "DELETE FROM books
              WHERE book_id=" . $bookId . ";";
    return dbQuery($query);
}

function deleteBookFromMarks($bookId)
{
    $query = "DELETE FROM marks
              WHERE book_id=" . $bookId . ";";
    return dbQuery($query);
}

function deleteBookFromComment($bookId)
{
    $query = "DELETE FROM comments
              WHERE book_id=" . $bookId . ";";
    return dbQuery($query);
}

function addBookImageToDB($fileName, $bookId)
{
    $query = "UPDATE books
              SET image='" . $fileName . "'
              WHERE book_id=" . $bookId . ";";
    return dbQuery($query);
}

function emptyBook($authorId, $title)
{
    $query = "SELECT book_id as id
            FROM books
            WHERE author_id=" . $authorId . " AND 
            title='" . $title . "';";
    $info = dbQueryGetResult($query);
    return empty($info[0]);
}
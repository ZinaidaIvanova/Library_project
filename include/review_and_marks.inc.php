<?php
function getCommentsAndMarksByBookId($bookId)
{
	$limit = 10;
  $query = "SELECT comments.comment_date, comments.comment_text,
	          users.login, marks.mark
              FROM comments
              INNER JOIN marks ON comments.book_id=marks.book_id
              INNER JOIN users ON users.user_id=comments.user_id
              WHERE  comments.book_id=" . $bookId . " GROUP BY comments.comment_id DESC 
              LIMIT " . $limit .";";
    return dbQueryGetResult($query); 
}

function getCommentsAndMarksByUserId($userId)
{
  $limit = 10;
  $query = "SELECT comments.comment_date, comments.comment_text,
            books.title, marks.mark
              FROM comments
              INNER JOIN marks ON comments.book_id=marks.book_id
              INNER JOIN books ON books.book_id=comments.book_id
              WHERE  comments.user_id=" . $userId . "
              GROUP BY comments.comment_id DESC 
              LIMIT " . $limit .";";
    return dbQueryGetResult($query); 
}

function addComment($bookId, $userId, $comment)
{
    $query = "INSERT INTO comments
            (book_id, user_id, comment_date, comment_text)
            VALUES
            ('" . $bookId . "', '" . $userId . "',  NOW(),'" . $comment . "');";
    return dbQuery($query);
}

function addMark($bookId, $userId, $mark)
{
    $query = "INSERT INTO marks
            (book_id, user_id, mark)
            VALUES
            ('" . $bookId . "', '" . $userId . "',  '" . $mark . "');";
    return dbQuery($query);
}

function getAvgMark($bookId)
{
    $query = "SELECT round(AVG(marks.mark),1)  AS avgVal
              FROM marks
              WHERE book_id=" . $bookId . ";";
    return dbQueryGetResult($query)[0];           
}
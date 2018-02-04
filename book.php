<?php
require_once("include/common.inc.php");
$bookId = (isset($_GET["book_id"])) ? intval(dbQuote($_GET["book_id"])) : '' ;
if (isBookExist($bookId)) {
	$vars = array('info' => getBookInfo($bookId)[0],
	              'accessibility' => bookAccessibility($bookId),
	              'accessibility_ind' => array('sum' =>  elemSum(bookAccessibility($bookId), 'number_of_book')),
	              'comments' => getCommentsAndMarksByBookId($bookId),
                  'log' => getAuthInfo(),
                  'page' => array('name' => 'book'));
	echo getView("book.twig", $vars);
} else {
    header("Location:/library/index.php");
    exit(0);
}
<?php
require_once("include/common.inc.php");
if (isset($_GET["author_id"])) {
    $authorId = intval($_GET["author_id"]);
    $total = getTotalPage(bookNumByAuthor($authorId), $g_bookLimits);
    $pageNum = intval(getIfExist('page'));   
    $vars = array('books' => getBooksByAuthorId($authorId, checkPage($pageNum, $total)),
                  'log' => getAuthInfo(),
                  'link' => getLinkString(__FILE__, $_GET),
                  'nav' => getNextAndPrevPage($pageNum, $total));
    echo getView("index.twig", $vars);
} else {
	header('Location:/library/index.php');
exit(0);
}
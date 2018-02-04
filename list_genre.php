<?php
require_once("include/common.inc.php");
if (isset($_GET["genre_id"])) {
    $genreId = intval($_GET["genre_id"]);
    $pageNum = intval(getIfExist('page'));
    $total = getTotalPage(bookNumByGenre($genreId), $g_bookLimits);
    $vars = array('books' => getBooksByGenreId($genreId, checkPage($pageNum, $total)),
                  'log' => getAuthInfo(),
                  'link' => getLinkString(__FILE__, $_GET),
                  'nav' => getNextAndPrevPage($pageNum, $total));
    echo getView("index.twig", $vars);
} else {
	header('Location:/library/index.php');
exit(0);
}
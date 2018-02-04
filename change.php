<?php
require_once("include/common.inc.php");
requireRights();
$id = intval(getIfExist('book_id'));
$type = getIfExist('type');
$vars = array('info' => getBookInfo($id)[0],
	         'genres' => getGenres(),
             'authors' => getAuthors(),
             'log' => getAuthInfo(),
             'page' => array('name' => 'change'));
if (isBookExist($id) && ($type == 'image')) {
	echo getView("image_change.twig", $vars);
} elseif (isBookExist($id) && ($type == 'book')) {
	echo getView("book_change.twig", $vars);
} else {
	header("Location:/library/index.php");
    exit(0);
}
<?php
require_once("include/common.inc.php");
$vars = array( 'genres' => getGenres(),
               'authors' => getAuthors(),
               'books' => getBookList(),
               'log' => getAuthInfo(),
               'page' => array('name' => 'add_book'));

echo getView("add_book.twig", $vars);
<?php
require_once("include/common.inc.php");
$pageNum = intval(getIfExist('page'));
$total = getTotalPage(bookNum(), $g_bookLimits);
$vars = array('books' => getAllBooks(checkPage($pageNum, $total)),
              'log' => getAuthInfo(),
              'link' => getLinkString(__FILE__, $_GET),
              'nav' => getNextAndPrevPage($pageNum, $total));
echo getView("index.twig", $vars);
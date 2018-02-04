<?php
require_once("include/common.inc.php");
$pageNum = intval(getIfExist('page'));
$limits = 100;
$total = getTotalPage(min($limits, bookNumByComments()), $g_bookLimits);
$vars = array('books' => getMostPopularBook(checkPage($pageNum, $total)),
              'log' => getAuthInfo(),
              'link' => getLinkString(__FILE__, $_GET),
              'nav' => getNextAndPrevPage($pageNum, $total));
echo getView("index.twig", $vars);
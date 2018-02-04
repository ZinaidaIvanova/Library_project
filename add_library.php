<?php
require_once("include/common.inc.php");
requireRights();
$id = intval(getIfExist('book_id'));
$vars = array('info' => array('id' => $id),
	          'libraries' => libraryList(),
              'log' => getAuthInfo(),
              'page' => array('name' => 'library'));

echo getView("add_library.twig", $vars);
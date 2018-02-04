<?php
require_once("include/common.inc.php");
$vars = array('lists' => getAuthorList(),
              'log' => getAuthInfo());
echo getView("list_author.twig", $vars);
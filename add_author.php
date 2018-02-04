<?php
require_once("include/common.inc.php");
$vars = array( 'log' => getAuthInfo(),
               'page' => array('name' => 'add_author'));
echo getView("add_author.twig", $vars);
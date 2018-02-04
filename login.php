<?php
require_once("include/common.inc.php");
$vars = array('page' => array('name' => 'auth'));
echo getView("login.twig", $vars);
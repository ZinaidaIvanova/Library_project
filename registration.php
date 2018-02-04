<?php
require_once("include/common.inc.php");
$vars = array('page' => array('name' => 'registration'));
echo getView("registration.twig", $vars);
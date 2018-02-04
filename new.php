<?php
require_once("include/common.inc.php");
$vars = array('books' => getLastBooks(),
              'log' => getAuthInfo(),
              'nav' => array('total' => 1));
echo getView("index.twig", $vars);
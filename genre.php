<?php
require_once("include/common.inc.php");
$vars = array('lists' => getGenreList(),
              'log' => getAuthInfo());
echo getView("list_genre.twig", $vars);

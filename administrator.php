<?php
require_once("include/common.inc.php");
requireRights();
$vars = array( 'genres' => getGenres(),
               'authors' => getAuthors(),
               'logins' => getUserList(),
               'log' => getAuthInfo(),
               'page' => array('name' => 'administrator'));
echo getView("administrator.twig", $vars);
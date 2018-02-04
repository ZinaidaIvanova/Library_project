<?php
require_once("include/common.inc.php");
if (isset($_POST["searchQuery"])) {
    $KeyWords = $_POST["searchQuery"];
    $vars = array('books' => getBookByKeyWord($KeyWords),
                  'log' => getAuthInfo(),
                  'nav' => array('total' => 1));
    if (!empty($vars['books'])) {
        echo getView("index.twig", $vars);
    } else {
        echo getView("not_result.twig", $vars);
    }
}
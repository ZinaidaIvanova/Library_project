<?php
    $currentWorkDir = getcwd(); 
    chdir(dirname(__FILE__));

    define('ROOT_DIR', dirname(dirname(__FILE__) . "../"));
    define('TEMPLATE_DIR', ROOT_DIR . '/template');

    $g_bookLimits = 20;
    $g_commentLimits = 10;

    require_once("../vendor/autoload.php");
    require_once("template.inc.php");
    require_once("config.inc.php");
    require_once("database.inc.php"); 
    require_once("user.inc.php");
    require_once("book.inc.php");
    require_once("library.inc.php");
    require_once("genre_and_author.inc.php");
    require_once("review_and_marks.inc.php");
    require_once("management_and_navigation.inc.php");
    require_once("file.inc.php");
    dbInitialConnect();
    session_start();
    chdir($currentWorkDir);
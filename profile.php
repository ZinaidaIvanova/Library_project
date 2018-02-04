<?php
require_once("include/common.inc.php");
requireAuth();
$userInfo = getSessionUser();
$vars = array('comments' => getCommentsAndMarksByUserId($userInfo['user_id']),
              'log' => getAuthInfo(),
              'info' => getUserDate($userInfo['user_id']));
echo getView("user_state.twig", $vars);
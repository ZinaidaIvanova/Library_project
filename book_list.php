<?php
require_once("include/common.inc.php");
$author = getIfPost('author');
$temp = getBookListByAuthorId(getAuthorId($author));
$message = [];
for ($i=0; $i < count($temp); $i++) { 
    $message[$i] = $temp[$i]['title'];
}
echo json_encode($message);

<?php
function getIfPost($value)
{
	$temp = '';
	if (isset($_POST[$value])) {
		$temp = $_POST[$value];
	}
	return $temp;
}

function sendResponse($success, $error)
{
	$message = array('success' => $success, 'error' => $error);
    echo json_encode($message);
}

function getIfExist($value)
{
	$temp = '';
	if (isset($_GET[$value])) {
		$temp = $_GET[$value];
	}
	return $temp;
}

function getNextAndPrevPage($pageNum, $total)
{
    $first = 1;
    if (empty($pageNum) || ($pageNum <= $first)) {
    	$prev = $first;
    	$next = $prev + 1;
    } elseif ($pageNum >= $total) {
    	$prev = $total - 1;
        $next = $total;
    } else {
    	$prev = $pageNum - 1;
    	$next = $pageNum + 1;
    }
    return array('prev' => $prev,
                 'next' => $next,
                 'curr' => checkPage($pageNum, $total),
                 'total' => $total,
                 'first' => $first);
}

function getTotalPage($listNum, $limit)
{
	$temp = $listNum / $limit;
	return ceil($temp);
}

function checkPage($pageNum, $total)
{
   if (empty($pageNum) || ($pageNum <= 1)) {
    	$pageNum = 1;
    } elseif ($pageNum >= $total) {
    	$pageNum = $total;
    }
    return $pageNum;
}

function  elemSum($arr, $keys)
{
    $temp = 0;
    for ($i = 0; $i < count($arr); $i++) { 
        $temp += intval($arr[$i][$keys]);
    }
    return $temp;
}
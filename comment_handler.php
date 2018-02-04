<?php
require_once("include/common.inc.php");
$mark = getIfPost('mark');
$comment = ltrim(getIfPost('comment_text'));
$bookId = getIfPost('book_id');
$userId = getIfPost('user_id');
$error = '';
$success = '';
$avg = '';
if (empty($comment)) {
  $error .= 'Вы не заполнили текст отзыва ';
} else { 
    addComment($bookId, $userId, $comment);
    addMark($bookId, $userId, $mark);
    $success .= 'Комментарий успешно добавлен';
    $avg = getAvgMark($bookId)['avgVal'];
}
$message = array('success' => $success, 'error' => $error, 'avg' => $avg);
echo json_encode($message);
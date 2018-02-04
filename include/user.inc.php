<?php
function getSessionUser()
{
	$userInfo = [];
	if (isset($_SESSION['user_id'])) {
		$userInfo['user_id'] = $_SESSION['user_id'];	
	}
	return $userInfo;
}

function getSessionRigths()
{
  $userInfo = [];
  if (isset($_SESSION['rights'])) {
    $userInfo['rights'] = $_SESSION['rights'];  
  }
  return $userInfo;
}

function findUserByLogin($login, $pass)
{
	$userInfo = [];
	$query = "SELECT u.user_id, u.rights
	          FROM users u
	          WHERE u.login='" . dbQuote($login) . "'
	          AND u.password='" . dbQuote(md5($pass)) . "';";
	$result = dbQueryGetResult($query);
	if (!empty($result)) {
		$userInfo = $result[0];
	}
	return $userInfo;
}

function isLogin()
{
  return isset($_SESSION['user_id']);
}

function saveSessionUser($userInfo)
{
    $_SESSION['user_id'] = $userInfo['user_id'];
    $_SESSION['rights'] = $userInfo['rights'];
}

function deleteUserInfo()
{
  unset($_SESSION['user_id']);
  unset($_SESSION['rights']);
}

function requireAuth()
{
    $userInfo = getSessionUser();
    if(empty($userInfo)) {
    	header("Location:/library/login.php");
    	exit(0);
    }
}

function requireRights()
{
  $userRights = getSessionRigths();
  if(empty($userRights)) {
      header("Location:/library/login.php");
      exit(0);
  } else if($userRights['rights'] == 'user') {
    header("Location:/library/profile.php");
      exit(0);
  }
}


function getUserList()
{
    $query = "SELECT login AS item
              FROM users
              GROUP BY  user_id;";
    return dbQueryGetResult($query); 
}

function getMailList()
{
    $query = "SELECT e_mail AS item
              FROM users
              GROUP BY  user_id;";
    return dbQueryGetResult($query); 
}

function checkLogin($login)
{
    $query = "SELECT user_id
              FROM users 
              WHERE login='" . dbQuote($login) . "';";
    $result = dbQueryGetResult($query);
    return empty($result);
}

function addUser($login, $mail, $pass)
{
	  $query = "INSERT INTO users
	          (login, e_mail, password, registration_date)
            VALUES
            ('" . dbQuote($login) . "', '" . dbQuote($mail) . "', '" . dbQuote(md5($pass)) . "', NOW());";
    return dbQuery($query);
}

function getUserId($login)
{
    $query = "SELECT u.user_id AS id
              FROM users u
              WHERE u.login='" . dbQuote($login) . "';";
    $result = dbQueryGetResult($query)[0];
    return $result['id'];
}

function getLoginById($userId)
{
    $query = "SELECT u.login AS login
              FROM users u
              WHERE u.user_id='" . dbQuote($userId) . "';";
    $result = dbQueryGetResult($query)[0];
    return $result['login'];
}

function getAuthInfo()
{
  $status = isLogin();
  $login = '';
  $userId = '';
  $userRight = '';
  $userInfo = getSessionUser();
  $userRights = getSessionRigths();
  if (!empty($userInfo))
  {
    $userId = $userInfo['user_id'];
    $login = getLoginById($userId);
    $userRight = $userRights['rights'];
  }
  return array('status' => $status,
               'login' => $login,
               'id' => $userId,
               'rights' => $userRight);
}

function loginEdit($userId, $login)
{
    $query = "UPDATE users
              SET login='" . dbQuote($login) . "'
              WHERE user_id=" . $userId . ";";
    return dbQuery($query);
}

function emailEdit($userId, $email)
{
    $query = "UPDATE users
              SET e_mail='" . dbQuote($email) . "'
              WHERE user_id=" . $userId . ";";
    return dbQuery($query);
}

function passEdit($userId, $pass)
{
    $query = "UPDATE users
              SET password='" . dbQuote(md5($pass)) . "'
              WHERE user_id=" . $userId . ";";
    return dbQuery($query);
}

function userDelete($userId)
{
    $query = "DELETE FROM users
              WHERE user_id=" . $userId . ";";
    return dbQuery($query);
}

function deleteUserFromMarks($userId)
{
    $query = "DELETE FROM marks
              WHERE user_id=" . $userId . ";";
    return dbQuery($query);
}

function deleteUserFromComment($userId)
{
    $query = "DELETE FROM comments
              WHERE user_id=" . $userId . ";";
    return dbQuery($query);
}

function getUserDate($userId)
{  
    $query = "SELECT login, first_name, last_name, e_mail, user_image
              FROM users
              WHERE user_id=" . $userId . ";";
    return dbQueryGetResult($query)[0];            
}

function firstNameEdit($firstName, $userId)
{
    $query = "UPDATE users
              SET first_name='" . dbQuote($firstName) . "'
              WHERE user_id=" . $userId . ";";
    return dbQuery($query);
}

function lastNameEdit($lastName, $userId)
{
    $query = "UPDATE users
              SET last_name='" . dbQuote($lastName) . "'
              WHERE user_id=" . $userId . ";";
    return dbQuery($query); 
}

function addUserImageToDB($fileName, $userId)
{
    $query = "UPDATE users
              SET user_image='" . dbQuote($fileName) . "'
              WHERE user_id=" . $userId . ";";
    return dbQuery($query);
}
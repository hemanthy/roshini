<?php
session_start();

// include_once ('OrderDetailsPOJO.php');
include_once ('dbconnect.php');
include ('/pojo/UserDetailsPOJO.php');
include ('/Impl/UserReportImpl.php');
include ('/Impl/UserTransactionImpl.php');

$user_id = '';
if(isset($_SESSION['usr_id'])!="") {
    $user_id = $_SESSION['usr_id'];
}

if (isset($_SESSION['usr_id'])) {
	$GLOBALS['user_id'] =   $_SESSION['usr_id'];
}

$userReportArray = getUserReportDetails($conn);

$userTransactionDetails = getUserTransactionDetails($conn);

echo json_encode(array('utds' => $userTransactionDetails,'usrReportArray' => $userReportArray));

//echo  json_encode($userReportArray);

?>
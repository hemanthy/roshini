<?php
session_start();

include_once 'dbconnect.php';
include_once 'pojo/UserDetailsPOJO.php';
include_once 'Impl/UserReportImpl.php';
include_once 'Impl/UserTransactionImpl.php';


if (isset($_SESSION['usr_id'])) {
	$GLOBALS['user_id'] =   $_SESSION['usr_id'];
}

$userReportArray = getUserReportDetails($conn);

$userTransactionDetails = getUserTransactionDetails($conn);

echo json_encode(array('utds' => $userTransactionDetails,'usrReportArray' => $userReportArray));

//echo  json_encode($userReportArray);

?>
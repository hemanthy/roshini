<?php
session_start();

include_once 'dbconnect.php';
include_once 'pojo/UserDetailsPOJO.php';
include_once 'Impl/UserReportImpl.php';
include_once 'Impl/UserTransactionImpl.php';

include_once 'writemysqllog.php';


if (isset($_SESSION['usr_id'])) {
	$GLOBALS['user_id'] =   $_SESSION['usr_id'];
}

try {

	$userReportArray = getUserReportDetails($conn);

	$userTransactionDetails = getUserTransactionDetails($conn);

	echo json_encode(array('utds' => $userTransactionDetails,'usrReportArray' => $userReportArray));

} catch (Exception $e) {
	write_mysql_log($e->getMessage(),$conn);
}


//echo  json_encode($userReportArray);

?>
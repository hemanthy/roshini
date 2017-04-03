<?php
session_start();

include_once 'dbconnect.php';
include_once 'pojo/UserDetailsPOJO.php';
include_once 'Impl/UserPaymentImpl.php';
include_once 'Impl/UserTransactionImpl.php';

 if (isset($_SESSION['usr_id'])) {
	$GLOBALS['user_id'] =   $_SESSION['usr_id'];
}


$account_name = '';
$bank_name = '';
$bank_number = '';
$ifsc_code = '';
$paytm_mobile_number ='';
$is_paytm_active = false;
$_POST = json_decode(file_get_contents('php://input'), true);

 if (isset($_POST['getUserAmountDetails'])) {
    $paymentDetails = getUserPaymentDetails($conn);
    $paymentDetails1 = getUserTransactionDetails($conn);
    $paymentDetails ->setAvailableamount($paymentDetails1->getAvailableamount());
    echo json_encode($paymentDetails);
    return;
}else{
	$udp = new UserDetailsPOJO();
	
	$udp->setPdoconn($conn);
	
	if (isset($_POST['accountname']) || isset($_POST['ispaytmactive'])) {
		
		if(isset($_POST['accountname'])){
			$account_name = mysqli_real_escape_string($con, $_POST['accountname']);
			//$userDetailsPojo->setAccountname($account_name);
			$udp->setAccountname($account_name);
		}
		if(isset($_POST['bankname'])){
			$bank_name = mysqli_real_escape_string($con, $_POST['bankname']);
			//$userDetailsPojo->setBankname($bank_name);
			$udp->setBankname($bank_name);
		}
		if(isset($_POST['banknumber'])){
			$bank_number = mysqli_real_escape_string($con, $_POST['banknumber']);
			$udp->setBanknumber($bank_number);
		}
		if(isset($_POST['ifsccode'])){
			$ifsc_code = mysqli_real_escape_string($con, $_POST['ifsccode']);
			$udp->setIfsccode($ifsc_code);
		}
		if(isset($_POST['paytmnumber'])){
			$paytm_mobile_number = mysqli_real_escape_string($con, $_POST['paytmnumber']);
			$udp->setPaytmnumber($paytm_mobile_number);
		}
		if(isset($_POST['ispaytmactive'])){
			$is_paytm_active = mysqli_real_escape_string($con, $_POST['ispaytmactive']);
			$udp->setIspaytmactive($is_paytm_active);
		}
	
		saveUserPaymentDetails($udp);
	
	}else{
	
 	 	$result = getUserPaymentDetails($udp->getPdoconn());
		echo  json_encode($result); 
		 
	}
	

}


/* function saveUserPaymentDetails1(UserDetailsPOJO $udp){
	try{
		//	echo $GLOBALS['user_id'];
		$sql = "INSERT INTO user_payment_details(account_name,bank_name,bank_number,ifsc_code,paytm_mobile_number,is_paytm_active,user_id)
VALUES(:account_name,:bank_name,:bank_number,:ifsc_code,:paytm_mobile_number,:is_paytm_active,:user_id);";
		$getPdoconn = $udp->getPdoconn();
		$stmt = $getPdoconn->prepare($sql);
		$stmt->bindParam(':account_name', $udp->getAccountname(), PDO::PARAM_STR);
		$stmt->bindParam(':bank_name', $udp->getBankname(), PDO::PARAM_INT);
		$stmt->bindParam(':bank_number', $udp->getBanknumber(), PDO::PARAM_INT);
		$stmt->bindParam(':ifsc_code', $udp->getIfsccode(), PDO::PARAM_INT);
		$stmt->bindParam(':paytm_mobile_number', $udp->getPaytmnumber(), PDO::PARAM_INT);
		$stmt->bindParam(':is_paytm_active', $udp->getIspaytmactive(), PDO::PARAM_INT);
		$stmt->bindParam(':user_id', $GLOBALS['user_id'], PDO::PARAM_INT);
		$stmt->execute();
	}
	catch(PDOException $e)
	{
		error_log("Error occur while saving user_payment_details ".$e->getMessage().$GLOBALS['user_id']);
	}
}
 */

 
//$userReportPOJO = new UserReportPOJO();
//$userPaymentImpl =  new UserPaymentImpl();

//$userDetailsPojo = new UserReportPOJO();




?>
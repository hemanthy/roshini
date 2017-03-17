<?php
session_start();
// include_once ('OrderDetailsPOJO.php');
include_once ('dbconnect.php');

include ('/pojo/UserDetailsPOJO.php');

include('/Impl/UserPaymentImpl.php');

include ('/Impl/UserTransactionImpl.php');


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
}

$userDetailsPojo = new UserDetailsPOJO();

if (isset($_POST['accountname']) || isset($_POST['ispaytmactive'])) {
	
if(isset($_POST['accountname'])){
	$account_name = mysqli_real_escape_string($con, $_POST['accountname']);
	$userDetailsPojo->setAccountname($account_name);
}
if(isset($_POST['bankname'])){
	$bank_name = mysqli_real_escape_string($con, $_POST['bankname']);
	$userDetailsPojo->setBankname($bank_name);
}
if(isset($_POST['banknumber'])){
	$bank_number = mysqli_real_escape_string($con, $_POST['banknumber']);
	$userDetailsPojo->setBanknumber($bank_number);
}
if(isset($_POST['ifsccode'])){
	$ifsc_code = mysqli_real_escape_string($con, $_POST['ifsccode']);
	$userDetailsPojo->setIfsccode($ifsc_code);
}
if(isset($_POST['paytmnumber'])){
	$paytm_mobile_number = mysqli_real_escape_string($con, $_POST['paytmnumber']);
	$userDetailsPojo->setPaytmnumber($paytm_mobile_number);
}
if(isset($_POST['ispaytmactive'])){
	$is_paytm_active = mysqli_real_escape_string($con, $_POST['ispaytmactive']);
	$userDetailsPojo->setIspaytmactive($is_paytm_active);
}

saveUserPaymentDetails($conn,$userDetailsPojo);

}else{
	
$result = getUserPaymentDetails($conn);
echo  json_encode($result);
   
}


?>
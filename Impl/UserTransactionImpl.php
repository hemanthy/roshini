    <?php
/**
 * Created by PhpStorm.
 * User: heman
 * Date: 2/15/2017
 * Time: 4:57 PM
 */

// session_start();
    
//include_once ('dbconnect.php');

//include ('/pojo/UserDetailsPOJO.php');
    

function getUserTransactionDetails($conn){
	$stmt2 = $conn->prepare("select * from user_transaction_details utd where user_id =:user_id order by payment_requested_date desc limit 0,1");
	$stmt2->execute(array(':user_id' => $GLOBALS['user_id']));
	$usrResult = $stmt2->fetchAll();
	try {
		
		$userDetailsPojo = new UserDetailsPOJO();
		foreach ($usrResult as $row) {
			$availableAmount = $row['available_amount'];
			$paymentRequestedAmount = $row['payment_requested_amount'];
			$pending_amount = $row['pending_amount'];
			$redemption_amount = $row['redemption_amount'];
			$payment_request_status = $row['payment_request_status'];
			$payment_requested_date = $row['payment_requested_date'];
			$payment_approved_date = $row['payment_approved_date'];
			$userDetailsPojo->setAvailableAmount($availableAmount);
			$userDetailsPojo->setPaymentRequestedAmount($paymentRequestedAmount);
			$userDetailsPojo->setPendingBal($pending_amount);
			$userDetailsPojo->setRedemptionMade($redemption_amount);
			if($availableAmount!=null){
				break;
			}
			//  array_push($userPaymentArray, $userTransactionHistory);
		}
		return $userDetailsPojo;
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
}

function saveUserTransactionHistory($conn,$userDetailsPojo){
	$stmt1 = $conn->prepare("insert into user_transaction_history (payment_requested_amount,payment_mode,payment_request_status,user_id,payment_approved_date)
    VALUES (:payment_requested_amount,:payment_mode,:payment_request_status,:user_id,:payment_approved_date);");
	$stmt1->execute(array(':payment_requested_amount' => $userDetailsPojo -> getPaymentRequestedAmount(),
			'payment_mode' => $userDetailsPojo -> getPaymentMode(),
			':payment_request_status' => 'pending',
			':user_id' =>  $GLOBALS['user_id'],
			':payment_approved_date' => null));
}


function getUserTransactionHistory($conn) {

	$stmt2 = $conn->prepare("select * from user_transaction_history where user_id =:user_id order by id desc ");
	$stmt2->execute(array(':user_id' => $GLOBALS['user_id']));

	$usrResult = $stmt2->fetchAll();

	try {
		$userTransactionHistoryArray = array();
		foreach ($usrResult as $row) {
			$userDetails = new UserDetailsPOJO();
			$paymentReqAmount = $row['payment_requested_amount'];
			$paymentReqStatus = $row['payment_request_status'];
			$paymentReqDate = $row['payment_requested_date'];
			$paymentMode = $row['payment_mode'];
			$userDetails->setPaymentRequestedAmount($paymentReqAmount);
			$userDetails->setPaymentReqStatus($paymentReqStatus);
			$userDetails->setPaymentReqDate($paymentReqDate);
			$userDetails->setPaymentMode($paymentMode);
			array_push($userTransactionHistoryArray, $userDetails);
		}
		return $userTransactionHistoryArray;
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
}

?>
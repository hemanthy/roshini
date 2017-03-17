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
	$user_id = '';
	if (isset($_SESSION['usr_id'])) {
		$user_id = $_SESSION['usr_id'];
	}
	$stmt2 = $conn->prepare("select * from user_transaction_details utd where user_id =:user_id order by payment_requested_date desc");
	$stmt2->execute(array(':user_id' => $user_id));
	$usrResult = $stmt2->fetchAll();
	try {
		
		$userDetailsPojo = new UserDetailsPOJO();
		foreach ($usrResult as $row) {
			$availableAmount = $row['available_amount'];
			$userDetailsPojo->setAvailableAmount($availableAmount);
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
			$userDetails->setPaymentRequestedAmount($paymentReqAmount);
			$userDetails->setPaymentReqStatus($paymentReqStatus);
			$userDetails->setPaymentReqDate($paymentReqDate);
			array_push($userTransactionHistoryArray, $userDetails);
		}
		return $userTransactionHistoryArray;
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
}

?>
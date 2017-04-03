    <?php
/**
 * Created by PhpStorm.
 * User: heman
 * Date: 2/15/2017
 * Time: 4:57 PM
 */

//session_start();
    
include_once ('dbconnect.php');

//include ('../pojo/UserDetailsPOJO.php');
    
// include_once 'pojo/UserDetailsPOJO.php';
    
function getUserPaymentDetails($conn){
	$user_id = '';
	if (isset($_SESSION['usr_id'])) {
		$user_id = $_SESSION['usr_id'];
	}
	
//	$conn = $udp->getPdoconn();
	$stmt2 = $conn->prepare("select * from user_payment_details upd where upd.user_id =:user_id order by upd.updated_date desc limit 0,1;");
	$stmt2->execute(array(':user_id' => $user_id));
	$usrResult = $stmt2->fetchAll();
	try {
		$userDetailsPojo = new UserDetailsPOJO();
		foreach ($usrResult as $row) {
		
			$account_name = $row['account_name'];
			$bank_name = $row['bank_name'];
			$bank_number = $row['bank_number'];
			$ifsc_code = $row['ifsc_code'];
			$paytm_mobile_number = $row['paytm_mobile_number'];
			$is_paytm_active = $row['is_paytm_active'];
			
			
			$userDetailsPojo -> setAccountname($account_name);
			$userDetailsPojo -> setBankname($bank_name);
			$userDetailsPojo -> setBanknumber($bank_number);
			$userDetailsPojo -> setIfsccode($ifsc_code);
			$userDetailsPojo -> setPaytmnumber($paytm_mobile_number);
			$userDetailsPojo -> setIspaytmactive($is_paytm_active);
			if($is_paytm_active){
				$userDetailsPojo -> setPaymentMode('paytm');
			}else{
				$userDetailsPojo -> setPaymentMode('Bank');
			}
		}
		return $userDetailsPojo;
	} catch (PDOException $e) {
		//echo "Error: " . $e->getMessage();
		//error_log("Error occur while getting user_payment_details details ".$e->getMessage().$user_id);
	}
}

function saveUserPaymentDetails(UserDetailsPOJO $udp){
	try{
	//	echo $GLOBALS['user_id'];
		 $sql = "INSERT INTO user_payment_details(account_name,bank_name,bank_number,ifsc_code,paytm_mobile_number,is_paytm_active,user_id)
VALUES(:account_name,:bank_name,:bank_number,:ifsc_code,:paytm_mobile_number,:is_paytm_active,:user_id);";
		 $conn = $udp->getPdoconn();
		$stmt = $conn->prepare($sql);
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


/* function getUserPaymentDetails($conn){
	$user_id = '';
	if (isset($_SESSION['usr_id'])) {
		$user_id = $_SESSION['usr_id'];
	}
	$stmt = $conn->prepare("select * from user_payment_details where user_id=:user_id order by updated_date desc limit 0,1;");
	$stmt->execute(array(':user_id' => $user_id));
	$result = $stmt->fetchAll();
	try{
		$pd = new UserDetailsPOJO();
		foreach($result as $row){
			$account_name = $row['account_name'];
			$bank_name = $row['bank_name'];
			$bank_number = $row['bank_number'];
			$ifsc_code = $row['ifsc_code'];
			$paytm_mobile_number = $row['paytm_mobile_number'];
			$is_paytm_active = $row['is_paytm_active'];
	
	
			$pd -> setAccountname($account_name);
			$pd -> setBankname($bank_name);
			$pd -> setBanknumber($bank_number);
			$pd -> setIfsccode($ifsc_code);
			$pd -> setPaytmnumber($paytm_mobile_number);
			$pd -> setIspaytmactive($is_paytm_active);
			return $pd;
		}
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
} */

?>
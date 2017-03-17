    <?php
/**
 * Created by PhpStorm.
 * User: heman
 * Date: 2/15/2017
 * Time: 4:57 PM
 */

// session_start();
    
//include_once ('dbconnect.php');

//include ('../pojo/UserDetailsPOJO.php');
    
    
function getUserPaymentDetails($conn){
	$user_id = '';
	if (isset($_SESSION['usr_id'])) {
		$user_id = $_SESSION['usr_id'];
	}
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
		
		/* 
			$bankNumber = $row['bank_number'];
			$accountName = $row['account_name'];
		//	$availableAmount = $row['available_amount'];
			$paytm_mobile_number = $row['paytm_mobile_number'];
			$is_paytm_active = $row['is_paytm_active'];

			$userDetailsPojo->setBanknumber($bankNumber);
			$userDetailsPojo->setAccountname($accountName);
			//$userDetailsPojo->setAvailableAmount($availableAmount);
			$userDetailsPojo->setPaytmnumber($paytm_mobile_number);
			$userDetailsPojo->setIspaytmactive($is_paytm_active);
			 

			if($bankNumber!=null && $accountName!=null){
				break;
			} */
			//  array_push($userPaymentArray, $userTransactionHistory);
		}
		return $userDetailsPojo;
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
}

function saveUserPaymentDetails($conn,$userDetailsPojo){
	try{
		$sql = "INSERT INTO user_payment_details(account_name,bank_name,bank_number,ifsc_code,paytm_mobile_number,is_paytm_active,user_id)
VALUES(:account_name,:bank_name,:bank_number,:ifsc_code,:paytm_mobile_number,:is_paytm_active,:user_id);";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':account_name', $userDetailsPojo->getAccountname(), PDO::PARAM_STR);
		$stmt->bindParam(':bank_name', $userDetailsPojo->getBankname(), PDO::PARAM_INT);
		$stmt->bindParam(':bank_number', $userDetailsPojo->getBanknumber(), PDO::PARAM_INT);
		$stmt->bindParam(':ifsc_code', $userDetailsPojo->getIfsccode(), PDO::PARAM_INT);
		$stmt->bindParam(':paytm_mobile_number', $userDetailsPojo->getPaytmnumber(), PDO::PARAM_INT);
		$stmt->bindParam(':is_paytm_active', $userDetailsPojo->getIspaytmactive(), PDO::PARAM_INT);
		$stmt->bindParam(':user_id', $GLOBALS['user_id'], PDO::PARAM_INT);
		$stmt->execute();
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
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
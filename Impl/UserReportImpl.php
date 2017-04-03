<?php


function getUserReportDetails($conn){
	//$stmt = $conn->prepare("select * from user_store_order_details where aff_ext_param1=:aff_ext_param1;");
	$stmt = $conn->prepare("select * from user_report_details as urd where urd.user_id =:user_id;");
	//$stmt->bindParam(':aff_ext_param1',39152399);
	$stmt->execute(array(':user_id' => $GLOBALS['user_id']));
	//$stmt->execute();
	$result = $stmt->fetchAll();
	//$q->setFetchMode(PDO::FETCH_ASSOC);
	
	try{
		$userReportArray = array();
	
		foreach($result as $row){
	
			$userDetailsPojo = new UserDetailsPOJO();
			$userDetailsPojo -> setOrderDate($row['order_date']);
			$userDetailsPojo -> setStoreName($row['store_name']);
			if($row['cashback']!=null && $row['cashback'] > 0){
				$userDetailsPojo -> setCashback($row['cashback']);
			}else{
				continue;
			}
			$userDetailsPojo -> setStatus($row['status']);
	
			array_push($userReportArray,$userDetailsPojo);
		}
		return $userReportArray;
	}
	catch(PDOException $e)
	{
		//echo "Error: " . $e->getMessage();
		//error_log("Error occur while getting user_report_details ".$e->getMessage().$GLOBALS['user_id']);
	}
}

?>
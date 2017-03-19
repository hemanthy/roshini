<?php


// calcuate pending cashback
foreach ($userPojoArray as $userPojo) {
	$stmt1 = $conn->prepare("select sum(cashback) as pendingcashback from user_report_details where user_reference_code =:user_reference_code and status='pending';");
	$stmt1->execute(array(':user_reference_code' => $userPojo->getUserReferenceCode()));
	$result = $stmt1->fetchAll();
	foreach($result as $row) {
		$pendingcashback =  $row['pendingcashback'];
		if($pendingcashback!=null){
			$stmt2 = $conn->prepare("select * from user_transaction_details where user_id =:userId;");
			$stmt2->execute(array(':userId' => $userPojo->getUsrId()));
			$result2 = $stmt2->fetchAll();
			if($result2!=null && !empty($result2) && count($result2) > 0){
				$stmt3 = $conn->prepare("UPDATE user_transaction_details SET pending_amount=:pendingcashback WHERE user_id=:userId;");
				$stmt3->execute(array(':pendingcashback' => $pendingcashback,':userId' => $userPojo->getUsrId()));
			}else{
				$stmt3 = $conn->prepare("INSERT INTO user_transaction_details(pending_amount,user_id) VALUES(:pendingcashback,:userId);");
				$stmt3->execute(array(':pendingcashback' => $pendingcashback,':userId' => $userPojo->getUsrId()));
			}
		}else {
			$stmt3 = $conn->prepare("UPDATE user_transaction_details SET pending_amount=:pendingcashback WHERE user_id=:userId;");
			$stmt3->execute(array(':pendingcashback' => $pendingcashback,':userId' => $userPojo->getUsrId()));
		}
	}
}

// calcuate proccessed cashback
foreach ($userPojoArray as $userPojo) {
	$stmt1 = $conn->prepare("select sum(cashback) as approvedcashback from user_report_details where user_reference_code =:user_reference_code and status='approved';");
	$stmt1->execute(array(':user_reference_code' => $userPojo->getUserReferenceCode()));
	$result = $stmt1->fetchAll();
	foreach($result as $row) {
		$approvedcashback =  $row['approvedcashback'];
		if($approvedcashback!=null){
			$stmt2 = $conn->prepare("select * from user_transaction_details where user_id =:userId;");
			$stmt2->execute(array(':userId' => $userPojo->getUsrId()));
			$result2 = $stmt2->fetchAll();
			if($result2!=null && !empty($result2) && count($result2) > 0){
				$stmt3 = $conn->prepare("UPDATE user_transaction_details SET available_amount=:approvedcashback WHERE user_id=:userId;");
				$stmt3->execute(array(':approvedcashback' => $approvedcashback,':userId' => $userPojo->getUsrId()));
			}else{
				$stmt3 = $conn->prepare("INSERT INTO user_transaction_details(available_amount,user_id) VALUES(:approvedcashback,:userId);");
				$stmt3->execute(array(':approvedcashback' => $approvedcashback,':userId' => $userPojo->getUsrId()));
			}
		}else{
			$stmt3 = $conn->prepare("UPDATE user_transaction_details SET available_amount=:approvedcashback WHERE user_id=:userId;");
			$stmt3->execute(array(':approvedcashback' => $approvedcashback,':userId' => $userPojo->getUsrId()));
		}
	}
}

?>
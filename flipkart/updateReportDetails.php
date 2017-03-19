<?php


// include_once ('OrderDetailsPOJO.php');
include ('../dbconnect.php');
// include ('../pojo/UserDetailsPOJO.php');

function getUserList($conn){
    $stmt = $conn->prepare("select * from user;");
    $stmt->execute();
    $result = $stmt->fetchAll();
    $userPojoArray = array();
    foreach($result as $row) {
   	  $userPojo = new UserDetailsPOJO();
      $userRefCode =  $row['user_reference_code'];
      $usrId =  $row['id'];
   	  $userPojo->setUserReferenceCode($userRefCode);
   	  $userPojo->setUsrId($usrId);
      array_push($userPojoArray,$userPojo);
    }
    return $userPojoArray;
}

$userPojoArray = getUserList($conn);

foreach ($userPojoArray as $userPojo) {

//$stmt = $conn->prepare("select * from user_store_order_details where aff_ext_param1=:aff_ext_param1;");
    $stmt = $conn->prepare("select *,u.id as user_id, str.store_name as store_name from user_store_order_details as sod , store as str inner join user as u 
where sod.aff_ext_param1=:aff_ext_param1 and u.user_reference_code=:user_reference_code and  sod.store_id = str.id;");
//$stmt->bindParam(':aff_ext_param1',39152399);
    $stmt->execute(array(':user_reference_code' => $userPojo->getUserReferenceCode(),':aff_ext_param1'=>  $userPojo->getUserReferenceCode()));
//$stmt->execute();
    $result = $stmt->fetchAll();
//$q->setFetchMode(PDO::FETCH_ASSOC);

    if(count($result) == 0){
        echo 'zero count';
        continue;
    }

    try{
        foreach($result as $row){
            echo $row['commission_rate'];
            echo $row['tentative_commission_amount'];
            //  echo $row['status_type'];
            // echo $row['user_reference_code'];
            echo $row['order_date'];
            //	echo $row['store_name'];

            $stmt1 = $conn->prepare("INSERT INTO user_report_details(order_date,store_name,cashback,status,user_reference_code,affiliate_order_id,user_id,store_id) VALUES(:order_date,:store_name,:cashback,:status,:user_reference_code,:affiliate_order_id,:user_id,:store_id) ON DUPLICATE KEY UPDATE order_date =:order_date,store_name=:store_name,cashback=:cashback,status=:status,user_reference_code=:user_reference_code,affiliate_order_id=:affiliate_order_id,user_id=:user_id,store_id=:store_id");

            $stmt1->bindParam(':order_date', $row['order_date'], PDO::PARAM_STR);
            $stmt1->bindParam(':store_name', $row['store_name'], PDO::PARAM_STR);
            $stmt1->bindParam(':cashback', $row['tentative_commission_amount'], PDO::PARAM_STR);
            if($row['status_type']=='pending' || $row['status_type']=='tentative'){
            	$status = 'pending';
	            $stmt1->bindParam(':status', $status, PDO::PARAM_STR);
            }else if($row['status_type']=='processed'){
            	$status = 'approved';
	            $stmt1->bindParam(':status', $status, PDO::PARAM_STR);
            }else {
            	$stmt1->bindParam(':status', $row['status_type'], PDO::PARAM_STR);
            }
            $stmt1->bindParam(':user_reference_code', $row['user_reference_code'], PDO::PARAM_STR);
            $stmt1->bindParam(':affiliate_order_id', $row['affiliate_order_id'], PDO::PARAM_STR);
            $stmt1->bindParam(':user_id', $row['user_id'], PDO::PARAM_STR);
            $stmt1->bindParam(':store_id', $row['store_id'], PDO::PARAM_STR);
            $stmt1->execute();
        }
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
}

include ('calculateUsrPendingAndApprovedCB.php');
?>
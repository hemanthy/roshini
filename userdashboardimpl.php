<?php
session_start();

// include_once ('OrderDetailsPOJO.php');
include_once ('dbconnect.php');
include_once ('/pojo/UserReportPOJO.php');


$user_id = '';
if(isset($_SESSION['usr_id'])!="") {
    $user_id = $_SESSION['usr_id'];
}
//$stmt = $conn->prepare("select * from user_store_order_details where aff_ext_param1=:aff_ext_param1;");
$stmt = $conn->prepare("select * from user_report_details as urd where urd.user_id =:user_id;");
//$stmt->bindParam(':aff_ext_param1',39152399);
$stmt->execute(array(':user_id' => $user_id));
$stmt->execute();
$result = $stmt->fetchAll();
//$q->setFetchMode(PDO::FETCH_ASSOC);

try{
    $userReportArray = array();

    foreach($result as $row){

        $userReportPojo = new UserReportPOJO();
        $userReportPojo -> setOrderDate($row['order_date']);
        $userReportPojo -> setStoreName($row['store_name']);
        if($row['cashback']!=null && $row['cashback'] > 0){
            $userReportPojo -> setCashback($row['cashback']);
        }else{
            continue;
        }
        $userReportPojo -> setStatus($row['status']);

        array_push($userReportArray,$userReportPojo);
        }

      echo  json_encode($userReportArray);
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}





?>
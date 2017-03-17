<?php
session_start();

include_once ('dbconnect.php');
include ('/pojo/UserReportPOJO.php');

include ('/pojo/UserDetailsPOJO.php');
include ('/Impl/UserTransactionImpl.php');


$_POST = json_decode(file_get_contents('php://input'), true);

$user_id = '';
$availableAmount = '';

if(isset($_SESSION['usr_id'])!="") {
    $user_id = $_SESSION['usr_id'];
}

if (isset($_SESSION['usr_id'])) {
	$GLOBALS['user_id'] =   $_SESSION['usr_id'];
}

if (isset($_POST['isUsrTransactionHistory'])) {
	$userTransactionHistoryArray =  getUserTransactionHistory($conn);
        echo json_encode($userTransactionHistoryArray);
        return ;
}

$withdrawAmount = mysqli_real_escape_string($con, $_POST['withdrawAmount']);

//$stmt = $conn->prepare("select * from user_store_order_details where aff_ext_param1=:aff_ext_param1;");
$stmt = $conn->prepare("select * from user_transaction_details where user_id =:user_id");
//$stmt->bindParam(':aff_ext_param1',39152399);
$stmt->execute(array(':user_id' => $user_id));
//$stmt->execute();
$usrTransactionDetails = $stmt->fetchAll();
//$q->setFetchMode(PDO::FETCH_ASSOC);

try{
    $userReportArray = array();
    foreach($usrTransactionDetails as $row) {
        $availableAmount = $row['available_amount'];
    }
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}

/* $userTransactionHistoryArray =  getUserTransactionHistory($conn);
echo json_encode($userTransactionHistoryArray);
 */

if($availableAmount >= $withdrawAmount){
    $stmt = $conn->prepare("update user_transaction_details set payment_requested_amount =:withdrawAmount where user_id =:user_id");
    $stmt->execute(array(':withdrawAmount' => $withdrawAmount,':user_id' => $user_id));
    
    $stmt = $conn->prepare("update user_transaction_history set payment_request_status = 'cancel' where user_id =:user_id;");
    $stmt->execute(array(':user_id' => $user_id));

    $stmt1 = $conn->prepare("insert into user_transaction_history (payment_requested_amount,payment_request_status,user_id,payment_approved_date) 
    VALUES (:payment_requested_amount,:payment_request_status,:user_id,:payment_approved_date);");
    $stmt1->execute(array(':payment_requested_amount' => $withdrawAmount,
        ':payment_request_status' => 'pending',
        ':user_id' => $user_id,
        ':payment_approved_date' => null));

    echo "Withdraw Request Updated !!!";

}else{
    echo "Withdraw Amount is lesser than Available amount";
}

?>
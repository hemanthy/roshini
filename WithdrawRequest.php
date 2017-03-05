<?php
session_start();

include_once ('dbconnect.php');
include_once ('/pojo/UserReportPOJO.php');

$_POST = json_decode(file_get_contents('php://input'), true);

$user_id = '';
$availableAmount = '';
if(isset($_SESSION['usr_id'])!="") {
    $user_id = $_SESSION['usr_id'];
}

if (isset($_POST['isUsrTransactionHistory'])) {
   // if($isUsrTransactionHistory){
        getUserTransactionHistory($conn,$user_id);
        return ;
    //}
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

/**
 * @param $conn
 * @param $user_id
 */
function getUserTransactionHistory($conn, $user_id) {

    $stmt2 = $conn->prepare("select * from user_transaction_history where user_id =:user_id order by payment_requested_date desc ");
    $stmt2->execute(array(':user_id' => $user_id));

    $usrResult = $stmt2->fetchAll();

    try {
        $userTransactionHistoryArray = array();
        foreach ($usrResult as $row) {
            $usrTransctionHistory = new UserTransactionHistory();
            $paymentReqAmount = $row['payment_requested_amount'];
            $paymentReqStatus = $row['payment_request_status'];
            $paymentReqDate = $row['payment_requested_date'];
            $usrTransctionHistory->setPaymentRequestedAmount($paymentReqAmount);
            $usrTransctionHistory->setPaymentReqStatus($paymentReqStatus);
            $usrTransctionHistory->setPaymentReqDate($paymentReqDate);
            array_push($userTransactionHistoryArray, $usrTransctionHistory);
        }
        echo json_encode($userTransactionHistoryArray);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if($availableAmount >= $withdrawAmount){
    $stmt = $conn->prepare("update user_transaction_details set payment_requested_amount =:withdrawAmount where user_id =:user_id");
    $stmt->execute(array(':withdrawAmount' => $withdrawAmount,':user_id' => $user_id));

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

class UserTransactionHistory{

    var $paymentRequestedAmount;
    var $paymentReqStatus;
    var $paymentReqDate;
    var $AvailableAmount;
    var $BankNumber;
    var $AccountName;

    /**
     * @return mixed
     */
    public function getPaymentRequestedAmount()
    {
        return $this->paymentRequestedAmount;
    }

    /**
     * @param mixed $paymentRequestedAmount
     */
    public function setPaymentRequestedAmount($paymentRequestedAmount)
    {
        $this->paymentRequestedAmount = $paymentRequestedAmount;
    }

    /**
     * @return mixed
     */
    public function getPaymentReqStatus()
    {
        return $this->paymentReqStatus;
    }

    /**
     * @param mixed $paymentReqStatus
     */
    public function setPaymentReqStatus($paymentReqStatus)
    {
        $this->paymentReqStatus = $paymentReqStatus;
    }

    /**
     * @return mixed
     */
    public function getPaymentReqDate()
    {
        return $this->paymentReqDate;
    }

    /**
     * @param mixed $paymentReqDate
     */
    public function setPaymentReqDate($paymentReqDate)
    {
        $this->paymentReqDate = $paymentReqDate;
    }

    /**
     * @return mixed
     */
    public function getAvailableAmount()
    {
        return $this->AvailableAmount;
    }

    /**
     * @param mixed $AvailableAmount
     */
    public function setAvailableAmount($AvailableAmount)
    {
        $this->AvailableAmount = $AvailableAmount;
    }

    /**
     * @return mixed
     */
    public function getBankNumber()
    {
        return $this->BankNumber;
    }

    /**
     * @param mixed $BankNumber
     */
    public function setBankNumber($BankNumber)
    {
        $this->BankNumber = $BankNumber;
    }

    /**
     * @return mixed
     */
    public function getAccountName()
    {
        return $this->AccountName;
    }

    /**
     * @param mixed $AccountName
     */
    public function setAccountName($AccountName)
    {
        $this->AccountName = $AccountName;
    }
}
?>
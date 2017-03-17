<?php
session_start();
// include_once ('OrderDetailsPOJO.php');
include_once ('dbconnect.php');

$_POST = json_decode(file_get_contents('php://input'), true);

if (isset($_POST['getUserAmountDetails'])) {
    $paymentDetails = getUserPaymentDetails($conn);
    $paymentDetails1 = getUserTransactionDetails($conn);
    $paymentDetails ->setAvailableamount($paymentDetails1->getAvailableamount());
    echo json_encode($paymentDetails);
    return;
}


if (isset($_POST['accountname'])) {
$account_name = mysqli_real_escape_string($con, $_POST['accountname']);
$bank_name = mysqli_real_escape_string($con, $_POST['bankname']);
$bank_number = mysqli_real_escape_string($con, $_POST['banknumber']);
$ifsc_code = mysqli_real_escape_string($con, $_POST['ifsccode']);
$paytm_mobile_number = "1"; //mysqli_real_escape_string($con, $_POST['paytmmobilenumber']);
$is_paytm_active = "1";//mysqli_real_escape_string($con, $_POST['ispaytmactive']);
if (isset($_SESSION['usr_id'])) {
    $user_id = $_SESSION['usr_id'];
}
//$email_id = mysqli_real_escape_string($con, $_POST['email_id']);
try{
    $sql = "INSERT INTO user_payment_details(account_name,bank_name,bank_number,ifsc_code,paytm_mobile_number,is_paytm_active,user_id) 
VALUES(:account_name,:bank_name,:bank_number,:ifsc_code,:paytm_mobile_number,:is_paytm_active,:user_id);";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':account_name', $account_name, PDO::PARAM_STR);
    $stmt->bindParam(':bank_name', $bank_name, PDO::PARAM_INT);
    $stmt->bindParam(':bank_number', $bank_number, PDO::PARAM_INT);
    $stmt->bindParam(':ifsc_code', $ifsc_code, PDO::PARAM_INT);
    $stmt->bindParam(':paytm_mobile_number', $paytm_mobile_number, PDO::PARAM_INT);
    $stmt->bindParam(':is_paytm_active', $is_paytm_active, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
}else{


$result = getPaymentDetails($conn);
    try{
        $pd = new PaymentDetails();
        foreach($result as $row){
            $account_name = $row['account_name'];
            $bank_name = $row['bank_name'];
            $bank_number = $row['bank_number'];
            $ifsc_code = $row['ifsc_code'];
        //    $paytm_mobile_number = $row['paytm_mobile_number'];
        //    $is_paytm_number = $row['is_paytm_active'];


            $pd -> setAccountname($account_name);
            $pd -> setBankname($bank_name);
            $pd -> setBanknumber($bank_number);
            $pd -> setIfsccode($ifsc_code);

            echo  json_encode($pd);

          }
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
}


function getUserTransactionDetails($conn){
    $user_id = '';
    if (isset($_SESSION['usr_id'])) {
        $user_id = $_SESSION['usr_id'];
    }
    $stmt2 = $conn->prepare("select * from user_transaction_details utd where user_id =:user_id order by payment_requested_date desc");
    $stmt2->execute(array(':user_id' => $user_id));
    $usrResult = $stmt2->fetchAll();
    try {
        $paymentDetails = new PaymentDetails();
        foreach ($usrResult as $row) {
            $availableAmount = $row['available_amount'];
            $paymentDetails->setAvailableAmount($availableAmount);
            if($availableAmount!=null){
                break;
            }
            //  array_push($userPaymentArray, $userTransactionHistory);
        }
        return $paymentDetails;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


function getUserPaymentDetails($conn){
    $user_id = '';
    if (isset($_SESSION['usr_id'])) {
        $user_id = $_SESSION['usr_id'];
    }
    $stmt2 = $conn->prepare("select * from user_payment_details upd,user_transaction_details utd where upd.user_id =utd.user_id and upd.user_id =:user_id");
    $stmt2->execute(array(':user_id' => $user_id));
    $usrResult = $stmt2->fetchAll();
    try {
        $paymentDetails = new PaymentDetails();
        foreach ($usrResult as $row) {
            $bankNumber = $row['bank_number'];
            $accountName = $row['account_name'];
            $availableAmount = $row['available_amount'];
            $paymentDetails->setBanknumber($bankNumber);
            $paymentDetails->setAccountname($accountName);
            $paymentDetails->setAvailableAmount($availableAmount);
            if($bankNumber!=null && $accountName!=null){
                break;
            }
            //  array_push($userPaymentArray, $userTransactionHistory);
        }
        return $paymentDetails;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


function getPaymentDetails($conn){
    $user_id = '';
    if (isset($_SESSION['usr_id'])) {
        $user_id = $_SESSION['usr_id'];
    }
    $stmt = $conn->prepare("select * from user_payment_details where user_id=:user_id order by updated_date desc limit 1;");
    $stmt->execute(array(':user_id' => $user_id));
    $result = $stmt->fetchAll();
    return $result;
}

class PaymentDetails {

    var $accountname;
    var $bankname;
    var $banknumber;
    var $ifsccode;
    var $availableamount;

    /**
     * @return mixed
     */
    public function getAccountname()
    {
        return $this->accountname;
    }

    /**
     * @param mixed $accountname
     */
    public function setAccountname($accountname)
    {
        $this->accountname = $accountname;
    }

    /**
     * @return mixed
     */
    public function getBankname()
    {
        return $this->bankname;
    }

    /**
     * @param mixed $bankname
     */
    public function setBankname($bankname)
    {
        $this->bankname = $bankname;
    }

    /**
     * @return mixed
     */
    public function getBanknumber()
    {
        return $this->banknumber;
    }

    /**
     * @param mixed $banknumber
     */
    public function setBanknumber($banknumber)
    {
        $this->banknumber = $banknumber;
    }

    /**
     * @return mixed
     */
    public function getIfsccode()
    {
        return $this->ifsccode;
    }

    /**
     * @param mixed $ifsccode
     */
    public function setIfsccode($ifsccode)
    {
        $this->ifsccode = $ifsccode;
    }

    /**
     * @return mixed
     */
    public function getAvailableamount()
    {
        return $this->availableamount;
    }

    /**
     * @param mixed $availableamount
     */
    public function setAvailableamount($availableamount)
    {
        $this->availableamount = $availableamount;
    }

}
?>
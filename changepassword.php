<?php
session_start();

include_once 'dbconnect.php';
include('Constants.php');

try{

$msg = '';

if (isset($_POST['changepassword'])) {

    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    if($password != $cpassword) {
        $error = true;
        $msg = Constants::PASSWORD_CONFIRM_PASSWORD_DOESNOT_MATCH;
    }else{
        $email = $_SESSION['email_id'];
        $stmt1 = $conn->prepare("update user set password =:password where email =:email;");
        $stmt1->bindParam(':password',md5($password) , PDO::PARAM_STR);
        $stmt1->bindParam(':email',$email , PDO::PARAM_STR);
        $result = $stmt1->execute();
        if($result){
            $msg = Constants::PASSWORD_CHANGED_SUCCESSFULLY;
        }
    }

    echo $msg;
}
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
?>
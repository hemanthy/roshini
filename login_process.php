<?php
session_start();

/*if(isset($_SESSION['usr_id'])!="") {
	header("Location: index.php");
}*/


include_once 'dbconnect.php';

include_once 'mylogger.php';

include('Constants.php');

$msg = '';

//var constVar = new Constants();

//echo $msg;
//check if form is submitted
/**
 * @param $con
 * @param $email
 * @param $password
 * @param $result
 * @param $msg
 */
function userLogin($con)
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $result = mysqli_query($con, "SELECT * FROM user WHERE email = '" . $email . "' and password = '" . md5($password) . "'");

    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['usr_id'] = $row['id'];
        $_SESSION['usr_name'] = $row['name'];
        $_SESSION['email_id'] = $row['email'];
        $_SESSION['user_img'] = $row['user_img'];
        $_SESSION['user_reference_code'] = $row['user_reference_code'];

        return Constants::LOGIN_SUCCESS;
        // echo $errormsg;
        //header("Location: index.php");
    } else {
        return Constants::INCORRECT_EMAIL_OR_PASSWORD;
        // echo $errormsg;
    }
}


function autoLogin($email,$con)
{
  	$result = mysqli_query($con, "SELECT * FROM user WHERE email = '" . $email . "' and password = '" . md5('shh@3$%*') . "'");

	if ($row = mysqli_fetch_array($result)) {
		$_SESSION['usr_id'] = $row['id'];
		$_SESSION['usr_name'] = $row['name'];
		$_SESSION['email_id'] = $row['email'];
		$_SESSION['user_img'] = $row['user_img'];
		$_SESSION['user_reference_code'] = $row['user_reference_code'];
		return Constants::LOGIN_SUCCESS;
	}
}

if (isset($_POST['login'])) {

    $msg = userLogin($con);
}

//set validation error flag as false
$error = false;

//check if form is submitted
/**
 * @param $name
 * @param $email
 * @param $password
 * @return mixed
 */
/*function insertQuery($name, $email, $password)
{

 //   $refNo = mt_rand(10000,99999);
    $sql = "INSERT INTO users(name,email,password) VALUES(?,?,?)";
    $sql->bind_param('sss', $name, $email, md5($password));
    $sql->execute();
    $result = $sql->get_result();
    return $result;
}*/

if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    $refNo = generateUsrRefNo ($conn);
    
    if($password != $cpassword) {
        $error = true;
        $msg = Constants::PASSWORD_CONFIRM_PASSWORD_DOESNOT_MATCH;
      //  $cpassword_error = "Password and Confirm Password doesn't match";
    }else{
        $sql = getUserByEmailId ( $email );
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            $msg = Constants::EMAIL_ALREADY_EXISTS;
            $saveUser =   saveUser ( $name, $email, $password, $refNo );
        }else if(mysqli_query($con, $saveUser)) {
        //}else if(mysqli_query($con, "INSERT INTO users(name,email,password) VALUES('" . $name . "', '" . $email . "', '" . md5($password) . "')")) {
            $msg = Constants::REGISTRATION_SUCCESSFUL;
            //$successmsg = "Successfully Registered";
            //echo $successmsg;

           $msg = userLogin($con);
        } else {
            $msg = "Error in registering...Please try again later!";
        }
    }
}


echo $msg;



/**
 * 
 */

function getUsrInfoByUsrRefNo($conn,$refNo) {
	$stmt2 = $conn->prepare("select * from user where user_reference_code =:user_reference_code");
    $stmt2->execute(array(':user_reference_code' => $refNo));
    $usrObj = $stmt2->fetchAll();
	return $usrObj;
}


/**
 * 
 */

function generateUsrRefNo($conn) {
	//name can contain only alpha characters and space
    /*if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $name_error = "Name must contain only alphabets and space";
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email ID";
    }
    if(strlen($password) < 6) {
        $error = true;
        $password_error = "Password must be minimum of 6 characters";
    }*/
    $refNo = mt_rand(10000,99999);
    $refNo = 'ACB'.$refNo;
    $usrObj = getUsrInfoByUsrRefNo ($conn,$refNo);
    if(count($usrObj) > 0){
    	return generateUsrRefNo($conn);
    }
	return $refNo;
}


/**
 * @param email
 */

function getUserByEmailId($email) {
	$sql = "SELECT * FROM user WHERE email = '" . $email. "'";
	return $sql;
}


/**
 * @param name
 * @param email
 * @param password
 * @param refNo
 */

function saveUser($name, $email, $password, $refNo) {
	//    echo "Email ID already exists";
	$saveUser = "INSERT INTO user(name,email,password,user_reference_code) VALUES('" . $name . "', '" . $email . "', '" . md5($password) . "','".$refNo."')";
	return $saveUser;
}


function saveFBUser($name, $email,$refNo,$isUserImgExists,$conn) {
	$userImg = null;
	if($isUserImgExists){
		$userImg = 'userpics/'.$refNo.'.jpg';
	}
	$saveFBUser = "INSERT INTO user(name,email,password,user_reference_code,user_img) VALUES('" . $name . "', '" . $email . "', '" . md5('shh@3$%*') . "','".$refNo."','".$userImg."')";
	return $saveFBUser;
}


?>
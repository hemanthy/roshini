<?php
session_start();

/*if(isset($_SESSION['usr_id'])!="") {
	header("Location: index.php");
}*/


include_once 'dbconnect.php';

include_once 'pojo/UserDetailsPOJO.php';

include_once 'phpmailer/mail.php';

//include_once 'mylogger.php';

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
function userLogin(UserDetailsPOJO $udp)
{
	$conn = $udp -> getPdoconn();
    $stmt = $conn->prepare('SELECT * FROM user WHERE email =:email and password =:password ');
    $stmt->execute(array(
    		':email' => $udp -> getEmailId() ,
    		':password' => md5($udp->getPassword())
    ));
    
    $usrObj = $stmt->fetchAll();

    if (count($usrObj) > 0) {
    foreach($usrObj as $row){
        $_SESSION['usr_id'] = $row['id'];
        $_SESSION['usr_name'] = $row['name'];
        $_SESSION['email_id'] = $row['email'];
        $_SESSION['user_img'] = $row['user_img'];
        $_SESSION['user_reference_code'] = $row['user_reference_code'];

        return Constants::LOGIN_SUCCESS;
        // echo $errormsg;
        //header("Location: index.php");
    }
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

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    
    $udp = new UserDetailsPOJO();
    
    $udp -> setPassword($password);
    $udp -> setEmailId($email);
    $udp -> setPdoconn($conn);
    
    $msg = userLogin($udp);
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
    
    $udp = new UserDetailsPOJO();
    
    $udp -> setPassword($password);
    $udp -> setEmailId($email);
    $udp ->	setCpassword($cpassword);
    $udp -> setName($name);
    $udp -> setRefno($refNo);
    $udp -> setPdoconn($conn);

    
    
    if($password != $cpassword) {
        $error = true;
        $msg = Constants::PASSWORD_CONFIRM_PASSWORD_DOESNOT_MATCH;
      //  $cpassword_error = "Password and Confirm Password doesn't match";
    }else{
    	$usrObj = getUserByEmailId ($udp);
        if ($usrObj!=null && count($usrObj) > 0) {
            $msg = Constants::EMAIL_ALREADY_EXISTS;
        }else if(saveUser ($udp) == true) {
            $msg = Constants::REGISTRATION_SUCCESSFUL;
            // login
           $msg = userLogin($udp);
        } else {
            $msg = "Error in registering...Please try again later!";
        }
    }
}


echo $msg;


function sendMail(UserDetailsPOJO $udp){
	//send email
	
	$name = "Specialcashback";
	$to = $udp -> getEmailId();
	$refNo = $udp -> getRefno();
	$userName = $udp -> getName();
	$activationCode = $udp -> getActivationcode();
	$subject = "Registration Confirmation";
	$body = "<p>Hi $userName </p>
			<p>Thank you for registering at specialcashback site.</p>
			<p>To activate your account, please click on this link: <a href='".DIR."activate.php?x=$refNo&y=$activationCode'>".DIR."activate.php?x=$refNo&y=$activationCode</a></p>
				<p>Regards,</p>
				<p>Specialcashback Team</p>";
	$headers = "From: $name "."<noreply@specialcashback.com>\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	mail($to, $subject, $body, $headers);
	/* try{
		$mail = new Mail();
		$mail->setFrom(SITEEMAIL);
		$mail->addAddress($to);
		$mail->subject($subject);
		$mail->body($body);
		$mail->send();
	}catch (Exception $ex){
		
	} */
	
}


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

function getUserByEmailId(UserDetailsPOJO $udp) {
	$conn =	$udp -> getPdoconn();
	$stmt = $conn->prepare('SELECT * FROM user WHERE email =:email ');
	$stmt->execute(array(
			':email' => $udp -> getEmailId()
	));
	$usrObj = $stmt->fetchAll();
	return $usrObj;
}


/**
 * @param name
 * @param email
 * @param password
 * @param refNo
 */

function saveUser(UserDetailsPOJO $udp) {
	//    echo "Email ID already exists";
	
	//create the activation code
	$activasion = md5(uniqid(rand(),true));
	
	$conn = $udp -> getPdoconn();
	$udp -> setActivationcode($activasion);
	
	$stmt = $conn->prepare('INSERT INTO user (name,email,password,user_reference_code,user_img,active) VALUES (:name, :email, :password, :user_reference_code,:user_img,:active)');
	$rows = $stmt->execute(array(
			':name' => $udp -> getName(),
			':password' => md5($udp->getPassword()),
			':email' => $udp -> getEmailId(),
			':user_reference_code' => $udp -> getRefno(),
			':user_img' => "uploads/female.png",
			':active' => $activasion
	));
	if($rows != null && $rows==true){
		$id = $conn->lastInsertId('id');
		$udp -> setUsrId($id);
	//	error_log("user has been created successfully :: ".$id);
	}
	
//	error_log("user created successfully", 3, require_once __DIR__ ."/php_error.log");
	
	sendMail($udp);
//	$id = $db->lastInsertId('memberID');
	return $rows;
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
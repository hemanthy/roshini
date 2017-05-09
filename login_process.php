<?php
session_start();
/* if(isset($_SESSION['usr_id'])!="") {
 header("Location: index.php");
 } */




include_once 'dbconnect.php';

include_once 'pojo/UserDetailsPOJO.php';

include_once 'phpmailer/mail.php';

include('Constants.php');

include_once 'writemysqllog.php';

$msg = '';


//set validation error flag as false
$error = false;

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
if (isset($_POST['login'])) {


	try {
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$password = mysqli_real_escape_string($con, $_POST['password']);
		$browserInfo = mysqli_real_escape_string($con, $_POST['browserinfo']);

		$udp = new UserDetailsPOJO();

		$udp -> setPassword($password);
		$udp -> setEmailId($email);
		$udp -> setPdoconn($conn);

		$msg = userLogin($udp);
	} catch (Exception $e) {
		write_mysql_log($e->getMessage(),$conn);
	}

	if(isset($_SESSION['usr_id'])) {
		saveUserLoginHistory($conn, $udp,$browserInfo);
	}

}

if (isset($_POST['signup'])) {

	try {
		$name = mysqli_real_escape_string($con, $_POST['name']);
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$password = mysqli_real_escape_string($con, $_POST['password']);
		$cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
		$browserInfo = mysqli_real_escape_string($con, $_POST['browserinfosignup']);

		$refNo = generateUsrRefNo ($conn);

		$udp = new UserDetailsPOJO();

		$udp -> setPassword($password);
		$udp -> setEmailId($email);
		$udp ->	setCpassword($cpassword);
		$udp -> setName($name);
		$udp -> setRefno($refNo);
		$udp -> setPdoconn($conn);

		if($password != $cpassword) {
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
	} catch (Exception $e) {
		write_mysql_log($e->getMessage(),$conn);
	}

	if(isset($_SESSION['usr_id'])) {
		saveUserLoginHistory($conn, $udp,$browserInfo);
	}
}

if (isset($_POST['passwordreset'])) {

	$data = array();
	try {
		$email = mysqli_real_escape_string($con, $_POST['email']);

		$udp = new UserDetailsPOJO();
		$udp -> setEmailId($email);
		$udp -> setPdoconn($conn);

		$usrObj = getUserByEmailId ($udp);
		if ($usrObj!=null && count($usrObj) > 0) {
			$resultusr = resetPasswordTknisAlreadyExists($udp);
			if(count($resultusr) > 0){

				$data['success'] = true;
				$data['message'] = "Password reset confirmation email has been sent to $email.  <br> If email doesn't appear, <br> please check your SPAM !!!";
				// send mail
			}else {
				$stmt = resetPasswordToken($udp);
				if($stmt->rowCount() == 1){
					$data['success'] = true;
					$data['message'] = "Password reset confirmation email has been sent to $email.  <br> If email doesn't appear, <br> please check your SPAM !!!";
				}
			}
		}else{
			$data['success'] = false;
			$data['message'] = "$email email is not registered with us.";
		}
	} catch (Exception $e) {
		$data['success'] = false;
		write_mysql_log($e,$conn);
	}

	echo json_encode($data);

}


echo $msg;


function sendMailForAccountActiviation(UserDetailsPOJO $udp){
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


function sendMailForPasswordResetToken(UserDetailsPOJO $udp){
	//send email

	$resettoken = $udp -> getResetPasswordToken();

	$emailId = $udp -> getEmailId();

	$name = "Specialcashback";
	$to = $udp -> getEmailId();
	$userName = $udp -> getName();
	$subject = "Reset Password";
	$body = "<p>Hi $userName </p>
	<p>Greetings from Specialcashback !</p>
	<p>You have requested to reset your password. <br>	<a href=".DIR."activeresetpassword.php?a=$resettoken&b=$emailId>Click here</a> to change the password. </p>
	<p>Alternately you can use below URL directly in browser. </p>
	<p>".DIR."activeresetpassword.php?a=$resettoken&b=$emailId</a></p>
	<p>Regards,</p>
	<p>Specialcashback Team</p>";

	// echo $body;

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

function resetPasswordTknisAlreadyExists(UserDetailsPOJO $udp) {
	$conn =	$udp -> getPdoconn();
	$stmt = $conn->prepare('SELECT * FROM user WHERE email =:email and resettoken is not null');
	$stmt->execute(array(
			':email' => $udp -> getEmailId()
	));
	$usrObj = $stmt->fetchAll();

	if (count($usrObj) > 0) {
		foreach($usrObj as $row){
			$resettoken = $row['resetToken'];
			$udp -> setResetPasswordToken($resettoken);
		}
		//	sendMailForPasswordResetToken($udp);
	}
	return $usrObj;
}


function resetPasswordToken(UserDetailsPOJO $udp) {
	$conn =	$udp -> getPdoconn();
	$email = $udp -> getEmailId();
	$randnumber = uniqid(rand(),true);
	$resetToken = md5($randnumber.''.$email);
	$udp -> setResetPasswordToken($resetToken);
	$query = "UPDATE user SET resetToken = '$resetToken' , resetComplete = 'No' WHERE email =:email";
	$stmt = $conn->prepare($query);
	$stmt->execute(array(
			':email' => $udp -> getEmailId()
	));

	//	sendMailForPasswordResetToken($udp);
	return $stmt;
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

	$stmt = $conn->prepare('INSERT INTO user (name,email,password,user_reference_code,user_img,activeToken,active,created) VALUES (:name, :email, :password, :user_reference_code,:user_img,:activeToken,:active,now())');
	$rows = $stmt->execute(array(
			':name' => $udp -> getName(),
			':password' => md5($udp->getPassword()),
			':email' => $udp -> getEmailId(),
			':user_reference_code' => $udp -> getRefno(),
			':user_img' => "uploads/female.png",
			':active' => 'No',
			':activeToken' => $activasion
	));
	if($rows != null && $rows==true){
		$id = $conn->lastInsertId('id');
		$udp -> setUsrId($id);
		//	error_log("user has been created successfully :: ".$id);
	}

	//	error_log("user created successfully", 3, require_once __DIR__ ."/php_error.log");

	//sendMailForAccountActiviation($udp);
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

function saveUserLoginHistory($conn,$userData,$browserInfo) {
	$stmt = $conn->prepare("INSERT INTO user_login_history SET IP_Address =:IP_Address,  browser_type =:browser_type,login_source='Web',
				login_time=:login_time,user_id=:user_id;");
	$stmt->bindParam(':IP_Address', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
	$stmt->bindParam(':browser_type', $browserInfo, PDO::PARAM_STR);
	//	$stmt->bindParam(':login_source', "Web", PDO::PARAM_STR);
	$stmt->bindParam(':login_time', date("Y-m-d H:i:s"), PDO::PARAM_STR);
	//$stmt->bindParam(':logout_time', null, PDO::PARAM_STR);
	$stmt->bindParam(':user_id', $_SESSION['usr_id'], PDO::PARAM_STR);
	$execute = $stmt->execute();
	/* $result = $stmt->fetchAll();
	 foreach($result as $row){
		$_SESSION['usr_id'] = $row['id'];
		$_SESSION['usr_name'] = $userData['first_name'];
		$_SESSION['email_id'] = $row['email'];
		$_SESSION['user_img'] = $row['user_img'];
		$_SESSION['user_reference_code'] = $row['user_reference_code'];
		} */
}

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


function autoLoginfb($email,$con)
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

?>
<?php
//require('includes/config.php');
require('dbconnect.php');

//collect values from the url
$refNo = trim($_GET['x']);
$active = trim($_GET['y']);

//if id is number and the active token is not empty carry on
if(!empty($refNo) && !empty($active)){

	//update users record set the active column to Yes where the memberID and active value match the ones provided in the array
	$stmt = $conn->prepare("UPDATE user SET active = 'Yes' WHERE user_reference_code = :user_reference_code AND active = :active");
	$stmt->execute(array(
		':user_reference_code' => $refNo,
		':active' => $active
	));

	//if the row was updated redirect the user
	if($stmt->rowCount() == 1){

		//redirect to login page
		header('Location:/');
		exit;

	} else {
		echo "Your account could not be activated."; 
	}
	
}
?>
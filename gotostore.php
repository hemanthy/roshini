<?php
session_start();

include_once ('dbconnect.php');

$storeResult = '';
$userRefCode = '';
$userId = '1000';

if (isset($_SESSION['user_reference_code'])) {
    $userRefCode = $_SESSION['user_reference_code'];
}else{
    $userRefCode =   1000;
}

if (isset($_SESSION['usr_id'])) {
    $userId =   $_SESSION['usr_id'];
}
function getStoreInfoById($store_id,$conn){
	$stmt = $conn->prepare("select *,id as store_id from store where id=:store_id");
	$stmt->execute(array(':store_id' => $store_id));
	$result = $stmt->fetchAll();
	return $result;
}


$store_id = 1;
/* if (isset($_GET['gotostore'])) {
	$store_id = $_GET['gotostore'];
}
 */
$store_id = $_GET["ref"];

 $storeResult = getStoreInfoById($store_id,$conn);
 
echo "your directing...";
 
 if(count($storeResult) == 0){
  
  ERROR_LOG("invalid store number : ".$store_id);
  error_log("You messed up!", 3, "D:/xampp/apache/logs/error.log");
  
	$store_id = 1;
	$storeResult = getStoreInfoById($store_id,$conn);
 }
 
 $redirectUrl ='';

 try{
	foreach($storeResult as $row){
	$redirectUrl = $row['store_url'];
    $stmt1 = $conn->prepare("Insert into user_store_visits(redirect_store_url,user_id,store_id) values (:redirect_store_url,:user_id,:store_id);");
	$store_url = $row['store_url'];
	//$redirectUrl = str_replace("google","google",$store_url,$i);
        $redirectUrl = str_replace("affname","allgadget",$redirectUrl,$i);
        $redirectUrl = str_replace("userreferencecode",$userRefCode,$redirectUrl,$i);
	echo $redirectUrl;

	$stmt1->bindValue(':redirect_store_url',$redirectUrl, PDO::PARAM_STR);   	 
	$stmt1->bindValue(':user_id', 1, PDO::PARAM_STR);   
	$stmt1->bindValue(':store_id', $store_id , PDO::PARAM_STR);
	$stmt1->execute();
	}
	}
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
	echo $redirectUrl;
	

// sleep(5);

header('Location: '.$redirectUrl);

	
	  
	
?>
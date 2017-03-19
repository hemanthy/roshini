<?php
session_start();

include_once ('dbconnect.php');

$storeResult = '';
$userRefCode = '';
$userId = '1';
$GLOBALS['user_id'] = 1;

if (isset($_SESSION['user_reference_code'])) {
    $userRefCode = $_SESSION['user_reference_code'];
}else{
    $userRefCode =   ACB1000;
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
	$stmt1->bindValue(':user_id',$userId, PDO::PARAM_STR);
	$stmt1->bindValue(':store_id', $store_id , PDO::PARAM_STR);
	$stmt1->execute();
	}
	}
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
	echo $redirectUrl;
	
	/* <?php echo $redirectUrl?> */

// sleep(5);

//	$redirectUrl = '/dl.flipkart.com/dl/?affid=allgadget&affExtParam1=ACB1000';

	header('Location: '.$redirectUrl);
	// http://dl.flipkart.com/dl/?affid=ravi324&amp;affExtParam1=102669b190228006c48
	if (isset($_SERVER['HTTP_COOKIE'])) {
		$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
		foreach($cookies as $cookie) {
			$parts = explode('=', $cookie);
			$name = trim($parts[0]);
			echo '/////////////';
			echo $name;
			//	setcookie($name, '', time()-1000);
			//	setcookie($name, '', time()-1000, '/');
		}
	}
	
	$cookie_name = "user";
	$cookie_value = "Alex Porter";
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
	if(!isset($_COOKIE[$cookie_name])) {
		echo "Cookie named '" . $cookie_name . "' is not set!";
	} else {
		echo "Cookie '" . $cookie_name . "' is set!<br>";
		echo "Value is: " . $_COOKIE[$cookie_name];
	}
?>

 <input type="hidden" name="hurl" id="hurl" value="http://dl.flipkart.com/dl/?affid=allgadget&amp;affExtParam1=ACB11210" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script language="JavaScript">
document.cookie = "username=suresh;AFFID=allg; expires=Thu, 18 Dec 2017 12:00:00 UTC; path=/";


//setTimeout(alert('ok'), 400);

setTimeout(function () { explode(); }, 8000);

var explode = function(){
	 //alert("Boom!");
	 var anchor = document.createElement("a");
	window.location.href = document.getElementById("hurl").value;
	};
</script>


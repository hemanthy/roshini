<?php
//session_start();

//include('../Constants.php');

include ('login_process.php');
include ('dbconnect.php');
//include ('/fb/src/Facebook/autoload.php');

$msg = '';

require_once __DIR__ . '/dbconnect.php';
require_once __DIR__ . '/login_process.php';
require_once __DIR__ . '/fb/src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
		'app_id' => '1887757664841968',
		'app_secret' => '7df1ed3933d04270639f4fd055a86bc9',
		'default_graph_version' => 'v2.8',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // optional

try {
	if (isset($_SESSION['facebook_access_token'])) {
		$accessToken = $_SESSION['facebook_access_token'];
	} else {
		$accessToken = $helper->getAccessToken();
	}
} catch(Facebook\Exceptions\FacebookResponseException $e) {
	// When Graph returns an error
	echo 'Graph returned an error: ' . $e->getMessage();

	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
	exit;
}

if (isset($accessToken)) {
	if (isset($_SESSION['facebook_access_token'])) {
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	} else {
		// getting short-lived access token
		$_SESSION['facebook_access_token'] = (string) $accessToken;

		// OAuth 2.0 client handler
		$oAuth2Client = $fb->getOAuth2Client();

		// Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);

		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;

		// setting default access token to be used in script
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}

	// redirect the user back to the same page if it has "code" GET variable
	if (isset($_GET['code'])) {
		header('Location: ./');
	}

	// getting basic info about user
	try {
		//print_r($fb);
		$profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
		$profile = $profile_request->getGraphNode()->asArray();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		session_destroy();
		// redirecting user back to app login page
		header("Location: ./");
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}

	// printing $profile array on the screen which holds the basic info about user
	print_r($profile);

	//$profile_pic =  "http://graph.facebook.com/".$uid."/picture";
	//	$jsonObj = json_decode($profile,true);
	$firstName ='';
	$lastName = '';
	$name ='';
	$email ='';
	$fid= null;
	foreach ($profile as $key => $value) {
		if($key=='first_name'){
			$firstName = $value;
		}
		if($key=='last_name'){
			$lastName = $value;
		}
		if($key=='name'){
			$name = $value;
		}
		if($key=='email'){
			$email = $value;
		}
		if($key=='id'){
			$fid = $value;
		}
		echo $value;
	}

	if($fid!=null){
		$sql = getUserByEmailId ( $email );
		$result = mysqli_query($con, $sql);
		if (mysqli_num_rows($result) > 0) {
			//	$msg = Constants::EMAIL_ALREADY_EXISTS;
			// auto login
			$loginMsg = autoLogin($email, $con);
			if($loginMsg=='LOGIN_SUCCESS'){
				return;
			}
		}else{
			$isUserImgExists = true;
			$refNo = generateUsrRefNo ($conn);
			$profile_pic =  "http://graph.facebook.com/".$fid."/picture?redirect=true&height=200&width=200";
			// echo "<img src=\"" . $profile_pic . "\" />";
			$fileName =  $refNo.".jpg";
			$imgUrl = getcwd().DIRECTORY_SEPARATOR . $refNo.".jpg";
			echo $imgUrl;
			
			/* if (file_exists($imgUrl)) {
				unlink($imgUrl);
			} */
			copy($profile_pic, "image.jpg");
			rename('image.jpg', getcwd().DIRECTORY_SEPARATOR.'/userpics/'.$fileName);
			
			echo  $fileName;
			$saveFBUser =	saveFBUser($name, $email,$refNo,$isUserImgExists, $conn);
			
			if(mysqli_query($con, $saveFBUser)) {
				$loginMsg = autoLogin($email, $con);
				if($loginMsg=='LOGIN_SUCCESS'){
					return;
				}
			}else{
				$msg = "Error in registering...Please try again later!";
			}
		}
	}


	// Now you can redirect to another page and use the access token from $_SESSION['facebook_access_token']
} else {
	// replace your website URL same as added in the developers.facebook.com/apps e.g. if you used http instead of https and you used non-www version or www version of your website then you must add the same here
	//$loginUrl = $helper->getLoginUrl('https://specialcashback.000webhostapp.com/fb/index.php', $permissions);
	$loginUrl = $helper->getLoginUrl('https://specialcashback.000webhostapp.com/fb.php', $permissions);
	echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
}
<?php
// session_start();

//include('../Constants.php');

include ('login_process.php');
include ('dbconnect.php');
include_once 'writemysqllog.php';

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
	write_mysql_log('Graph returned an error: '.$e->getMessage(), $conn);

	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
	// When validation fails or other local issues
	write_mysql_log('Facebook SDK returned an error: '.$e->getMessage(), $conn);
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
		
		$profile_request = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,locale,picture');
		$fbUserProfile = $profile_request->getGraphNode()->asArray();
		
		$user_reference_code = generateUsrRefNo ($conn);
		
		
		$fbUserData = array(
				'oauth_provider'=> 'facebook',
				'oauth_uid'     => $fbUserProfile['id'],
				'name'    		=> $fbUserProfile['name'],
				'first_name'    => $fbUserProfile['first_name'],
				'last_name'     => $fbUserProfile['last_name'],
				'email'         => $fbUserProfile['email'],
				'gender'        => $fbUserProfile['gender'],
				'locale'        => $fbUserProfile['locale'],
				'user_img'       => $fbUserProfile['picture']['url'],
				'link'          => $fbUserProfile['link'],
				'user_reference_code' => $user_reference_code
		);
		
		// print_r($fbUserData);
		
		checkUser($fbUserData,$conn);
		
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		write_mysql_log('Graph returned an error: '.$e->getMessage(),$conn);
		session_destroy();
		// redirecting user back to app login page
		header("Location: ./");
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		write_mysql_log('Facebook SDK returned an error: '.$e->getMessage(),$conn);
		exit;
	}

	// Now you can redirect to another page and use the access token from $_SESSION['facebook_access_token']
} else {
	// replace your website URL same as added in the developers.facebook.com/apps e.g. if you used http instead of https and you used non-www version or www version of your website then you must add the same here
	//$loginUrl = $helper->getLoginUrl('https://specialcashback.000webhostapp.com/fb/index.php', $permissions);
	$loginUrl = $helper->getLoginUrl('http://specialcashback.000webhostapp.com/fb.php?success', $permissions);
	header('Location: '.$loginUrl);
}

function checkUser($userData,$conn){
	$iswebuser = boolval(FALSE);
	if(!empty($userData)){

		try{
			$stmt = $conn->prepare("SELECT * FROM user WHERE oauth_provider =:oauth_provider AND oauth_uid =:oauth_uid;");
			$stmt->bindParam(':oauth_provider', $userData['oauth_provider'], PDO::PARAM_STR);
			$stmt->bindParam(':oauth_uid', $userData['oauth_uid'], PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetchAll();
			if(($result==null || empty($result) || count($result) == 0) && (!empty($userData['email']))){
				$stmt = $conn->prepare("SELECT * FROM user WHERE email =:email;");
				$stmt->bindParam(':email', $userData['email'], PDO::PARAM_STR);
				$stmt->execute();
				$result = $stmt->fetchAll();
				if($result!=null && !empty($result) && count($result) > 0){
					$iswebuser = boolval(TRUE);
					foreach($result as $row){
						$userData['user_reference_code'] =	$row['user_reference_code'];
						$userData  = $userData;
					}
					$userData =	downloadfbpic ( $userData );
				}
			}

			if($result!=null && !empty($result) && count($result) > 0){
				// Update user data if already exists
			 	$vars = array();
				$updatequery = ' SET SQL_SAFE_UPDATES=0; update  user set gender =:gender, locale =:locale, link =:link, name =:name, oauth_uid =:oauth_uid, modified = now() ';
				if($iswebuser){
					$updatequery  .= ', user_img =:user_img WHERE email =:email;';
					$vars[':email'] = $userData['email'];
					$vars[':oauth_uid'] = $userData['oauth_uid'];
					$vars[':user_img'] = $userData['user_img'];
				}else{
					$updatequery .= ' WHERE oauth_provider =:oauth_provider AND oauth_uid =:oauth_uid;';
					$vars[':oauth_provider'] = $userData['oauth_provider'];
					$vars[':oauth_uid'] = $userData['oauth_uid'];
				}
				$stmt2 = $conn->prepare($updatequery);
				$vars[':gender'] = $userData['gender'];
				$vars[':locale'] = $userData['locale'];
				$vars[':link'] = $userData['link'];
				$vars[':name'] = $userData['name'];
				$stmt2->execute($vars);
				$stmt2->closeCursor();
				autoLogin($conn,$userData);
			}else{

			 $userData = downloadfbpic ( $userData );
			 
			 // Insert user data
			 $stmt = $conn->prepare("INSERT INTO user SET oauth_provider = :oauth_provider, 
			 		oauth_uid =:oauth_uid, email =:email,gender =:gender, locale =:locale, name=:name, user_img =:user_img,user_reference_code=:user_reference_code,
	  link =:link,created = '".date("Y-m-d H:i:s")."', modified = '".date("Y-m-d H:i:s")."'");
				$stmt->bindParam(':oauth_provider', $userData['oauth_provider'], PDO::PARAM_STR);
				$stmt->bindParam(':oauth_uid', $userData['oauth_uid'], PDO::PARAM_STR);
				$stmt->bindParam(':email', $userData['email'], PDO::PARAM_STR);
				$stmt->bindParam(':gender', $userData['gender'], PDO::PARAM_STR);
				$stmt->bindParam(':name', $userData['name'], PDO::PARAM_STR);
				$stmt->bindParam(':locale', $userData['locale'], PDO::PARAM_STR);
				$stmt->bindParam(':user_img', $userData['user_img'], PDO::PARAM_STR);
				$stmt->bindParam(':link', $userData['link'], PDO::PARAM_STR);
				$stmt->bindParam(':user_reference_code', $userData['user_reference_code'], PDO::PARAM_STR);
				$res = $stmt->execute();
				if($res){
					autoLogin($conn,$userData);
				}
			}
		}
		catch(PDOException $e)
		{
			write_mysql_log($e->getMessage(), $conn);
		}

	}
	print_r($userData);
}


/**
 * @param userData
 */

function downloadfbpic($userData) {
	$profile_pic =  "http://graph.facebook.com/".$userData['oauth_uid']."/picture?redirect=true&height=200&width=200";
	$fileName =  $userData['user_reference_code'].".jpg";
	$imgUrl = getcwd().DIRECTORY_SEPARATOR . $userData['user_reference_code'].".jpg";
	if (file_exists($imgUrl)) {
		unlink($imgUrl);
	}
	copy($profile_pic, "image.jpg");
	rename('image.jpg', getcwd().DIRECTORY_SEPARATOR.'/userpics/'.$fileName);
	$userData['user_img'] = 'userpics/'.$userData['user_reference_code'].'.jpg';
	$userData = $userData;
	return $userData;
}

function autoLogin($conn,$userData)
{
	$stmt = $conn->prepare("SELECT * FROM user WHERE oauth_uid =:oauth_uid;");
	$stmt->bindParam(':oauth_uid', $userData['oauth_uid'], PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetchAll();

	foreach($result as $row){
		$_SESSION['usr_id'] = $row['id'];
		$_SESSION['usr_name'] = $userData['name'];
		$_SESSION['email_id'] = $row['email'];
		$_SESSION['user_img'] = "http://graph.facebook.com/".$userData['oauth_uid']."/picture?redirect=true&height=200&width=200";
		$_SESSION['user_reference_code'] = $row['user_reference_code'];
	}
	//saveUserLoginHistory($conn,$userData);
}

?>
<script>
window.close();
</script>
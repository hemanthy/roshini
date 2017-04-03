<?php

session_start();

include_once 'dbconnect.php';

 $fbUserData = array(
        'oauth_provider'=> 'facebook',
        'oauth_uid'     => '3423413',
        'first_name'    => 'fdsafa',
        'last_name'     => 'rrrrrrrrrrrrrrrrrrr',
        'email'         => 'dsafdsa@dfg.com',
        'gender'        => 'M',
        'locale'        => 'IN',
        'picture'       => 'user/43543534.jpg',
        'link'          => 'http://google.com',
		'IP_Address'          => 'http://google.com',
		'browser_type'        => 'IE',
		'login_source'        => 'Web'
    );
	
	print_r($fbUserData);
	
checkUser($fbUserData,$conn);
 function checkUser($userData = array(),$conn){
        if(!empty($userData)){
		
		try{
            // prepare sql and bind parameters
            $stmt = $conn->prepare("SELECT * FROM users2 WHERE oauth_provider =:oauth_provider AND oauth_uid =:oauth_uid;");
            $stmt->bindParam(':oauth_provider', $userData['oauth_provider'], PDO::PARAM_STR);
			$stmt->bindParam(':oauth_uid', $userData['oauth_uid'], PDO::PARAM_STR);
            $stmt->execute();
			$result = $stmt->fetchAll();
			echo 'users2'.count($result);
						
			 if($result!=null && !empty($result) && count($result) > 0){
			 echo 'users results found!!!';
				// Update user data if already exists
				$stmt = $conn->prepare("UPDATE  users2 SET first_name =:first_name, last_name =:last_name, email =:email, gender =:gender, locale =:locale,
  picture =:picture, link =:link,modified = '".date("Y-m-d H:i:s")."'  WHERE oauth_provider =:oauth_provider AND oauth_uid =:oauth_uid;");
				$stmt->bindParam(':first_name', $userData['first_name'], PDO::PARAM_STR);
				$stmt->bindParam(':last_name', $userData['last_name'], PDO::PARAM_STR);
				$stmt->bindParam(':email', $userData['email'], PDO::PARAM_STR);
				$stmt->bindParam(':gender', $userData['gender'], PDO::PARAM_STR);
				$stmt->bindParam(':locale', $userData['locale'], PDO::PARAM_STR);
				$stmt->bindParam(':picture', $userData['picture'], PDO::PARAM_STR);
				$stmt->bindParam(':link', $userData['link'], PDO::PARAM_STR);
				$stmt->bindParam(':oauth_provider', $userData['oauth_provider'], PDO::PARAM_STR);
				$stmt->bindParam(':oauth_uid', $userData['oauth_uid'], PDO::PARAM_STR);
				$stmt->execute();
				autoLogin($conn,$userData);
				echo $_SESSION['usr_id'];
			 }else{
			 echo 'saving users found!!!';
                // Insert user data
	  $stmt = $conn->prepare("INSERT INTO users2 SET oauth_provider = :oauth_provider,  oauth_uid =:oauth_uid, first_name =:first_name,
	  last_name =:last_name, email =:email,gender =:gender, locale =:locale, picture =:picture,
	  link =:link,created = '".date("Y-m-d H:i:s")."', modified = '".date("Y-m-d H:i:s")."'");
				$stmt->bindParam(':oauth_provider', $userData['oauth_provider'], PDO::PARAM_STR);
				$stmt->bindParam(':oauth_uid', $userData['oauth_uid'], PDO::PARAM_STR);
				$stmt->bindParam(':first_name', $userData['first_name'], PDO::PARAM_STR);
				$stmt->bindParam(':last_name', $userData['last_name'], PDO::PARAM_STR);
				$stmt->bindParam(':email', $userData['email'], PDO::PARAM_STR);
				$stmt->bindParam(':gender', $userData['gender'], PDO::PARAM_STR);
				$stmt->bindParam(':locale', $userData['locale'], PDO::PARAM_STR);
				$stmt->bindParam(':picture', $userData['picture'], PDO::PARAM_STR);
				$stmt->bindParam(':link', $userData['link'], PDO::PARAM_STR);
				$res = $stmt->execute();
				if($res){
				autoLogin($conn,$userData);
				echo $_SESSION['email_id'];
			//	print_r($result);
					
				}
            }
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }

        }
    }
	
	function autoLogin($conn,$userData)
{
				$stmt = $conn->prepare("SELECT * FROM users2 WHERE oauth_provider =:oauth_provider AND oauth_uid =:oauth_uid;");
				$stmt->bindParam(':oauth_provider', $userData['oauth_provider'], PDO::PARAM_STR);
				$stmt->bindParam(':oauth_uid', $userData['oauth_uid'], PDO::PARAM_STR);
				$stmt->execute();
				$result = $stmt->fetchAll();
				
		foreach($result as $row){
		$_SESSION['usr_id'] = $row['id'];
		$_SESSION['usr_name'] = $userData['first_name'];
		$_SESSION['email_id'] = $row['email'];
		$_SESSION['user_img'] = $row['user_img'];
		$_SESSION['user_reference_code'] = $row['user_reference_code'];
		}
		saveUserLoginHistory($conn,$userData);
}

	function saveUserLoginHistory($conn,$userData)
{
				$stmt = $conn->prepare("INSERT INTO user_login_history SET IP_Address =:IP_Address,  browser_type =:browser_type,login_source=:login_source,
				login_time=:login_time,user_id=:user_id;");
				$stmt->bindParam(':IP_Address', $userData['IP_Address'], PDO::PARAM_STR);
				$stmt->bindParam(':browser_type', $userData['browser_type'], PDO::PARAM_STR);
				$stmt->bindParam(':login_source', $userData['login_source'], PDO::PARAM_STR);
				$stmt->bindParam(':login_time', date("Y-m-d H:i:s"), PDO::PARAM_STR);
				//$stmt->bindParam(':logout_time', null, PDO::PARAM_STR);
				$stmt->bindParam(':user_id', $_SESSION['usr_id'], PDO::PARAM_STR);
				$stmt->execute();
				$result = $stmt->fetchAll();
				
		foreach($result as $row){
		$_SESSION['usr_id'] = $row['id'];
		$_SESSION['usr_name'] = $userData['first_name'];
		$_SESSION['email_id'] = $row['email'];
		$_SESSION['user_img'] = $row['user_img'];
		$_SESSION['user_reference_code'] = $row['user_reference_code'];
		}
}
	
echo $_SESSION['usr_name'];
?>


use affirmed;

drop table users2;
CREATE TABLE users2 (
 id int(11) NOT NULL AUTO_INCREMENT,
 oauth_provider enum('Web','App','facebook','google','twitter') COLLATE utf8_unicode_ci NOT NULL,
 oauth_uid varchar(100) COLLATE utf8_unicode_ci  NULL,
 first_name varchar(50) COLLATE utf8_unicode_ci  NULL,
 last_name varchar(50) COLLATE utf8_unicode_ci  NULL,
 email varchar(100) COLLATE utf8_unicode_ci NULL,
 gender varchar(5) COLLATE utf8_unicode_ci  NULL,
 locale varchar(10) COLLATE utf8_unicode_ci  NULL,
 picture varchar(255) COLLATE utf8_unicode_ci  NULL,
 link varchar(255) COLLATE utf8_unicode_ci  NULL,
 created datetime NOT NULL,
 modified datetime NOT NULL,
   user_img TEXT,
  user_reference_code long,
  active bool default false,
 PRIMARY KEY (id)
)

-- drop table user_login_history;
create table user_login_history (id bigint not null auto_increment,IP_Address text,browser_type text,login_source  enum('Web','App','facebook','google','twitter') COLLATE utf8_unicode_ci NOT NULL,
  login_time TIMESTAMP,logout_time TIMESTAMP,user_id bigint,primary key(id),
  foreign key (user_id) references user(id));
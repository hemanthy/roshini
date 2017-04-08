<?php
session_start();

if(isset($_SESSION['usr_id'])) {
	session_destroy();
	unset($_SESSION['usr_id']);
	unset($_SESSION['usr_name']);
	
	if(isset($_SESSION['facebook_access_token'])) {
	// Remove access token from session
	unset($_SESSION['facebook_access_token']);
	}
	
	if(isset($_SESSION['userData'])) {
	// Remove user data from session
	unset($_SESSION['userData']);
	}
	
	header("Location: index.php");
} else {
	header("Location: index.php");
}
?>
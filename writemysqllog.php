<?php

include_once 'dbconnect.php';



function sendmailerrorlog($message){
	mail("hemanth48@gmail.com", "database is down", $message);
}

function write_mysql_log($message,$conn){
	
	echo "Error: Please try later !!! ";
	
	if($conn == null){
		// sendmailerrorlog("Database is down !!!");
		exit;
	}
	
	// Check database connection
	if( ($conn instanceof PDO) == false) {
		return array(status => false, message => 'MySQL connection is invalid');
	}

	// Check message
	if($message == '') {
		return array(status => false, message => 'Message is empty');
	}

	// Get IP address
	if( ($remote_addr = $_SERVER['REMOTE_ADDR']) == '') {
		$remote_addr = "REMOTE_ADDR_UNKNOWN";
	}

	// Get requested script
	if( ($request_uri = $_SERVER['REQUEST_URI']) == '') {
		$request_uri = "REQUEST_URI_UNKNOWN";
	}

	// Escape values
	//$message     = $db->quote($message);
//	$remote_addr = $db->quote($remote_addr);
//	$request_uri = $db->quote($request_uri);

	// Construct query
	/* $sql = "INSERT INTO my_log (remote_addr, request_uri, message) VALUES('$remote_addr', '$request_uri','$message')";

	// Execute query and save data
	$stmt = $db->prepare($sql);
	$result = $stmt->execute(); */
//	$result = $db->query($sql);

	$stmt = $conn->prepare("INSERT INTO mylog SET remote_addr =:remote_addr, request_uri =:request_uri, message=:message");
	$stmt->bindParam(':remote_addr', $remote_addr, PDO::PARAM_STR);
	$stmt->bindParam(':request_uri', $request_uri, PDO::PARAM_STR);
	$stmt->bindParam(':message', $message, PDO::PARAM_STR);
	$res = $stmt->execute();
	if($res) {
		exit;
		return array(status => true);
	}
	else {
		return array(status => false, message => 'Unable to write to the database');
	}
}

?>
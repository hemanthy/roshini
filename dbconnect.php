<?php
//connect to mysql database
//$con = mysqli_connect("localhost", "id1145172_testdb", "testdb", "id1145172_testdb") or die("Error " . mysqli_error($con));
$con = mysqli_connect("localhost", "root", "", "testdb") or die("Error " . mysqli_error($con));
//echo 'connecting to db';

//$servername = "localhost";$username = "id1145172_testdb";$password = "testdb";$dbname = "id1145172_testdb";
$servername = "localhost";$username = "root";$password = "";$dbname = "testdb";	
try{
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo "Error: " . $e->getMessage();
}

?>
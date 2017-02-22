<?php
//connect to mysql database
$con = mysqli_connect("localhost", "root", "", "testdb") or die("Error " . mysqli_error($con));
//echo 'connecting to db';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";
try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}

?>
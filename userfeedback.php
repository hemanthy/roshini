<?php
session_start();

// include_once ('OrderDetailsPOJO.php');
include_once ('dbconnect.php');

$user_id = '';

if (isset($_POST['feedback'])) {

    $feedback = mysqli_real_escape_string($con, $_POST['feedback']);
    $store_id = mysqli_real_escape_string($con, $_POST['store_id']);
    if (isset($_SESSION['usr_id'])) {
        $user_id = $_SESSION['usr_id'];
    }

    $email_id = mysqli_real_escape_string($con, $_POST['email_id']);
    try{
        // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO user_store_feedback(feedback,email,user_id,store_id) VALUES(:feedback,:email,:user_id,:store_id)");
        $stmt->bindParam(':feedback', $feedback, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':email', $email_id, PDO::PARAM_INT);
        $stmt->bindParam(':store_id', $store_id, PDO::PARAM_INT);
        $stmt->execute();
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }

}
?>
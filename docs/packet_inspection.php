<?php
include("database/db_conn.php");
include("session/session.php");

//Checks message exists, if not redirects to home page
if (!isset($_POST['message'])) {
    header("Location: ../homepage.php");
}

$message = $_POST['data']; //Get encrypted message
$secure = $_POST['secure']; //Get letter for check

if(substr($message, -1) == $secure) //Check that letter matches last letter of message
{
    $query = "INSERT INTO notes (message) VALUES ('$message')";
    $result = $conn->query($query); //Insert message into DB
}else{
    header("Location: ../homepage.php?error=Warning! MITM detected: Hash Didn't Match"); //Display error
}

mysqli_close($conn); //Close connection to DB
header("Location: ../homepage.php"); //Redirect to homepage
?>

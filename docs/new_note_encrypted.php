<?php
include("database/db_conn.php");
include("session/session.php");

//Decrypts data with private key
function private_key_decrypt($data, $key)
{
    openssl_private_decrypt($data, $decrypted_data, $key);
    return $decrypted_data;
}

//Checks that a message exists, if not redirects back to homepage
if (!isset($_POST['message'])) {
    header("Location: ../homepage.php");
}

$message = $_POST['data']; //Get encrypted message
$message = base64_decode($message); //Decode encrypted data

$message = private_key_decrypt($message, $server_priv_key); //Decrypt message

$query = "INSERT INTO notes (message) VALUES ('$message')";
$result = $conn->query($query); //Insert message into DB

mysqli_close($conn); //Close connection to DB
header("Location: ../homepage.php"); //Redirect to homepage
?>

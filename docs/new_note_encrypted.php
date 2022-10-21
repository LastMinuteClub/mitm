<?php
include("database/db_conn.php");
include("session/session.php");

//Decrypts data with private key
function private_key_decrypt($data, $key)
{
    openssl_private_decrypt($data, $decrypted_data, $key);
    return $decrypted_data;
}

if (!isset($_POST['message'])) {
    header("Location: ../homepage.php");
}

$message = $_POST['data'];
$message = base64_decode($message);

var_dump($_POST["data"]);
$message = private_key_decrypt($message, $server_priv_key);

$query = "INSERT INTO notes (message) VALUES ('$message')";
$result = $conn->query($query);

mysqli_close($conn);
header("Location: ../homepage.php");
?>

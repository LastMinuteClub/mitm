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
$secure = $_POST['secure'];

if(substr($message, -1) == $secure)
{
    $query = "INSERT INTO notes (message) VALUES ('$message')";
    $result = $conn->query($query);
}else{
    header("Location: ../homepage.php?error=Warning! MITM detected: Hash Didn't Match");
}

mysqli_close($conn);
header("Location: ../homepage.php");
?>

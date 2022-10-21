<?php
include("database/db_conn.php");
include("session/session.php");

//Hashes message using SHA256 algo
function hash_message($data)
{
    return hash("sha256", $data);
}

//Compares the hashes of a piece of data and a hash
//True == Same, False == !Same
function compare_hash($hash, $data)
{
    if (hash_message($data) == $hash) {
        return true;
    } else {
        return false;
    }
}

//Decrypts data with private key
function private_key_decrypt($data, $key)
{
    openssl_private_decrypt($data, $decrypted_data, $key);
    return $decrypted_data;
}

$message = $_POST['data']; //Get encrypted message
$hash = $_POST['hash']; //Get hash of message

$message = base64_decode($message); //Decode encrypted data
$message = private_key_decrypt($message, $server_priv_key); //Decrypt message

if (compare_hash($hash, $message)) { //Make sure original hash matches hash of unencrypted message
    $query = "INSERT INTO notes (message) VALUES ('$message')";
    $result = $conn->query($query); //Insert message into DB
    mysqli_close($conn); //Close connection to DB
} else {
    header("Location: ../homepage.php?error=Warning! MITM detected: Hash Didn't Match"); //Display error
}

mysqli_close($conn); //Close connection to DB
header("Location: ../homepage.php"); //Redirect to homepage
?>

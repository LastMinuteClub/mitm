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

$message = $_POST['data'];
$hash = $_POST['hash'];
$secure = $_POST['secure'];

$message = base64_decode($message);
$message = private_key_decrypt($message, $server_priv_key);

if (compare_hash($hash, $message) && (substr($message, -1) == $secure)) {
    $query = "INSERT INTO notes (message) VALUES ('$message')";
    $result = $conn->query($query);
    mysqli_close($conn);
} else {
    header("Location: ../homepage.php?error=Warning! MITM detected: Hash Didn't Match");
    // $query = "INSERT INTO notes (message, hash_sha256) VALUES ('FAILED', 'FAILED')";
    // $result = $conn->query($query);
}

mysqli_close($conn);
header("Location: ../homepage.php");
?>

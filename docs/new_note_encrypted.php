<?php
session_start();
include("database/db_conn.php");

//Decrypts data with private key
function private_key_decrypt($data, $key)
{
    openssl_private_decrypt($data, $decrypted_data, $key);
    return $decrypted_data;
}

// if (!isset($_POST['message'])) {
//     header("Location: ../homepage.php");
// }

$message = $_POST['data'];
$test22 = base64_decode($message);
$key = $_SESSION['server_priv_key'];
$test = strlen($key);


var_dump($_POST["data"]);
$message = private_key_decrypt($test22, $key);
// $message = "aaa";

$query = "INSERT INTO notes (message) VALUES ('$message')";
$result = $conn->query($query);

console_log("Result: " . $result);

// header("Location: ../homepage.php");
mysqli_close($conn);

// Console function
function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
?>

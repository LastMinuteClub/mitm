<?php
include("database/db_conn.php");

function private_key_decrypt($data, $privatekey)
{
    //Decrypt using a private key
    openssl_private_decrypt($data, $decrypted_data, $privatekey);
    return $decrypted_data; //Returns decrypted data
}

$message = htmlspecialchars($_POST['message']);

if (!isset($_POST['message'])) {
    header("Location: ../homepage.php");
}

$message = private_key_decrypt($message, "ADD PRIV KEY");

$query = "INSERT INTO notes (message) VALUES ('$message')";
$result = $conn->query($query);

console_log("Result: " . $result);

header("Location: ../homepage.php");
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

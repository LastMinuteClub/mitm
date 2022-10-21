<?php
include("database/db_conn.php");
include("session/session.php");

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
$key2 = $_POST['secure'];
$test22 = base64_decode($message);
//$key = $_SESSION['server_priv_key'];
//$key = "-----BEGIN PRIVATE KEY----- MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQDwdu3FtM3NmjGR 0plGoLnC6IxEsB5FCWPborqpTAPcz+IuxHzGVK2CHSj22iDAU+J+Eyn1OrObzRXB 7M3pHJhOkmOIXIPzQhCUSrVsIWqnxVWNVxzVF0Dm/kJdnGmNBn3pL8w1mZrnfrq+ 5jK9GC5sDuAp9SDDf69Ul1NL1kwOOq7SezVruPo6xPZuAAaQRJAqQ7vUDR6svDvk A7ZXGPvWVqh6ioZlHsMb+7zdi+UTW4svxjaq/UPwfFxIQlJySSLf2KXcliIe4RoE YpMP524LzpzrxPxbBwgyyRg7UbdfLVlhhNoQFX3klhEE7u9zJIgDvDz73eOWEj/i /NRuuJqbAgMBAAECggEAXjz9qkHVdgI78v4p+7f5lR01+6VZ94xaijUYGkkkKmF+ Lv3qOH/vD9MFvth1hWpalTZFd0nuId0Z7co0WGtQdVqBj2tSev8lKDivKRVfiyiX ArFlJ03Zra1vrOgjpZUpuz10Nn1ga+EKps3ojJrxdn/N8iOTF4ru16QGjO4LGHe8 l44hdYjsIMn3PM6/w0GZjZC1amEzd0RmVfW9eIREgamHHtSFl4P1mISw5XUFvCNQ MoBeBWjKQHp7ZGT8UJ+LxQLN7GGk0lu3XC5RIa7B+AQXKoODgqpU9xS7+PYd7Tzl 2D+bTyHILawmfP7fyWOCO0+SwXKwTkksENV35NRboQKBgQD6/qA8fp2+SG+jovYK HmKD7CvvVL2qOF9WE1LEAJE4BZKTk+yw5jbtUeMX4ATI4AdCUcKGkN1fEM4q4fh0 wikoLsIpI9W7zSU0Y390kCf/y54MWbCyFVXHwzHJs8SPuCJekAruP3UT3GbBmpBG H8IwUDcDxpRHu6DId6//o39mRwKBgQD1QouAw4n5Y006zdmUSVzB0KtdZBfwSJZ+ Ib6WasQ8evJ7SAVAGwSR2PwLUChPLn6fU03Mq6iwRg6jRvKV0+OS07VgYgAjdWlZ xLZ+EMDKKVL64DI2MkH7AnPAvOAiPJqZAfuKTrjSLPsUejlgPi5G98xeji5wvrgr xG6sQ4vPDQKBgHLk/BS1ISBpqDEP9/DJ1+7rvXDhKbEx/PI6BjkSyWcLpf1ISaDw wVQBmCLluUr6wlfpdVKEHdHWr4mRx1orRwvN27NZZA2D6vQAV+fT1XuSida9d9UN TycSg0gBsojXkWQYK+jDw6RD0AXv6vsuroXPMl/YFyh/Cyq5Hye2gCshAoGAVhlx XdfHdRxOPWmMi4khngzCS/vah4kEA+2WublrgIvs2iiTZ0jU1tqkyNfv/rQk0Yvu EP7mLlO5ycobWUvUZXQbBWYCBHCwdkofgqwg8heFwPq5xdro3NSkjDICQSKjZzmR 86DlMyuFTVAHGmlZ16IgRcWGOiBKCVthOupPh3UCgYB1VuyiL/+AoULAtzvCOcj9 LT3XqfkVKraXFIroAiVswzSgmHUiGKI4JG0IXKDipevzZ/sf3MNjZPhZVmvA3P+3 9iaOn0HoWmVFWy0LysgTdZGOcAvlqjNpW+S4B4bp8kiVMKJS0AEKXx/0vbGDIYew JUu06Zc9h4bVfnpJLuMa1A== -----END PRIVATE KEY----- ";
$test = strlen($key);
console_log("test");

var_dump($_POST["data"]);
$message = private_key_decrypt($test22, $server_priv_key);
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

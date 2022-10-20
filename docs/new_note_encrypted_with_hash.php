<?php
include("database/db_conn.php");

$message = htmlspecialchars($_POST['message']);
$hash = $POST['hash'];

if (!isset($_POST['message'])) {
    header("Location: ../homepage.php");
}

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

if (compare_hash($message, $hash)) {
    $query = "INSERT INTO notes (message, hash_sha256) VALUES ('$message', '$data_encrypted')";
    $result = $conn->query($query);

    console_log("Result: " . $result);

    header("Location: ../homepage.php");
    mysqli_close($conn);
} else {
    echo "FAILED";
}
// Console function
function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

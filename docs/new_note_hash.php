<?php
    include("database/db_conn.php");

	$message = htmlspecialchars($_POST['message']);

    if(!isset($_POST['message'])){
        header("Location: ../homepage.php");
    }
    
    $query = "INSERT INTO notes (message, hash_sha256) VALUES ('$message', '$data_encrypted')";
	$result = $conn->query($query);
	
    console_log("Result: ".$result);

	header("Location: ../homepage.php");
	mysqli_close($conn);

    // Console function
    function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log('.json_encode($output, JSON_HEX_TAG).');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }
?>
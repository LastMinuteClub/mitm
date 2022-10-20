<?php
    include("database/db_conn.php");

    if(!isset($_POST['message-copy']) && !isset($_POST['time'])){
        header("Location: ../homepage.php");
    }

    function private_key_decrypt($data, $privatekey)
    {
        //Decrypt using a private key
        openssl_private_decrypt($data, $decrypted_data, $privatekey);
        return $decrypted_data; //Returns decrypted data
    }
    
	$message = htmlspecialchars($_POST['message-copy']);
    
    $message = private_key_decrypt($message, "ADD PRIV KEY");
    
    $timeReceived = intval(microtime(true) * 1000); // 1666237644022
    $timeSent = $_POST['time'];                     // 1666233312494

    // for cases where miliseconds are friends of 10
    if(strlen($timeSent) != strlen($timeReceived)){
        $timeSent *= 10;
        console_log("added 10");
    }

    $timeDifference = $timeReceived - $timeSent;

    if($timeDifference > 100){
        header("Location: ../homepage.php?error=Warning! MITM detected: Too long to receive");
    } else {
        $query = "INSERT INTO notes (message) VALUES ('$message')";
        $result = $conn->query($query);
        
        console_log("Result: ".$result);

        header("Location: ../homepage.php");
    }

    console_log($timeDifference);
    
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
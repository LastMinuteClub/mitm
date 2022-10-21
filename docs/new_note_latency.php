<?php
    include("database/db_conn.php");

    //Checks that a message exists, if not redirects back to homepage
    if(!isset($_POST['message-copy']) && !isset($_POST['time'])){
        header("Location: ../homepage.php");
    }

	$message = htmlspecialchars($_POST['message-copy']); //Get message
    
    $timeReceived = intval(microtime(true) * 1000); // 1666237644022
    $timeSent = $_POST['time'];                     // 1666233312494 Get time that message was sent on frontend

    // for cases where miliseconds are friends of 10
    if(strlen($timeSent) != strlen($timeReceived)){
        $timeSent *= 10;
        console_log("added 10");
    }

    $timeDifference = $timeReceived - $timeSent; //Calculate time difference

    if($timeDifference > 100){
        header("Location: ../homepage.php?error=Warning! MITM detected: Too long to receive"); //Display error
    } else {
        $query = "INSERT INTO notes (message) VALUES ('$message')";
        $result = $conn->query($query); //Add message to database
        console_log("Result: ".$result);
        header("Location: ../homepage.php");
    }

    console_log($timeDifference); //Display time difference in console
    
	mysqli_close($conn); //Close connection to DB

    // Console function
    function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log('.json_encode($output, JSON_HEX_TAG).');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }
?>
<?php
    include_once("docs/database/db_conn.php");
    print_r($_POST);

	$message = htmlspecialchars($_POST['origin']); //Get message
    $iv = htmlspecialchars($_POST['iv']); //Get IV length for encryption

    //Check that message exists, if not it redirects back to homepage
    if(!isset($_POST['message'])){
         header("HTTP/1.1 400 Bad Request");
    }

    // check whether message changed
    if(hash('sha256',utf8_encode($_POST['origin'])) != $_POST['hash']){
        header("HTTP/1.1 400 message changes");
        console_log("Result: message has been changed"); //Put result in console
     
    }else{
    $query = "INSERT INTO `notes` (`message`) VALUES ('$message')";
	$result = $conn->query($query); //Insert message into database
	
    console_log("Result: ".$result); //Put result in console
    }
	mysqli_close($conn); //Close connection to database

    // Console function
    function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log('.json_encode($output, JSON_HEX_TAG).');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }
?>
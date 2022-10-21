<?php
    include_once("docs/database/db_conn.php");
    print_r($_POST);



	$message = htmlspecialchars($_POST['origin']);
    $iv = htmlspecialchars($_POST['iv']);

    if(!isset($_POST['message'])){
         header("HTTP/1.1 400 Bad Request");
    }
    // check whether message changed
    if(hash('sha256',utf8_encode($_POST['origin'])) != $_POST['hash']){
        header("HTTP/1.1 400 message changes");
        console_log("Result: message has been changed");
     
    }else{
    $query = "INSERT INTO `notes` (`message`) VALUES ('$message')";
	$result = $conn->query($query);
	
    console_log("Result: ".$result);
    }
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
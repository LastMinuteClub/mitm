<?php
    include("database/db_conn.php");

	$message = htmlspecialchars($_POST['message']); //Get message

    //Checks message exists, if not redirects to home page
    if(!isset($_POST['message'])){
        header("Location: ../homepage.php");
    }
    
    $query = "INSERT INTO notes (message) VALUES ('$message')";
	$result = $conn->query($query); //Insert message into DB

	mysqli_close($conn); //Close connection to DB
	header("Location: ../homepage.php"); //Redirects to homepage

    // Console function
    function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log('.json_encode($output, JSON_HEX_TAG).');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }
?>
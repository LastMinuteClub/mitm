<?php
    include("database/db_conn.php");

    $query = "TRUNCATE TABLE notes";

    if(isset($_POST['message'])){
        
    }
    
	$result = $conn->query($query);

	header("Location: ../homepage.php?message=hello_there:)");	
	mysqli_close($conn);
?>
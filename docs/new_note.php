<?php
    include("database/db_conn.php");

	$message = $_POST['message'];

    if(isset($_POST['message'])){
        header("Location: ../homepage.php");
    }
	
    $query = "INSERT INTO notes (message) VALUES ('$message')";
	$result = $conn->query($query);
	
	header("Location: ../homepage.php?message=".$message);	
	mysqli_close($conn);
?>
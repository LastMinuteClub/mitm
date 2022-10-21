<?php
    include("database/db_conn.php"); //Database connection file

    $query = "TRUNCATE TABLE notes"; //Query for mySQL
    
	$result = $conn->query($query); //Execute query

	header("Location: ../homepage.php?message=hello_there:)"); //Navigate back to homepage	
	mysqli_close($conn); //Close database connection
?>
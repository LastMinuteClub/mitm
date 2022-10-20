<?php
	include("session/session.php");
	include ("db_conn.php");
	
	$hostID = $_POST['hostID']; //Store post variables to PHP variables
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$bio = $_POST['bio'];
	
	// Update client
	$query = "UPDATE hosts SET firstName = '$fname', lastName = '$lname', 
		email = '$email', phoneNumber = '$phone', address = '$address', bio = '$bio' WHERE hostID = '$hostID'";
	
	//Query DB
	$conn->query($query);
	
	//Change page
	header("Location: admin-dashboard.php");
	
	//Close connection to DB
	mysqli_close($conn);
?>
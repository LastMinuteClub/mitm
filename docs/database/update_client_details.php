<?php
	include("session/session.php");
	include ("db_conn.php");
	
	$clientID = $_POST['clientID']; //Store post variables to PHP variables
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$accesslvl = $_POST['client-level'];
	
	// Update client
	$query = "UPDATE clients SET firstName = '$fname', lastName = '$lname', 
		email = '$email', phoneNumber = '$phone', address = '$address', accessLevel = '$accesslvl' WHERE clientID = '$clientID'";
	
	//Query DB
	$conn->query($query);
	
	//Echo result
	echo "query: ".$query;
	
	//Change page
	header("Location: admin-dashboard.php");
	
	//Close DB connection
	mysqli_close($conn);
?>
<?php
	include("session/session.php");
	include ("db_conn.php");
	
	$clientID = $_POST['clientID'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$accesslvl = $_POST['client-level'];
	
	// Update client
	$query = "UPDATE clients SET firstName = '$fname', lastName = '$lname', 
		email = '$email', phoneNumber = '$phone', address = '$address', accessLevel = '$accesslvl' WHERE clientID = '$clientID'";
	
	$conn->query($query);
	
	echo "query: ".$query;
	
	header("Location: admin-dashboard.php");
	
	mysqli_close($conn);
?>
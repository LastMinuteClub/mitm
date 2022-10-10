<?php
	include("session/session.php");
	include ("db_conn.php");
	
	$hostID = $_POST['hostID'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$bio = $_POST['bio'];
	
	// Update client
	$query = "UPDATE hosts SET firstName = '$fname', lastName = '$lname', 
		email = '$email', phoneNumber = '$phone', address = '$address', bio = '$bio' WHERE hostID = '$hostID'";
	
	$conn->query($query);
	
	header("Location: admin-dashboard.php");
	
	mysqli_close($conn);
?>
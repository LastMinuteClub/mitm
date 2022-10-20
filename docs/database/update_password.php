<?php
	include("session/session.php");
	include 'db_conn.php';
	
	$password = $_POST['password'];
	$who = $_POST['who'];
	
	$encrypt_password = password_hash($password, PASSWORD_BCRYPT);
	
	// If user is client
	if($who == "client") {
		$query = "UPDATE clients SET password = '$encrypt_password' WHERE clients.email = '$session_user'";
	} else {
		$query = "UPDATE hosts SET password = '$encrypt_password' WHERE hosts.email = '$session_user'";
	}
	
	//Query DB
	$conn->query($query);
	
	//Change page
	header("Location: my-details.php");
	
	//Close connection to DB
	mysqli_close($conn);
?>
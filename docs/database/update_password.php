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
	
	$conn->query($query);
	
	header("Location: my-details.php");
	
	mysqli_close($conn);
?>
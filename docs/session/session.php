<?php
// This is just an example php file. Not currently used in this application

//starting session
session_start();

//if the session for username has not been set, initialise it
if(!isset($_SESSION['session_user']))
{
		$_SESSION['session_user']="";
		$_SESSION['access_lvl'] = 0;
}

//save username in the session 
$session_user=$_SESSION['session_user'];
?>

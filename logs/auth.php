<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['userid']) || (trim($_SESSION['userid']) == '')) {
		header("location: ../index.php");
		exit();
	}
?>
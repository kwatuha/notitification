<?php

//Start session
	session_start();
	
	//Unset the variables stored in session
	/*unset($_SESSION['my_username']);
	unset($_SESSION['userid']);
	unset($_SESSION['assignval']) ;
	unset($_SESSION['appval']) ;
	unset($_SESSION['appinstr']);
	unset($_SESSION['addinstruction']) ;
	unset($_SESSION['dispatchdocs']) ;
	unset($_SESSION['apprveproforma']) ;*/
//	unset($_SESSION['SESS_LAST_NAME']);

	session_unset();
	
	$_SESSION=array();
	session_destroy();
	header("Location:../index.php");
	

?>


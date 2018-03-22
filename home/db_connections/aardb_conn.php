<?php
	
	$hostname = "localhost";
	$database = "webuyeaccbill";
	$username = "root";
	$password = "";
	
	    
	$db_conn = mysql_connect($hostname, $username, $password) or trigger_error(mysql_error(), E_USER_ERROR); 
		
    mysql_select_db("$database") or trigger_error(mysql_error(), E_USER_ERROR); 
   
?>
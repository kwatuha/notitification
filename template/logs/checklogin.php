<?php
         session_start(); 
   include('../db_connections/aardb_conn.php'); 	
		function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	   }
	
	  $myusername = clean($_POST['email']);
	  $mypassword = clean($_POST['password']);
	
	 if($myusername=='' or $mypassword=='')	
		  {
		   header("location:../index.php");
			 }
		else
		{  			
 $sql="SELECT * FROM login WHERE employeeid='$myusername' and password='".md5($_POST['password'])."'";
      $result=mysql_query($sql, $db_conn) or die("Error: Querying users table");

            
			
     $count=mysql_num_rows($result);

       if ($count==1)
	   {
         session_start();
         $row = mysql_fetch_assoc($result) ;
         $_SESSION['my_username']= $row['firstname'] ;
		 $_SESSION['userid']=$row['autoid'] ;
		 session_write_close();
		 
		  mysql_free_result($result);
		      
	          header("location:../agency/agency.php");
			  exit();
			 }
        else {
		       header("location:../index.php");
			  exit();
	    }
	       
		}
?>
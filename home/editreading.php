<?php
include('db_connections/aardb_conn.php');
session_start();

$save=1;

           $bdate=$_GET["bdate"];  
           $curdate=$_GET["curdate"];  
           $curreading=$_GET["curreading"]; 
           $accnumber=$_GET["accnumber"]; 
           $preading=$_GET["preading"];  
           $pdate=$_GET["pdate"];
           $recid=$_GET["recid"];
           $today=strtotime(date('Y-m-d'));
           $bdate=strtotime($bdate);
           $curdate=strtotime($curdate);
           $pdate=strtotime($pdate);  
       
      if($curdate<=$pdate){
		  echo"Check the current reading date.";
		   $save=0;
		   
		 } 
      else if(!is_numeric($curreading)){
		  echo"Only numericals are accepted for current reading";
		   $save=0;
		   
		 }       
      else if($preading>$curreading){
		  echo"Check the current reading";
		   $save=0;
		   
		 }    
    
             
   if($save==1){ 
        
        
					$transdate=date("Y-m-d");
					$bdate=date("Y-m-d",$bdate); 
  			 
 $sql="UPDATE meterreadings SET mreading='".$curreading."' WHERE accountno='".$accnumber."' AND billingdate='".$bdate."';";
 if (!mysql_query($sql,$db_conn)){
					 echo"The record could not be updated! Contact adm";
					}
				  else{
				  echo"The reading has been updated successfully";
				     }
				   mysql_close($db_conn); 
			}	

?>

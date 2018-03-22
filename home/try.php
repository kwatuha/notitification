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
             
     else if($curdate>$today){
		  echo"Current reading date is pointing to the future";
		   $save=0;
		 }    
            
    else if($bdate<$today){
		  echo"Wrong billing date";
		   $save=0;
		   
		 } 
      else if($preading>$curreading){
		  echo"Check the current reading";
		   $save=0;
		   
		 } 
      else if($recid==""){
		  echo"The Record has no identification number!";
		   $save=0;
		   
		 }    
    
             
   if($save==1){ 
        //echo"The record could not be saved.";
        
					$transdate=date("Y-m-d");
					$bdate=date("Y-m-d",$bdate); 
				 
 $sql="INSERT INTO meterreadings(accountno,mreading,billingdate,transdate)VALUES('".$accnumber."','".$curreading."','".$bdate."','".$transdate."');";
 if (!mysql_query($sql,$db_conn)){
					 echo"The record could not be saved.";
					}
				  else{
				  $reclist=$_SESSION["listofids"];
				  $currcpos=array_search($recid,$reclist);
				  $nxtpos=$currcpos + 1;
				  $nxtelement=$reclist[$nxtpos];
				  if($nxtelement==null){
            echo $reclist[0];
          }
				    echo $nxtelement;
				     }
				   mysql_close($db_conn); 
			}	

?>

<?php
function getdates(){
include('db_connections/aardb_conn.php');
$sqldates="SELECT previousdate,currentdate FROM setbillingdates";
$qrydates=mysql_query($sqldates);
    if($qrydates){
     $numrws=mysql_num_rows($qrydates);
        if($numrws==0){
          return 0;
        }
        else{
        $rws=mysql_fetch_array($qrydates);
        $prevbilldate=$rws['previousdate'];
        $curbilldate=$rws['currentdate'];
        $dtes=$prevbilldate."|".$curbilldate;
        return $dtes;
        }
    }
    else{
      return -1;
    }
}

function getprevreading($accnumber,$prevrdate){
$qrystat="SELECT mreading FROM meterreadings WHERE accountno=$accnumber AND billingdate='$prevrdate'";
$qryreading=mysql_query($qrystat);
      if($qryreading){
        $noofrecs=mysql_num_rows($qryreading);
        if($noofrecs==0){
          return 0;
        
        }
        else{
         $rwsreturned=mysql_fetch_array($qryreading);
         $reading=$rwsreturned['mreading'];
         return $reading;
        }
      
      }
      else{
        return -1;
      }


} 

function checkifexists($accnumber,$currdate){
$qrystat="SELECT mreading FROM meterreadings WHERE accountno=$accnumber AND billingdate='$currdate'";
$qryreading=mysql_query($qrystat);
      if($qryreading){
        $noofrecs=mysql_num_rows($qryreading);
        if($noofrecs==0){
          return 0;
        
        }
        else if($noofrecs==1){
         $rwsreturned=mysql_fetch_array($qryreading);
         $reading=$rwsreturned['mreading'];
         return $reading;
        }
      
      }
      else{
        return -1;
      }


}
function getConsumption($accno){
$thedates=getdates();
             if($thedates==-1){
                echo"There was an error in accessing the set dates.";
                exit();
             }
             else if($thedates==0){
                echo"No date has been set. Please set and continue";
                exit();
             }
             else {
             	$xploddates=explode("|",$thedates);
             	$prevrdate=$xploddates[0];
             	$curbdate=$xploddates[1];
             	$prevreaading=getprevreading($accno,$prevrdate);
             	$curreaading=getprevreading($accno,$curbdate);
             	
             	$consumption=$curreaading - $prevreaading;
             	return $consumption;
             	
             }


}

function val($pvalue){
include('db_connections/aardb_conn.php');
//require('../db_connections/aardb_conn.php');
//$scale='valplantmachinery';
/*
if($scale==1){
$scale='valurbanrate';

}
else if($scale==2){
$scale='valagricrate';

}
else if($scale==3){
$scale='valcompacq';

}
else if($scale==4){
$scale='valrental';

}
else if($scale==5){
$scale='valplantmachinery';

}
else if($scale==6){
$scale='valfurniture';

}
else if($scale==7){
$scale='valfittings';

}
 */
$qry="SELECT minstep,maxstep,rate FROM tariff_table order by autoid asc";
$results=mysql_query($qry) or die('Could not execute the query');
$llimit=array();
$ulimit=array();
$rate=array();

while($rws=mysql_fetch_array($results)){

$llimit[]=$rws['minstep'];
$ulimit[]=$rws['maxstep'];
$rate[]=$rws['rate'];
}
$rowsize=sizeof($llimit);
//echo $rowsize;
$totalvalcost=0;
$pvalue=$pvalue;
for($i=0;$i<$rowsize;$i++){
$lower=$llimit[$i];
$upper=$ulimit[$i];
$r=$rate[$i];
#####
if($i==($rowsize-1)){
$levelcharge=($r*$pvalue);
	
		$totalvalcost=$totalvalcost + $levelcharge;
		
}
else{
		if($pvalue>=$lower and $pvalue<=$upper){
		$levelcharge=($r*$pvalue);
		$totalvalcost=$totalvalcost + $levelcharge;
		break;
		
		}
		else if($pvalue>=$lower and $pvalue>$upper){
		$levelcharge=($r*$upper);
		$totalvalcost=$totalvalcost + $levelcharge;
		$pvalue=$pvalue-$upper;
		}
	/*	else {
		echo"Please check your values";
		
		}*/
}

#####

}
return $totalvalcost;
}
/*
$charge=val(600);
$charge=number_format($charge,2);
echo $charge;
*/
?>

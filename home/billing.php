<?php
include('db_connections/aardb_conn.php');
require('bdates.php');
$part=$_GET['t'];
session_start();
/*
if(!is_numeric($part)){
 echo"Your request could not be processed";
 exit();
} */
$part=mysql_real_escape_string($part);


if($part==1){
 postreadings();

}
else if($part==2){ 
fetchaccdetails();

}
else if($part==3){
searchacc();
}
else if($part==4){
 deposit();       

}
else if($part==7){
 fetchaccreadings();       

}
else if($part==11){   
 go();       

}
else if($part==22){
 fetchreadings();       

}
else if($part==33){
savemeterinfo();      

}
else if($part==44){
 savedeposit();       

}


//######################### save property details ################
function searchacc(){ 
echo" <table width=100% border=0 cellpadding=1 cellspacing=0>";
       echo" <tr>";
       echo" <th colspan=4 align=left><b>Ammend Meter Readings<b> </th>";
       echo" </tr>";
        echo" <tr>";
         echo" <th colspan=4 align=left></th>";
         echo" </table>";
         
        echo" <div id=controls style='border : solid 3px #ccccff;background : #cccccc; font-size:14px;color : #000000; padding : 1px; width : 490px; height : 310px; overflow : auto;'>";
        echo" <table width=60% border=0 cellpadding=1 cellspacing=0 align=left>";
        echo" <tr><td>&nbsp;</td></tr>";
        echo" <tr><td width=100%><form name=newproperty>";
        echo" <table width=100% border=0 cellpadding=1 cellspacing=0 align=left>";
        echo" <tr>";
        echo" <td>Account No</td>";
        echo"<td><input type=text name=accno id=accno size=20 tabindex=1 style='background : #ffffcc; font-size:14px;color : #336699;'></td>";
        echo" </tr>";
       
        echo" <tr><td>&nbsp;</td></tr>";
        
        echo" <tr>";
        echo"<td colspan=2 align=center><input type=button name=55 id=55 onfocus='reject(this.name);' value=Continue tabindex=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=reset name=cancel id=cancel value=Cancel tabindex=8></td>";       
        echo" </tr>";
        echo" </table>";
        echo" </form></td></tr>";
        echo" </div>";
}
function go(){
include('db_connections/aardb_conn.php');
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
		  echo"Current reading date refers to the future";
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
		  echo"The System encountered a fatal error.";
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
				    echo"good";
				     }
				   mysql_close($db_conn); 
			}	




}

//######################### save Basic information details ################
function fetchreadings(){ 
include('db_connections/aardb_conn.php'); 
$save=1;
 
           $custname=$_GET["custname"];  
           $gender=$_GET["gender"];  
           $address=$_GET["address"];  
           $phone=$_GET["phone"];  
           $email=$_GET["email"];  
           $pidd=$_GET["pidd"]; 
           $displ=$_GET["displ"]; 
           $custid=$_GET["custid"];  
           $idno=$_GET["idno"];  
           $pin=$_GET["pin"];  
     $custclass=$_GET["custclass"];  
              if($custname==""){
		  echo"custname field is blank. Please fill it and continue".$pidd;
		   $save=0;
		 }     
             
              else if($gender==""){
		  echo"gender field is blank. Please fill it and continue";
		   $save=0;
		 }    
             
              else if($address==""){
		  echo"address field is blank. Please fill it and continue";
		   $save=0;
		 }    
             
              else if($phone==""){
		  echo"phone field is blank. Please fill it and continue";
		   $save=0;
		 }    
             
              else if($email==""){
		  echo"email field is blank. Please fill it and continue";
		   $save=0;
		 }    
             
              else if($custid==""){
		  echo"custid field is blank. Please fill it and continue";
		   $save=0;
		 }    
             
              else if($idno==""){
		  echo"idno field is blank. Please fill it and continue";
		   $save=0;
		 }    
             
              else if($pin==""){
		  echo"pin field is blank. Please fill it and continue";
		   $save=0;
		 }    
             
              else if($custclass==""){
		  echo"custclass field is blank. Please fill it and continue";
		   $save=0;
		 }    
             
   if($save==1){ 
					$transdate=date("Y-m-d");
			 
 $sql="INSERT INTO basicinfo(custname,gender,address,phone,email,custid,idno,pin,custclass)VALUES('".$custname."','".$gender."','".$address."','".$phone."','".$email."','".$custid."','".$idno."','".$pin."','".$custclass."');";
 if (!mysql_query($sql,$db_conn)){
					 echo"The record could not be saved.";
					}
				  else{
				  
				 $udateprop="UPDATE property SET custid='".$idno."' WHERE autoid=$pidd";
				 $udatedb=mysql_query($udateprop);
				  if(!$udatedb){
            echo"The record could not be saved.";
          }
          else{
          $msg=$displ."|".$custname;
            echo $msg;
          }
				  
				     }
				   mysql_close($db_conn);
			}	


}

//######################### save meter details ################
function savemeterinfo(){
include('db_connections/aardb_conn.php');
$save=1;
 
      $make=$_GET["make"];  
      $serial=$_GET["serial"];  
     $size=$_GET["size"];
     $acnno=$_GET["acnno"];
     $displ=$_GET["displ"];  
              if($make==""){
		  echo"make field is blank. Please fill it and continue";
		   $save=0;
		 }     
             
              else if($serial==""){
		  echo"serial field is blank. Please fill it and continue";
		   $save=0;
		 }    
             
              else if($size==""){
		  echo"size field is blank. Please fill it and continue";
		   $save=0;
		 }    
             
   if($save==1){ 
					$transdate=date("Y-m-d");
					
					 
					  
			
				  
				 
 $sql="INSERT INTO meter(make,serial,size,accountno)VALUES('".$make."','".$serial."','".$size."','".$acnno."');";
 if (!mysql_query($sql,$db_conn)){
					 echo"The record could not be saved.";
					}
				  else{
				  
				 echo $displ;
				  
				     }
				   mysql_close($db_conn);
			}	



}
//######################### save deposit details ################
function savedeposit(){
include('db_connections/aardb_conn.php');
$save=1;
 
           $receipt=$_GET["receipt"];  
           $amount=$_GET["amount"];  
           $tdate=$_GET["tdate"];  
           $connid=$_GET["connid"];
           $acnno=$_GET["acnno"];
           $displ=$_GET["displ"];  
              if($receipt==""){
		  echo"receipt field is blank. Please fill it and continue";
		   $save=0;
		 }     
             
              else if($amount==""){
		  echo"amount field is blank. Please fill it and continue";
		   $save=0;
		 }    
             
              else if($tdate==""){
		  echo"tdate field is blank. Please fill it and continue";
		   $save=0;
		 }    
             
              else if($connid==""){
		  echo"connid field is blank. Please fill it and continue";
		   $save=0;
		 }    
             
   if($save==1){ 
	$transdate=date("Y-m-d");
			 
 $sql="INSERT INTO connectiondeposit(accountno,receipt,amount,tdate,connid)VALUES('".$acnno."','".$receipt."','".$amount."','".$tdate."','".$connid."');";
 if (!mysql_query($sql,$db_conn)){
					 echo"The record could not be saved.";
					}
				  else{
				  
				 echo"The record has been added successfully";
				  
				     }
				   mysql_close($db_conn);
			}	



}

//######################### end of save functions ################
function postreadings(){
echo" <table width=100% border=0 cellpadding=1 cellspacing=0>";
       echo" <tr>";
       echo" <th colspan=4 align=left><b>Meter Readings<b> </th>";
       echo" </tr>";
        echo" <tr>";
         echo" <th colspan=4 align=left></th>";
         echo" </table>";
         
        echo" <div id=controls style='border : solid 3px #ccccff;background : #cccccc; font-size:14px;color : #000000; padding : 1px; width : 460px; height : 260px; overflow : auto;'>";
        echo" <table width=60% border=0 cellpadding=1 cellspacing=0 align=left>";
        echo" <tr><td>&nbsp;</td></tr>";
        echo" <tr><td width=100%><form name=newproperty>";
        echo" <table width=100% border=0 cellpadding=1 cellspacing=0 align=left>";
        echo" <tr>";
        echo" <td>Account No</td>";
        echo"<td><input type=text name=accno id=accno size=20 tabindex=1 style='background : #ffffcc; font-size:14px;color : #336699;'></td>";
        echo" </tr>";
       
        echo" <tr><td>&nbsp;</td></tr>";
        
        echo" <tr>";
        echo"<td colspan=2 align=center><input type=button name=11 id=11 onfocus='reject(this.name);' value=Continue tabindex=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=reset name=cancel id=cancel value=Cancel tabindex=8></td>";       
        echo" </tr>";
        echo" </table>";
        echo" </form></td></tr>";
        echo" </div>";

}


 function display($data){
  $data=stripslashes($data);
  return $data;
 }
//####################################### fetching account details #########################################
function fetchaccdetails(){

if(!empty($_GET['accno']) && $_GET['accno']!=0 && is_numeric($_GET['accno'])){
             $account=$_GET['accno'];
             $account=mysql_real_escape_string($account);
             $account=strip_tags($account);
             //########### fetch details###########
             $sql="SELECT property.autoid,block, plot,zone,walk, connectionno,street,estate,custname,address,idno,accountno from property inner join basicinfo  on property.custid=basicinfo.idno WHERE accountno=$account";
             $qrydb=mysql_query($sql);
   if($qrydb){
   
   $numrows=mysql_num_rows($qrydb);
        if($numrows==1){
        
            $rws=mysql_fetch_array($qrydb);
            $recid=$rws['autoid'];
            $block=$rws['block'];
            $plot=$rws['plot'];
            $zone=$rws['zone'];
            $walk=$rws['walk'];
            $connectionno=$rws['connectionno'];
            $street=$rws['street'];
            $estate=$rws['estate'];
            $custname=$rws['custname'];
            $address=$rws['address'];
            $idno=$rws['idno'];
            $accountno=$rws['accountno'];
            $connid=$block."/".$plot."/".$connectionno;
            
            $custname=display($custname);
            $street=display($street);
            $estate=display($estate);
            $address=display($address);
            //################################# fetch dates #####################
             $thedates=getdates();
             if($thedates==-1){
                echo"There was an error accessing the set dates.";
                
             }
             else if($thedates==0){
                echo"Billing dates have not been set. Please set and continue";
                
             }
             else {
             	$xploddates=explode("|",$thedates);
             	$prevrdate=$xploddates[0];
             	$curbdate=$xploddates[1];
             	$prevreaading=getprevreading($accountno,$prevrdate);
             	
             }
            
            //################################# end of fetch dates ##############
            
            //################################ check if reaading for this month already exists #################
            $curmreading=checkifexists($accountno,$curbdate);
            if($curmreading==-1){
              //echo"Current reading could not checked";
              $existss=1;
              $val=0;
            }
            else if($curmreading==0){
              $existss=0;
               $val=0;
            }
            else{
           // echo"Current reading could not checked";
             $existss=0;
              $val=$curmreading;
            
            }
            
            
            //############################## confirm this months reading #####################################
           
            $today=date("Y-m-d");
            
            //################## Prepare a list of accounts #############
              $sellist="SELECT autoid from property WHERE isactive=1 AND zone=$zone ORDER BY block,plot,connectionno";
              $qrylist=mysql_query($sellist);
              $listids=array();
              if($qrylist){
              
                while($list=mysql_fetch_array($qrylist)){
                  $id=$list['autoid'];
                  $listids[]=$id;
                
                }
                
              }
              else{
              echo"Could not build a list of connections!";
              }
        if(sizeof($listids)!=0){
           
           $_SESSION['listofids']=$listids;
        }
              
            
            
            //####################### list of accounts ##################
        
           echo" <table width=100% border=0 cellpadding=1 cellspacing=0>";
       echo" <tr>";
       echo" <th colspan=4 align=left><b>Account Details<b> </th>";
       echo" </tr>";
        echo" <tr>";
         echo" <th colspan=4 align=left></th>";
         echo" </table>";
         
        echo" <div id=controls style='border : solid 3px #ccccff;background : #cccccc; font-size:14px;color : #000000; padding : 1px; width : 480px; height : 300px; overflow : auto;'>";
        echo" <table width=80% border=0 cellpadding=1 cellspacing=0 align=left>";
       
        
        echo" <tr><td colspan=4><form name=basicinfo>";
        echo" <table width=100% border=0 cellpadding=1 cellspacing=0 align=left>";
        echo" <tr>";
        echo" <td>Connection</td>";
        echo"<td><label>$connid</label></td>";
        echo" <td>Account No</td>";
        echo"<td><label>$accountno</label></td>";
        echo" </tr>";
        echo"<td colspan=4>&nbsp;</td>";
        echo" <tr>";
        echo" <td>Account Name</td>";
        echo"<td><label>$custname</label></td>";
        echo"<td colspan=2>&nbsp;</td>";
        echo" </tr>";
        echo" <tr>";
        echo" <td>Address</td>";
        echo"<td><label>$address</label></td>";
        echo"<td colspan=2>&nbsp;</td>";
        echo" </tr>";
        echo" <tr><td colspan=6><hr size=2></td></tr>";
        /*echo" <tr>";
        echo" <td>Address</td>";
        echo"<td><textarea name=address id=address rows=1 cols=38 tabindex=3 style='background : #ffffcc; font-size:14px;color : #336699;'></textarea></td>";
        echo"<td colspan=2>&nbsp;</td>";
        echo" </tr>"; */
        //echo" <tr><td>&nbsp;<input type=hidden name=pid id=pid size=12 value=\"$propid\" tabindex=30><input type=hidden name=displ id=displ size=15 value=\"$tbl\" tabindex=30></td></tr>";
        echo" </tr>";
        echo" <tr>";
       
        echo" <td>Previous Reading Date</td>";
        echo" <td>Previous Reading</td>";
         echo"<td>&nbsp;</td>";
        echo"<td>&nbsp;</td>";
        echo" </tr>";
        echo" <tr>";
        echo"<td><label>$prevrdate</label></td>";
        echo"<td><label>$prevreaading</label></td>";
         echo"<td>&nbsp;<input type=hidden name=pdate id=pdate size=12 value=\"$prevrdate\" tabindex=30></td>";
        echo"<td>&nbsp;<input type=hidden name=preading id=preading size=12 value=\"$prevreaading\" tabindex=30></td>";       
        echo" </tr>";
        echo" <tr><td colspan=4><hr size=2></td></tr>";
         echo" <tr>";
  
        echo" <td>Current Reading Date</td>";
        echo" <td>Current Reading</td>";
         echo"<td>&nbsp;<input type=hidden name=accnumber id=accnumber size=12 value=\"$accountno\" tabindex=30></td>";
        echo"<td>&nbsp;<input type=hidden name=recid id=recid size=12 value=\"$recid\" tabindex=30></td>";
        echo" </tr>";
        echo" <tr>";
       
        echo"<td><input type=text name=curdate id=curdate size=10 tabindex=5 value=$today></td>";
        if($val!=0){
        echo"<td><input type=text name=curreading id=curreading size=10 tabindex=5 value=\"$val\" readonly=\"true\"></td>";
        }
        else{
         echo"<td><input type=text name=curreading id=curreading size=10 tabindex=5 value=\"$val\"></td>";
        }
         echo"<td>&nbsp;</td>";
        echo"<td>&nbsp;</td>";       
        echo" </tr>";
        echo" <tr><td colspan=4><hr size=2></td></tr>";
        
         echo" <tr>";
        
        echo" <td>Billing Date</td>";
        echo"<td><input type=text name=bdate id=bdate size=10 tabindex=8 value=$curbdate></td>";
          echo"<td>&nbsp;</td>";
        echo"<td>&nbsp;</td>";
        echo" </tr>";
        echo" <tr><td>&nbsp;</td></tr>";
        
        echo" <tr>";
        if($val==0){
        echo"<td colspan=4 align=right><input type=button name=22 id=22 onfocus='reject(this.name);'  value=Post-Reading tabindex=10>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=button name=cancel id=cancel value=Cancel tabindex=11 onclick='hidden();'></td>";       
        }
        
        echo" </tr>";
        echo" </table>";
        echo" </form></td></tr>";
        echo" </div>";
        }
        else{
         echo"The Account No. doesnt exist in the database.";
        }
    
   }
   else{
    echo"Could not fetch details for the account";
   
   }
              
                
            }
            else{
             echo"Invalid Account No.";
            
            }



}
///$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

function personalinfo(){

echo" <table width=100% border=0 cellpadding=1 cellspacing=0>";
       echo" <tr>";
       echo" <th colspan=4 align=left><b>Customer Basic Information<b> </th>";
       echo" </tr>";
        echo" <tr>";
         echo" <th colspan=4 align=left></th>";
         echo" </table>";
         
        echo" <div id=controls style='border : solid 3px #ccccff;background : #cccccc; font-size:14px;color : #000000; padding : 1px; width : 490px; height : 310px; overflow : auto;'>";
        echo" <table width=60% border=0 cellpadding=1 cellspacing=0 align=left>";
        if(!empty($_GET['f']) && $_GET['f']!=0){
             $tbl=$_GET['f'];
             $xplod=explode("|",$tbl);
             $con=$xplod[0];
             $propid=$xplod[1]; 
             $acc=$xplod[2];
             echo" <tr><td>Connid:&nbsp;&nbsp;$con&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Account:&nbsp;&nbsp;$acc</td></tr>"; 
                
            }
        
        
        
        echo" <tr><td>&nbsp;</td></tr>";
        echo" <tr><td width=100%><form name=basicinfo>";
        echo" <table width=100% border=0 cellpadding=1 cellspacing=0 align=left>";
        echo" <tr>";
        echo" <td>Name</td>";
        echo"<td><input type=text name=custname id=custname size=45 tabindex=1></td>";
        echo" </tr>";
        echo" <tr>";
        echo" <td>Gender</td>";
        echo"<td>";
        echo"<select name=gender id=gender tabindex=2>";
        echo"<option value=0>Select Gender</option>";
        echo"<option value=1>Male</option>";
        echo"<option value=2>Female</option>";
        echo"</select>";
        echo"</td>";
        echo" </tr>";
        echo" <tr>";
        echo" <td>Address</td>";
        echo"<td><textarea name=address id=address rows=2 cols=38 tabindex=3 style='background : #ffffcc; font-size:14px;color : #336699;'></textarea></td>";
        echo" </tr>";
        echo" <tr><td>&nbsp;<input type=hidden name=pid id=pid size=12 value=\"$propid\" tabindex=30><input type=hidden name=displ id=displ size=15 value=\"$tbl\" tabindex=30></td></tr>";
        echo" </tr>";
        echo" <tr>";
        echo" <td>Phone No</td>";
        echo"<td><input type=text name=phone id=phone size=30 tabindex=4></td>";
        echo" </tr>";
        echo" <tr>";
        echo" <td>Email</td>";
        echo"<td><input type=text name=email id=email size=30 tabindex=5></td>";       
        echo" </tr>";
        
         echo" <tr>";
        echo" <td>Identification</td>";
        echo"<td>";
        echo"<select name=custid id=custid tabindex=6>";
        echo"<option value=0>Select</option>";
        echo"<option value=1>ID No</option>";
        echo"<option value=2>Passport No</option>";
        echo"<option value=3>Company ID</option>";
        echo"</select>&nbsp;&nbsp;&nbsp;<input type=text name=idno id=idno size=14 tabindex=7>";
        echo"</td>";
        echo" </tr>"; 
         echo" <tr>";
        echo" <td>PIN</td>";
        echo"<td><input type=text name=pin id=pin size=10 tabindex=8></td>";       
        echo" </tr>";
         echo" <tr>";
        echo" <td>Classification</td>";
        echo"<td>";
        echo"<select name=custclass id=custclass tabindex=9>";
        echo"<option value=0>Select Consumer Classification</option>";
        echo"<option value=1>ID No</option>";
        echo"<option value=2>Passport No</option>";
        echo"<option value=3>Company ID</option>";
        echo"</select>";
        echo"</td>";
        echo" </tr>";
        echo" <tr><td>&nbsp;</td></tr>";
        
        echo" <tr>";
        echo"<td colspan=2 align=center><input type=button name=22 id=22 onclick='reject(this.name);'  value=Save-Basic-Info tabindex=10>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=button name=cancel id=cancel value=Cancel tabindex=11 onclick='hidden();'></td>";       
        echo" </tr>";
        echo" </table>";
        echo" </form></td></tr>";
        echo" </div>";

}

function meterinfo(){
echo" <table width=100% border=0 cellpadding=1 cellspacing=0>";
       echo" <tr>";
       echo" <th colspan=4 align=left><b>Meter Information<b> </th>";
       echo" </tr>";
        echo" <tr>";
         echo" <th colspan=4 align=left></th>";
         echo" </table>";
         
        echo" <div id=controls style='border : solid 3px #ccccff;background : #cccccc; font-size:14px;color : #000000; padding : 1px; width : 490px; height : 310px; overflow : auto;'>";
        echo" <table width=40% border=0 cellpadding=1 cellspacing=0 align=left>";
        if(!empty($_GET['f']) && $_GET['f']!=0){
             $tbl=$_GET['f'];
             $xplod=explode("|",$tbl);
             $con=$xplod[0];
             $propid=$xplod[1]; 
             $acc=$xplod[2];
             $custname=$xplod[3];
             echo" <tr><td>Connid:&nbsp;&nbsp;$con&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Account:&nbsp;&nbsp;$acc&nbsp;&nbsp;<br>Name:&nbsp;&nbsp;$custname</td></tr>"; 
                
            }
        echo" <tr><td>&nbsp;</td></tr>";
        echo" <tr><td width=100%><form name=meterinfo>";
        echo" <table width=100% border=0 cellpadding=1 cellspacing=0 align=left>";
        
        echo" <td>Make</td>";
        echo"<td>";
        echo"<select name=make id=make tabindex=1>";
        echo"<option value=0>Select Make</option>";
        echo"<option value=1>KENT</option>";
        echo"<option value=2>SOCCUM</option>";
        echo"</select>";
        echo"</td>";
        echo" </tr>";
        echo" <tr><td>&nbsp;</td></tr>";
        echo" <tr>";
        echo" <td>Serial No</td>";
        echo"<td><input type=text name=serial id=serial size=15 tabindex=2></td>";
        echo" </tr>";
        echo" <tr><td>&nbsp;</td></tr>";
        echo" <tr>";
        echo" <td>Size(mm)</td>";
         echo"<select name=size id=size tabindex=3>";
        echo"<option value=0>Select Size</option>";
        echo"<option value=1>1/4</option>";
        echo"<option value=2>1/2</option>";
        echo"<option value=3>3/4</option>";
        echo"</select>";
        echo"</td>";
        echo" </tr>";
       
        echo" <tr><td>&nbsp;<input type=hidden name=acnno id=acnno size=12 value=\"$acc\" tabindex=30><input type=hidden name=displ id=displ size=15 value=\"$tbl\" tabindex=30></td></tr>";
        
        echo" <tr>";
        echo"<td colspan=2 align=center><input type=button name=33 id=33 onclick='reject(this.name);' value=Save-Meter-Info tabindex=7>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=reset name=cancel id=cancel value=Cancel tabindex=8></td>";       
        echo" </tr>";
        echo" </table>";
        echo" </form></td></tr>";
        echo" </div>";


}

function deposit(){
echo" <table width=100% border=0 cellpadding=1 cellspacing=0>";
       echo" <tr>";
       echo" <th colspan=4 align=left><b>Customer Deposit Information<b> </th>";
       echo" </tr>";
        echo" <tr>";
         echo" <th colspan=4 align=left></th>";
         echo" </table>";
         
        echo" <div id=controls style='border : solid 3px #ccccff;background : #cccccc; font-size:14px;color : #000000; padding : 1px; width : 490px; height : 310px; overflow : auto;'>";
        echo" <table width=40% border=0 cellpadding=1 cellspacing=0 align=left>";
        if(!empty($_GET['f']) && $_GET['f']!=0){
             $tbl=$_GET['f'];
             $xplod=explode("|",$tbl);
             $con=$xplod[0];
             $propid=$xplod[1]; 
             $acc=$xplod[2];
             $custname=$xplod[3];
             echo" <tr><td>Connid:&nbsp;&nbsp;$con&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Account:&nbsp;&nbsp;$acc&nbsp;&nbsp;<br>Name:&nbsp;&nbsp;$custname</td></tr>"; 
                
            }
        echo" <tr><td>&nbsp;</td></tr>";
        echo" <tr><td width=100%><form name=meterinfo>";
        echo" <table width=100% border=0 cellpadding=1 cellspacing=0 align=left>";
         echo" <tr>";
        echo" <td>Receipt No</td>";
        echo"<td><input type=text name=receipt id=receipt size=15 tabindex=1></td>";
        echo" </tr>";
        echo" <td>Amount</td>";
         echo"<td><input type=text name=amount id=amount size=15 tabindex=2></td>";
        echo" </tr>";
        echo" <tr><td>&nbsp;</td></tr>";
        echo" <tr>";
        echo" <td>Date</td>";
        echo"<td><input type=text name=tdate id=tdate size=15 tabindex=3></td>";
        echo" </tr>";
        
         echo" <tr>";
        echo" <td>Connid</td>";
        echo"<td><input type=text name=connid id=connid size=15 tabindex=4></td>";
        echo" </tr>";
       
        echo" <tr><td>&nbsp;<input type=hidden name=acnno id=acnno size=12 value=\"$acc\" tabindex=30><input type=hidden name=displ id=displ size=15 value=\"$tbl\" tabindex=30></td></tr>";
        
        echo" <tr>";
        echo"<td colspan=2 align=center><input type=button name=44 id=44 onclick='reject(this.name);' value=Save-Deposit-Info tabindex=5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=reset name=cancel id=cancel value=Cancel tabindex=6></td>";       
        echo" </tr>";
        echo" </table>";
        echo" </form></td></tr>";
        echo" </div>";

}


//####################################### fetching account details #########################################
function fetchaccreadings(){

if(!empty($_GET['accno']) && $_GET['accno']!=0 && is_numeric($_GET['accno'])){
             $account=$_GET['accno'];
             $account=mysql_real_escape_string($account);
             $account=strip_tags($account);
             //########### fetch details###########
             $sql="SELECT property.autoid,block, plot, zone,walk,connectionno,street,estate,custname,address,idno,accountno from property inner join basicinfo  on property.custid=basicinfo.idno WHERE accountno=$account";
             $qrydb=mysql_query($sql);
   if($qrydb){
   
   $numrows=mysql_num_rows($qrydb);
        if($numrows==1){
        
            $rws=mysql_fetch_array($qrydb);
            $recid=$rws['autoid'];
            $block=$rws['block'];
            $plot=$rws['plot'];
            $zone=$rws['zone'];
            $walk=$rws['walk'];
            $connectionno=$rws['connectionno'];
            $street=$rws['street'];
            $estate=$rws['estate'];
            $custname=$rws['custname'];
            $address=$rws['address'];
            $idno=$rws['idno'];
            $accountno=$rws['accountno'];
            $connid=$block."/".$plot."/".$connectionno;
            
            $custname=display($custname);
            $street=display($street);
            $estate=display($estate);
            $address=display($address);
            //################################# fetch dates #####################
             $thedates=getdates();
             if($thedates==-1){
                echo"There was an error accessing the set dates.";
                
             }
             else if($thedates==0){
                echo"Billing dates have not been set. Please set and continue";
                
             }
             else {
             	$xploddates=explode("|",$thedates);
             	$prevrdate=$xploddates[0];
             	$curbdate=$xploddates[1];
             	$prevreaading=getprevreading($accountno,$prevrdate);
             	
             }
            
            //################################# end of fetch dates ##############
            
            //################################ check if reaading for this month already exists #################
            $curmreading=checkifexists($accountno,$curbdate);
            if($curmreading==-1){
              //echo"Current reading could not checked";
              $existss=1;
              $val=0;
            }
            else if($curmreading==0){
              $existss=0;
               $val=0;
            }
            else{
           // echo"Current reading could not checked";
             $existss=0;
              $val=$curmreading;
            
            }
            
            
            //############################## confirm this months reading #####################################
           
            $today=date("Y-m-d");
            
            //################## Prepare a list of accounts ############# 
             $sellist="SELECT autoid from property WHERE isactive=1 AND zone=$zone ORDER BY block,plot,connectionno";
              $qrylist=mysql_query($sellist);
              $listids=array();
              if($qrylist){
              
                while($list=mysql_fetch_array($qrylist)){
                  $id=$list['autoid'];
                  $listids[]=$id;
                
                }
                //
              }
              else{
              echo"Could not build a list of connections!";
              }
        if(sizeof($listids)!=0){
           
           $_SESSION['listofids']=$listids;
        }
              
            
            
            //####################### list of accounts ##################
        
           echo" <table width=100% border=0 cellpadding=1 cellspacing=0>";
       echo" <tr>";
       echo" <th colspan=4 align=left><b>Account Details<b> </th>";
       echo" </tr>";
        echo" <tr>";
         echo" <th colspan=4 align=left></th>";
         echo" </table>";
         
        echo" <div id=controls style='border : solid 3px #ccccff;background : #cccccc; font-size:8px;color : #000000; padding : 1px; width : 450px; height : 309px; overflow : auto;'>";
        echo" <table width=100% border=0 cellpadding=1 cellspacing=0 align=left>";
       
        
        echo" <tr><td colspan=4><form name=basicinfo>";
        echo" <table width=100% border=0 cellpadding=1 cellspacing=0 align=left>";
        echo" <tr>";
        echo" <td>Connection</td>";
        echo"<td><label>$connid</label></td>";
        echo" <td colspan=2>Account: $accountno</td>";
        //echo"<td><label>$accountno</label></td>";
        echo" </tr>";
        //"<td colspan=4>&nbsp;</td>";
        echo" <tr>";
        echo" <td>Account Name</td>";
        echo"<td><label>$custname</label></td>";
        echo"<td colspan=2>&nbsp;</td>";
        echo" </tr>";
        echo" <tr>";
        echo" <td>Address</td>";
        echo"<td><label>$address</label></td>";
        echo"<td colspan=2>&nbsp;</td>";
        echo" </tr>";
        echo" <tr><td colspan=6><hr size=2></td></tr>";
        /*echo" <tr>";
        echo" <td>Address</td>";
        echo"<td><textarea name=address id=address rows=1 cols=38 tabindex=3 style='background : #ffffcc; font-size:14px;color : #336699;'></textarea></td>";
        echo"<td colspan=2>&nbsp;</td>";
        echo" </tr>"; */
        //echo" <tr><td>&nbsp;<input type=hidden name=pid id=pid size=12 value=\"$propid\" tabindex=30><input type=hidden name=displ id=displ size=15 value=\"$tbl\" tabindex=30></td></tr>";
        echo" </tr>";
		
		echo" <tr>";
       
        echo" <td><input type=hidden name=pdate id=pdate size=12 value=\"$prevrdate\" tabindex=30></td>";
        echo" <td><input type=hidden name=preading id=preading size=12 value=\"$prevreaading\" tabindex=30></td>";
         echo"<td><input type=hidden name=accnumber id=accnumber size=12 value=\"$accountno\" tabindex=30></td>";
        echo"<td><input type=hidden name=recid id=recid size=12 value=\"$recid\" tabindex=30></td>";
        echo" </tr>";
		
        echo" <tr>";
		
       
        echo" <td>Previous Reading Date</td>";
        echo" <td>Previous Reading</td>";
         echo"<td>&nbsp;</td>";
        echo"<td>&nbsp;</td>";
        echo" </tr>";
        echo" <tr>";
        echo"<td><label>$prevrdate</label></td>";
        echo"<td><label>$prevreaading</label></td>";
         echo"<td>&nbsp;</td>";
        echo"<td>&nbsp;</td>";       
        echo" </tr>";
        echo" <tr><td colspan=4><hr size=2></td></tr>";
         echo" <tr>";
  
        echo" <td>Current Reading Date</td>";
        echo" <td>Current Reading</td>";
         echo"<td>&nbsp;</td>";
        echo"<td>&nbsp;</td>";
        echo" </tr>";
        echo" <tr>";
       
        echo"<td><input type=text name=curdate id=curdate size=10 tabindex=5 value=$today></td>";
        
         echo"<td><input type=text name=curreading id=curreading size=10 tabindex=5 value=\"$val\"></td>";
        
         echo"<td>&nbsp;</td>";
        echo"<td>&nbsp;</td>";       
        echo" </tr>";
        echo" <tr><td colspan=4><hr size=2></td></tr>";
        
         echo" <tr>";
        
        echo" <td>Billing Date</td>";
        echo"<td><input type=text name=bdate id=bdate size=10 tabindex=8 value=$curbdate></td>";
          echo"<td>&nbsp;</td>";
        echo"<td>&nbsp;</td>";
        echo" </tr>";
        echo" <tr><td>&nbsp;</td></tr>";
        
        echo" <tr>";
        
        echo"<td colspan=4 align=right><input type=button name=88 id=88 onfocus='reject(this.name);'  value=Edit-Reading tabindex=10>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";       
        
        
        echo" </tr>";
        echo" </table>";
        echo" </form></td></tr>";
        echo" </div>";
        }
        else{
         echo"The Account No. doesnt exist in the database.";
        }
    
   }
   else{
    echo"Could not fetch details for the account";
   
   }
              
                
            }
            else{
             echo"Invalid Account No.";
            
            }



}
///$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$


?>

<?php
include('db_connections/aardb_conn.php');
$part=$_GET['d'];

if(!is_numeric($part)){
 echo"Your request coulld not be processed";
 exit();
}
$part=mysql_real_escape_string($part);


if($part==1){
 property();

}
else if($part==2){ 
personalinfo();

}
else if($part==3){
meterinfo();
}
else if($part==4){
 deposit();       

}
else if($part==11){
 saveproperty();       

}
else if($part==22){
 savepersonalinfo();       

}
else if($part==33){
savemeterinfo();      

}
else if($part==44){
 savedeposit();       

}

 function scrutinize($data){
    
    $data=trim($data);
    $data=htmlspecialchars($data);
    $data = mysql_real_escape_string($data);
    $data = strip_tags($data);
    return $data;
    
    }
//######################### save property details ################
function saveproperty(){ 
 include('db_connections/aardb_conn.php');
$save=1;
           
           $block=$_GET["block"];  
           $plot=$_GET["plot"];  
           $connection=$_GET["connection"]; 
           $accountno=$_GET["accountno"]; 
           $zone=$_GET["zone"]; 
           $walk=$_GET["walk"]; 
           $street=$_GET["street"];  
           $estate=$_GET["estate"];  
           $sanitation=$_GET["sanitation"]; 
           
   
    $block=scrutinize($block);
    $plot=scrutinize($plot);
    $connection=scrutinize($connection);
    $accountno=scrutinize($accountno);
    $zone=scrutinize($zone);
    $walk=scrutinize($walk);
    $street=scrutinize($street);
    $estate=scrutinize($estate);
    $sanitation=scrutinize($sanitation);
    
            
      if($block==""){
		  echo"Block field is blank. Please fill it and continue";
		   $save=0;
		 } 
     else if(!is_numeric($block)){
		  echo"Only Numericals are accepted for the 'Block' field!";
		   $save=0;
		 }    
             
    else if($plot==""){
		  echo"Plot field is blank. Please fill it and continue";
		   $save=0;
		 }    
     else if(!is_numeric($plot)){
		  echo"Only Numericals are accepted for the 'Plot' field!";
		   $save=0;
		 }       
    else if($connection==""){
		  echo"Connection field is blank. Please fill it and continue";
		   $save=0;
		 } 
		  else if(!is_numeric($connection)){
		  echo"Only Numericals are accepted for the 'Connection' field!";
		   $save=0;
		 }
      else if($accountno==""){
		  echo"Account no field is blank. Please fill it and continue";
		   $save=0;
		 }    
      else if(!is_numeric($accountno)){
		  echo"Only Numericals are accepted for the 'Account' field!";
		   $save=0;
		 }        
     else if($street==""){
		  echo"Street field is blank. Please fill it and continue";
		   $save=0;
		 }
     else if($zone==0){
		  echo"Zone Missing";
		   $save=0;
		 }
     else if($walk==0){
		  echo"Walk Missing";
		   $save=0;
		 }    
             
      else if($estate==""){
		  echo"Estate field is blank. Please fill it and continue";
		   $save=0;
		 }    
             
      else if($sanitation==0){
		  echo"Sanitation field is blank. Please fill it and continue";
		   $save=0;
		 }    
             
   if($save==1){ 
					$transdate=date("Y-m-d");
			 
 $sql="INSERT INTO property(block,plot,connectionno,accountno,zone,walk,street,estate,sanitation)VALUES('".$block."','".$plot."','".$connection."','".$accountno."','".$zone."','".$walk."','".$street."','".$estate."','".$sanitation."');";
 if (!mysql_query($sql,$db_conn)){
					 echo"The record could not be saved.";
					}
				  else{
				  
				 $propertyid=mysql_insert_id();
				 $strin=$block."/".$plot."/".$connection."|".$propertyid."|".$accountno;
				  echo $strin;
				     }
				   mysql_close($db_conn);
			}	



}

//######################### save Basic information details ################
function savepersonalinfo(){ 
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
           $dispcustname=$custname;
           $custname=scrutinize($custname);
           $gender=scrutinize($gender);
           $address=scrutinize($address);
           $phone=scrutinize($phone);
           $email=scrutinize($email);
           $idno=scrutinize($idno);
           $pin=scrutinize($pin);
           $custclass=scrutinize($custclass);
          
            
    if($custname==""){
		  echo"Name field is blank. Please fill it and continue";
		   $save=0;
		 }              
    else if($gender==""){
		  echo"You have not selected Gender";
		   $save=0;
		 }    
   else if($address==""){
		  echo"Address field is blank. Please fill it and continue";
		   $save=0;
		 }    
   else if($phone==""){
		  echo"Phone field is blank. Please fill it and continue";
		   $save=0;
		 }              
   else if($email==""){
		  echo"Email field is blank. Please fill it and continue";
		   $save=0;
		 }    
   else if($custid==0){
		  echo"Please select Identification type(ID,PASSPORT,CI)";
		   $save=0;
		 }              
  else if($idno==""){
		  echo"Enter Identification Number and continue";
		   $save=0;
		 }    
  else if($pin==""){
		  echo"Pin field is blank. Please fill it and continue";
		   $save=0;
		 }    
  else if($custclass==""){
		  echo"Please select customer classification and continue";
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
          $msg=$displ."|".$dispcustname;
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
      
      $make=scrutinize($make);
      $serial=scrutinize($serial);
      $size=scrutinize($size);
      $acnno=scrutinize($acnno);
      
    if($make==0){
		  echo"Select Meter Make please";
		   $save=0;
		 }     
    else if($serial==""){
		  echo"Enter Meter Serial Number";
		   $save=0;
		 }    
    else if($size==0){
		  echo"Select Meter Size";
		   $save=0;
		 }    
             
   if($save==1){ 
					$transdate=date("Y-m-d");
				 
 $sql="INSERT INTO meter(make,serial,size,accountno)VALUES('".$make."','".$serial."','".$size."','".$acnno."');";
 if (!mysql_query($sql,$db_conn)){
					 echo"There was an error saving Meter Details!";
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
           
           $receipt=scrutinize($receipt);
           $amount=scrutinize($amount);
           $tdate=scrutinize($tdate);
           $connid=scrutinize($connid); 
      
    if($receipt==""){
		  echo"Receipt Number field is blank. Please fill it and continue";
		   $save=0;
		 }     
     else if($amount==""){
		  echo"Amount field is blank. Please fill it and continue";
		   $save=0;
		 }
     else if(!is_numeric($amount)){
		  echo"Wrong digits for Amount!";
		   $save=0;
		 }    
     else if($tdate==""){
		  echo"Transaction Date field is blank. Please fill it and continue";
		   $save=0;
		 }    
     else if($connid==""){
		  echo"Connection ID field is blank. Please fill it and continue";
		   $save=0;
		 }
      else if(!is_numeric($connid)){
		  echo"Wrong format for Connid!";
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
function property(){
echo" <table width=100% border=0 cellpadding=1 cellspacing=0>";
       echo" <tr>";
       echo" <th colspan=4 align=left><b>New Property Information<b> </th>";
       echo" </tr>";
        echo" <tr>";
         echo" <th colspan=4 align=left></th>";
         echo" </table>";
         
        echo" <div id=controls style='border : solid 3px #ccccff;background : #cccccc; font-size:14px;color : #000000; padding : 1px; width : 492px; height : 310px; overflow : auto;'>";
        echo" <table width=60% border=0 cellpadding=1 cellspacing=0 align=left>";
        echo" <tr><td>&nbsp;</td></tr>";
        echo" <tr><td width=100%><form name=newproperty>";
        echo" <table width=100% border=0 cellpadding=1 cellspacing=0 align=left>";
        echo" <tr>";
        echo" <td>Block</td>";
        echo"<td><input type=text name=block id=block size=10 tabindex=1></td>";
        echo" </tr>";
        echo" <tr>";
        echo" <td>Plot</td>";
        echo"<td><input type=text name=plot id=plot size=10 tabindex=2></td>";
        echo" </tr>";
        echo" <tr>";
        echo" <td>Connection</td>";
        echo"<td><input type=text name=connection id=connection size=10 tabindex=3></td>";
        echo" </tr>";
         echo" <td>Account</td>";
        echo"<td><input type=text name=accountno id=accountno size=10 tabindex=4></td>";
        echo" </tr>";
        echo" <tr><td>&nbsp;</td></tr>";
        echo" </tr>";
        
         echo" <tr>";
        echo" <td>Zone</td>";
        echo"<td>";
        echo"<select name=zone id=zone tabindex=5>";
        echo"<option value=0>Select</option>";
        echo"<option value=1>1</option>";
        echo"<option value=2>2</option>";
        echo"<option value=3>3</option>";
        echo"<option value=4>4</option>";
        echo"<option value=5>5</option>";
        echo"</select>";
        echo"</td>";
        echo" </tr>";
        
         echo" <tr>";
        echo" <td>Walk</td>";
        echo"<td>";
        echo"<select name=walk id=walk tabindex=6>";
        echo"<option value=0>Select</option>";
        echo"<option value=1>1</option>";
        echo"<option value=2>2</option>";
        echo"<option value=3>3</option>";
        echo"<option value=4>4</option>";
        echo"<option value=5>5</option>";
        echo"</select>";
        echo"</td>";
        echo" </tr>";
        echo" <tr><td>&nbsp;</td></tr>";
        echo" <tr>";
        echo" <td>Street</td>";
        echo"<td><input type=text name=street id=street size=30 tabindex=7></td>";
        echo" </tr>";
        echo" <tr>";
        echo" <td>Estate</td>";
        echo"<td><input type=text name=estate id=estate size=30 tabindex=8></td>";       
        echo" </tr>";
        
         echo" <tr>";
        echo" <td>Sanitation</td>";
        echo"<td>";
        echo"<select name=sanitation id=sanitation tabindex=9>";
        echo"<option value=0>Select Code</option>";
        echo"<option value=1>Sewer</option>";
        echo"<option value=2>Septic Tank</option>";
        echo"<option value=3>Pit Latrine</option>";
        echo"<option value=4>Other and None</option>";
        echo"</select>";
        echo"</td>";
        echo" </tr>"; 
        echo" <tr><td>&nbsp;</td></tr>";
        
        echo" <tr>";
        echo"<td colspan=2 align=center><input type=button name=11 id=11 onclick='rejectp(this.name);' value=Save-Property-Info tabindex=10>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";       
        echo" </tr>";
        echo" </table>";
        echo" </form></td></tr>";
        echo" </div>";

}

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
        echo"<td colspan=2 align=center><input type=button name=22 id=22 onclick='rejectp(this.name);'  value=Save-Basic-Info tabindex=10>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";       
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
             $custname=stripslashes($xplod[3]);
             $custname=str_replace("\\","",$custname);
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
        echo"<td colspan=2 align=center><input type=button name=33 id=33 onclick='rejectp(this.name);' value=Save-Meter-Info tabindex=7>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";       
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
             $custname=stripslashes($xplod[3]);
             $custname=str_replace("\\","",$custname);
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
        echo"<td colspan=2 align=center><input type=button name=44 id=44 onclick='rejectp(this.name);' value=Save-Deposit-Info tabindex=5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";       
        echo" </tr>";
        echo" </table>";
        echo" </form></td></tr>";
        echo" </div>";

}



?>

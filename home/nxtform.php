<?php
include('db_connections/aardb_conn.php');
require('bdates.php');
session_start();
//#######################################################################################

if(!empty($_GET['res']) && $_GET['res']!=0 && is_numeric($_GET['res'])){
             $account=trim($_GET['res']);
             $account=mysql_real_escape_string($account);
             $account=strip_tags($account);
             //########### fetch details###########
             $sql="SELECT property.autoid,block, plot,zone,walk, connectionno,street,estate,custname,address,idno,accountno from property inner join basicinfo  on property.custid=basicinfo.idno WHERE  property.autoid=$account";
             $qrydb=mysql_query($sql);
   if($qrydb){
   $numrows=mysql_num_rows($qrydb);
        if($numrows==1){
        
            $rws=mysql_fetch_array($qrydb);
            $recid=$rws['autoid'];
            $block=$rws['block'];
            $plot=$rws['plot'];
            $connectionno=$rws['connectionno'];
            $street=$rws['street'];
            $estate=$rws['estate'];
            $custname=$rws['custname'];
            $address=$rws['address'];
            $idno=$rws['idno'];
            $accountno=$rws['accountno'];
            $connid=$block."/".$plot."/".$connectionno;
            
             //################################# fetch dates #####################
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
         
        echo" <div id=controls style='border : solid 3px #ccccff;background : #cccccc; font-size:14px;color : #000000; padding : 1px; width : 742px; height : 325px; overflow : auto;'>";
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

//######################################################################################

?>

<?php
function createModalScripts(){											
$sql_available_tables="select  distinct tablename from admin_controller  order by tablename"; 
$results=mysql_query( $sql_available_tables);
$cntreg=mysql_num_rows($results);  
if ($cntreg>0){ 
$mydivs='$(function() {
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 300,
			width: 350,
			modal: true,
			buttons: {
				
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				//llFields.val( "" ).removeClass( "ui-state-error" );
			}
		});
';

while($count=mysql_fetch_array($results)){                                   
$table_name=$count[0]; 

$mydivs.='
$( "#'.$table_name.'" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});';
}
$mydivs.='});';

}

$modalscript='./template/functions/modalscripts.js';
//file_put_contents($modalscript,$mydivs);
}



function createDisplayGroupOptionScripts(){
$query_RcdAll_getbody="show tables";
$Rcd_tall_results=mysql_query($query_RcdAll_getbody);
$count_tballfound=mysql_num_rows($Rcd_tall_results);
$javascriptVarFunc='';

while($count_tballrows=mysql_fetch_array($Rcd_tall_results)){
$activetableBody=$count_tballrows[0];
$javascriptVarFunc.='
function savemenudisplyOptions'.$activetableBody.'(){
var '. $activetableBody.'1=document.getElementById('."'".$activetableBody."1')".';
'.$activetableBody.'1value="Hide";
if('.$activetableBody.'1.checked==true){
	'.$activetableBody.'1value="Show";
	}
var '. $activetableBody.'2=document.getElementById('."'".$activetableBody."2')".';
var '. $activetableBody.'3=document.getElementById('."'".$activetableBody."3')".';
var '. $activetableBody.'4=document.getElementById('."'".$activetableBody."4')".';
var xmlHttp;'.'
	try{	'.'
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari'.'
	}'.'
	catch (e){'.'
		try{'.'
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer'.'
		}'.'
		catch (e){'.'
		    try{'.'
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");'.'
			}'.'
			catch (e){'.'
				alert("No AJAX!?");'.'
				return false;'.'
			}'.'
		}'.'
	}'.'
xmlHttp.onreadystatechange=function(){'.
'  if(xmlHttp.readyState==4){
	document.getElementById('."'updatestatus'".').innerHTML=xmlHttp.responseText;'.'
		
	}'.'
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'."'&t='+'".$activetableBody."'".
"+'&".$activetableBody."1='+".$activetableBody.'1value
'."+'&".$activetableBody."2='+".$activetableBody.'2.value
'."+'&".$activetableBody."3='+".$activetableBody.'3.value
'."+'&".$activetableBody."4='+".$activetableBody.'4.value
'.',true);'.'
xmlHttp.send(null);'.'
}';

}
$jsdata='template/functions/menuDisplayGroups.js';
//file_put_contents($jsdata,$javascriptVarFunc);
}
///////
?>
<?PHP 
function displayDisplayGroups(){													
 $sql_available_rcds="SELECT distinct 
tablename,
displaygroup,
displaysubgroup,
showgroup
FROM admin_controller"; 
                                             
						$results=mysql_query( $sql_available_rcds);                                          
						$cntreg=mysql_num_rows($results);  
	$cntreg_count=$cntreg;
			if ($cntreg_count>0){
	
	 }		
if ($cntreg>0){ 
$num_found_contacts=$cntreg;
echo("<form name =\"frm$table_name\" action=\"\" method=\"post\"><tr><td class='Stable_td' colspan=\"4\">");
//echo("<hr>");
echo("<h3>$_SESSION[$table_name]</h3></p></td></tr>");
print( "<input type=\"hidden\"   name=\"num_found_controls\" value=\"$num_found_contacts\"> ");                        
echo("<table width='98%' class='Stable_table'> "); 
echo("<tr class='Stable_th'>");
print "<td colspan=\"5\"><hr></td >";
echo("<tr class='Stable_th'>"); 		     
print "<th align=left>Field Caption </td >";
print "<th align=left>List </td >";      
print "<th align=left>PDF</td >";     
print "<th align=left>Position</td >";
print "<th align=left>Width</td >";
echo("</tr>"); 
echo("<tr class='Stable_th'>");
print "<td colspan=\"5\"><hr></td >";
echo("</tr>");
          
			$rec_count=0;
			$emp_count=0;  
			$tablenameFolder=explode('_',$table_name);        
			while($count_ctrls=mysql_fetch_array($results)){ 
			$emp_count++;                                  
			 $controller_id=$count_ctrls['controller_id'];
	          $tablename=$count_ctrls['tablename']; 
			  $table_caption=$count_ctrls['tablecaption'];
			  $table_field=$count_ctrls['fieldname'];
			  $table_col_caption=$count_ctrls['fieldcaption'];
			  $table_col_viewdetails=$count_ctrls['detailsvisiblepdf'];
              $table_col_viewonpdf=$count_ctrls['pdfvisible'];
			  $table_col_positionb=$count_ctrls['position'];
	          $table_col_colnwidth=$count_ctrls['colnwidth'];
	//ended		            	
if(isset($emp_count)){
$even_row=$emp_count%2;
}

if($table_col_viewonpdf=='Show'){
$pdfdiso='checked';
$pdfdisVal="Show";
}
if($table_col_viewdetails=='Show'){
$listdiso='checked';
$listdisVal="Show";
}

if($even_row<=0){

print ("<tr class='Stable_even_row'>");
}
if($even_row>0){
	print "<tr class='Stable_non_even_row'>";
	}
	//$listdiso $pdfdiso


echo"
</td><td class='Stable_td'>			  
<input type=\"hidden\"    size=\"30\" name=\"ctrlerfound$rec_count\" value=\"$controller_id\">		  
<input type=\"text\"    size=\"20\" name=\"$table_field"."1\" id=\"$table_name$table_field"."1\" value=\"$table_col_caption\">
</td>
<td class='Stable_td'>			  
<input type=\"checkbox\"  $listdiso size=\"20\" name=\"details$rec_count\" id=\"$table_name$table_field"."2\" value=\"Show\">
</td>
<td class='Stable_td'> 
<input type=\"checkbox\"  $pdfdiso  size=\"20\" id=\"$table_name$table_field"."3\" name=\"pdf$rec_count\" value=\"Show\">
</td>  
<td class='Stable_td'>
<input type=\"text\"    size=\"3\" id=\"$table_name$table_field"."4\" name=\"position$rec_count\" value=\"$table_col_positionb\"> 
</td>
<td class='Stable_td'>
<input type=\"text\"    size=\"4\" id=\"$table_name$table_field"."5\" name=\"colnwidth$rec_count\" value=\"$table_col_colnwidth\"> 
</td>";
print"</tr>";
$rec_count++; 
$listdiso='';
$pdfdiso='';

}
print"<tr><td colspan=\"5\"><p class=\"date\"></p></td></tr>";
print"<tr><td>Section Title</td><td colspan=\"4\"><input type=\"text\"    size=\"40\" id=\"$tablename"."\" name=\"$tablename\" value=\"".$_SESSION[$tablename]."\"></td></tr>";
print "<td colspan=\"5\"><p class=\"date\"></td >";
echo("</tr>");
echo("<tr> <td><input type=\"button\" class=\"savebutton\"    size=\"20\" name=\"ctrupdate$table_name\" value=\"Save\"  onclick=\"savedisplyOptions$tablename('".$tablename."','".$tablenameFolder[0]."')\">");
print"</td><tr><td>";
print" </td></tr>";
print" <tr><td><td>";
echo("</table>");



}

echo("</form>");		
}

?>
<?php
function createAjaxOptionsScripts(){

$query_RcdAll_getbody="show tables";
$Rcd_tall_results=mysql_query($query_RcdAll_getbody);
$count_tballfound=mysql_num_rows($Rcd_tall_results);
while($count_tballrows=mysql_fetch_array($Rcd_tall_results)){
$activetableBody=$count_tballrows[0];

$query_Rcd_getbody= "SELECT distinct tablename,fieldname FROM admin_controller where ucase(tablename)='$activetableBody'";
//echo $query_Rcd_getmenus;
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
$countrows=0;
$postdatainsert="''";
$count_tbrowsfound=mysql_num_rows($Rcd_tbody_results);


while($count_tbrows=mysql_fetch_array($Rcd_tbody_results)){
$countrows++;
$postdatainsert.=$count_tbrows['fieldname'];
echo 'working '.$postdatainsert;


if($countrows==1){

$postdata="'&".$count_tbrows['fieldname']."1='+".$count_tbrows['fieldname'].'1.value
';
$postdata.="+'&".$count_tbrows['fieldname']."2='+".$count_tbrows['fieldname'].'2value

';
$postdata.="+'&".$count_tbrows['fieldname']."3='+".$count_tbrows['fieldname'].'3value

';
$postdata.="+'&".$count_tbrows['fieldname']."4='+".$count_tbrows['fieldname'].'4.value
';
$postdata.="+'&".$count_tbrows['fieldname']."5='+".$count_tbrows['fieldname'].'5.value
';

$javascriptVarFunc='
function savedisplyOptions'.$activetableBody.'(activetable,msg){

var activetableVal=document.getElementById(activetable).value;
var statementcpn=document.getElementById(\'statementcpn\'+activetable).value;

';

$javascriptVarbody='
var xmlHttp;'.'
	try{	'.'
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari'.'
	}'.'
	catch (e){'.'
		try{'.'
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer'.'
		}'.'
		catch (e){'.'
		    try{'.'
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");'.'
			}'.'
			catch (e){'.'
				alert("No AJAX!?");'.'
				return false;'.'
			}'.'
		}'.'
	}'.'

xmlHttp.onreadystatechange=function(){'.
'
	if(xmlHttp.readyState==4){
	';
$javascriptVarind.='
var '. $count_tbrows['fieldname'].'1=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."1')".';
var '. $count_tbrows['fieldname'].'2=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."2')".';
'.$count_tbrows['fieldname'].'2value="Hide";
if('.$count_tbrows['fieldname'].'2.checked==true){
	'.$count_tbrows['fieldname'].'2value="Show";
	}
var '. $count_tbrows['fieldname'].'3=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."3')".';
'.$count_tbrows['fieldname'].'3value="Hide";
if('.$count_tbrows['fieldname'].'3.checked==true){
	'.$count_tbrows['fieldname'].'3value="Show";
	}
var '. $count_tbrows['fieldname'].'4=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."4')".';
var '. $count_tbrows['fieldname'].'5=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."5')".';
';
}else{
/*$postdata.="+'&".$count_tbrows['fieldname']."='+".$count_tbrows['fieldname'].'.value';
*/

$postdata.="+'&".$count_tbrows['fieldname']."1='+".$count_tbrows['fieldname'].'1.value
';
$postdata.="+'&".$count_tbrows['fieldname']."2='+".$count_tbrows['fieldname'].'2value

';
$postdata.="+'&".$count_tbrows['fieldname']."3='+".$count_tbrows['fieldname'].'3value
';
$postdata.="+'&".$count_tbrows['fieldname']."4='+".$count_tbrows['fieldname'].'4.value
';
$postdata.="+'&".$count_tbrows['fieldname']."5='+".$count_tbrows['fieldname'].'5.value
';
$postdata.="+'&".$count_tbrows['fieldname']."6='+".$count_tbrows['fieldname'].'6value
';
$postdata.="+'&".$count_tbrows['fieldname']."7='+".$count_tbrows['fieldname'].'7.value
';
$isid=explode('_',$count_tbrows['fieldname']);
/*if($isid[1]=='id'){
$javascriptVarind2.='
var '. $count_tbrows['fieldname'].'=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."_fkhidden')".';';
}
else{*/
$javascriptVarind2.='
var '. $count_tbrows['fieldname'].'1=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."1')".';
var '. $count_tbrows['fieldname'].'2=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."2')".';
'.$count_tbrows['fieldname'].'2value="Hide";
if('.$count_tbrows['fieldname'].'2.checked==true){
	'.$count_tbrows['fieldname'].'2value="Show";
	}
var '. $count_tbrows['fieldname'].'3=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."3')".';
'.$count_tbrows['fieldname'].'3value="Hide";
if('.$count_tbrows['fieldname'].'3.checked==true){
	'.$count_tbrows['fieldname'].'3value="Show";
	}
	
var '. $count_tbrows['fieldname'].'4=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."4')".';
var '. $count_tbrows['fieldname'].'5=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."5')".';
var '. $count_tbrows['fieldname'].'6=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."6')".';
'.$count_tbrows['fieldname'].'6value="Hide";
if('.$count_tbrows['fieldname'].'6.checked==true){
	'.$count_tbrows['fieldname'].'6value="Show";
	}
var '. $count_tbrows['fieldname'].'7=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."7')".';
';

}


if($countrows==$count_tbrowsfound){
$folderloc=explode('_',$activetableBody);
$javascriptVar.=$javascriptVarFunc.$javascriptVarind.$javascriptVarind2.$javascriptVarbody;
$javascriptVarind='';
$javascriptVarind2='';
$javascriptVarbody='';
$javascriptVar.='
'.'
	
		document.getElementById('."msg".').innerHTML=xmlHttp.responseText;'.'
		
	}'.'
}

'.'

xmlHttp.open("GET","http://localhost/formgen/home/saveOptions.php?t="+'."activetable"."+'&activetableValue='+activetableVal+"."'&statementcpn='+statementcpn+".$postdata.',true);'.'
xmlHttp.send(null);'.'
}'.'

'.'


'.'
';

}

}
//$javascriptVar.=$javascriptVar;
}//end of while for all tables
$jsdata='template/functions/currentOptions.js';
//file_put_contents($jsdata,$javascriptVar);
$javascriptVar='';
}
///////
?>
<?php
function createAjaxOptionsScripts_old(){

$query_RcdAll_getbody="show tables";
$Rcd_tall_results=mysql_query($query_RcdAll_getbody);
$count_tballfound=mysql_num_rows($Rcd_tall_results);
while($count_tballrows=mysql_fetch_array($Rcd_tall_results)){
$activetableBody=$count_tballrows[0];

$query_Rcd_getbody= "SELECT distinct tablename,fieldname,fieldcaption,fieldcaption,dataformat,dispaytype,
required,control_position,control_position FROM admin_controller where ucase(tablename)='$activetableBody'";
//echo $query_Rcd_getmenus;
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
$countrows=0;
$postdatainsert="''";
$count_tbrowsfound=mysql_num_rows($Rcd_tbody_results);


while($count_tbrows=mysql_fetch_array($Rcd_tbody_results)){
$countrows++;
$postdatainsert.=$count_tbrows['fieldname'];
echo 'working '.$postdatainsert;


if($countrows==1){

$postdata="'&".$count_tbrows['fieldname']."1='+".$count_tbrows['fieldname'].'1.value
';
$postdata.="+'&".$count_tbrows['fieldname']."2='+".$count_tbrows['fieldname'].'2value

';
$postdata.="+'&".$count_tbrows['fieldname']."3='+".$count_tbrows['fieldname'].'3value

';
$postdata.="+'&".$count_tbrows['fieldname']."4='+".$count_tbrows['fieldname'].'4.value
';
$postdata.="+'&".$count_tbrows['fieldname']."5='+".$count_tbrows['fieldname'].'5.value
';
$postdata.="+'&statementcpn".$activetableBody."='+statementcpn".$activetableBody.'
';

$javascriptVarFunc='
function savedisplyOptions'.$activetableBody.'(activetable,msg){

var activetableVal=document.getElementById(activetable).value;
';

$javascriptVarbody='
var xmlHttp;'.'
	try{	'.'
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari'.'
	}'.'
	catch (e){'.'
		try{'.'
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer'.'
		}'.'
		catch (e){'.'
		    try{'.'
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");'.'
			}'.'
			catch (e){'.'
				alert("No AJAX!?");'.'
				return false;'.'
			}'.'
		}'.'
	}'.'

xmlHttp.onreadystatechange=function(){'.
'
	if(xmlHttp.readyState==4){
	';
$javascriptVarind.='
var '. $count_tbrows['fieldname'].'1=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."1')".';
var '. $count_tbrows['fieldname'].'2=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."2')".';
'.$count_tbrows['fieldname'].'2value="Hide";
if('.$count_tbrows['fieldname'].'2.checked==true){
	'.$count_tbrows['fieldname'].'2value="Show";
	}
var '. $count_tbrows['fieldname'].'3=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."3')".';
'.$count_tbrows['fieldname'].'3value="Hide";
if('.$count_tbrows['fieldname'].'3.checked==true){
	'.$count_tbrows['fieldname'].'3value="Show";
	}
var '. $count_tbrows['fieldname'].'4=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."4')".';
var '. $count_tbrows['fieldname'].'5=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."5')".';
';
}else{
$postdata.="+'&".$count_tbrows['fieldname']."='+".$count_tbrows['fieldname'].'.value';


$postdata.="+'&".$count_tbrows['fieldname']."1='+".$count_tbrows['fieldname'].'1.value
';
$postdata.="+'&".$count_tbrows['fieldname']."2='+".$count_tbrows['fieldname'].'2value

';
$postdata.="+'&".$count_tbrows['fieldname']."3='+".$count_tbrows['fieldname'].'3value
';
$postdata.="+'&".$count_tbrows['fieldname']."4='+".$count_tbrows['fieldname'].'4.value
';
$postdata.="+'&".$count_tbrows['fieldname']."5='+".$count_tbrows['fieldname'].'5.value
';
$postdata.="+'&".$count_tbrows['fieldname']."6='+".$count_tbrows['fieldname'].'6value
';
$postdata.="+'&".$count_tbrows['fieldname']."7='+".$count_tbrows['fieldname'].'7.value

';
$postdata.="+'&statementcpn".$activetableBody."='+statementcpn".$activetableBody.'

';
$isid=explode('_',$count_tbrows['fieldname']);
/*if($isid[1]=='id'){
$javascriptVarind2.='
var '. $count_tbrows['fieldname'].'=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."_fkhidden')".';';
}
else{*/
$javascriptVarind2.='
var '. $count_tbrows['fieldname'].'1=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."1')".';
var '. $count_tbrows['fieldname'].'2=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."2')".';
'.$count_tbrows['fieldname'].'2value="Hide";
if('.$count_tbrows['fieldname'].'2.checked==true){
	'.$count_tbrows['fieldname'].'2value="Show";
	}
var '. $count_tbrows['fieldname'].'3=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."3')".';
'.$count_tbrows['fieldname'].'3value="Hide";
if('.$count_tbrows['fieldname'].'3.checked==true){
	'.$count_tbrows['fieldname'].'3value="Show";
	}
	
var '. $count_tbrows['fieldname'].'4=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."4')".';
var '. $count_tbrows['fieldname'].'5=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."5')".';
var '. $count_tbrows['fieldname'].'6=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."6')".';
'.$count_tbrows['fieldname'].'6value="Hide";
if('.$count_tbrows['fieldname'].'6.checked==true){
	'.$count_tbrows['fieldname'].'6value="Show";
	}
var '. $count_tbrows['fieldname'].'7=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."7')".';
var statementcpn'. $activetableBody.'=document.getElementById('."'statementcpn".$activetableBody."').value".';

';

}


if($countrows==$count_tbrowsfound){
$folderloc=explode('_',$activetableBody);
$javascriptVar.=$javascriptVarFunc.$javascriptVarind.$javascriptVarind2.$javascriptVarbody;
$javascriptVarind='';
$javascriptVarind2='';
$javascriptVarbody='';
$javascriptVar.='
'.'
	
		document.getElementById('."msg".').innerHTML=xmlHttp.responseText;'.'
		
	}'.'
}

'.'

xmlHttp.open("GET","http://localhost/formgen/home/saveOptions.php?t="+'."activetable"."+'&activetableValue='+activetableVal+".$postdata.',true);'.'
xmlHttp.send(null);'.'
}'.'

'.'


'.'
';

}

}
//$javascriptVar.=$javascriptVar;
}//end of while for all tables
$jsdata='template/functions/currentOptions.js';
//file_put_contents($jsdata,$javascriptVar);
$javascriptVar='';
}
///////
?><?php
function createAjaxInsterScripts(){
$query_RcdAll_getbody="show tables";
$Rcd_tall_results=mysql_query($query_RcdAll_getbody);
$count_tballfound=mysql_num_rows($Rcd_tall_results);
while($count_tballrows=mysql_fetch_array($Rcd_tall_results)){
$activetableBody=$count_tballrows[0];


$query_Rcd_getbody= "SELECT distinct tablename,fieldname,fieldcaption,fieldcaption,dataformat,dispaytype,
required,control_position,caption_position , isautoincrement FROM admin_controller where ucase(tablename)='$activetableBody'";

$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
$countrows=0;
$postdatainsert="''";
$count_tbrowsfound=mysql_num_rows($Rcd_tbody_results);


while($count_tbrows=mysql_fetch_array($Rcd_tbody_results)){
$countrows++;
$postdatainsert.=$count_tbrows['fieldname'];
$isautoincrement=$count_tbrows['isautoincrement'];
$formName='frm_body'.$count_tbrows['fieldname'].'_fkhidden';
$controlName=$activetableBody.$count_tbrows['fieldname'];

if($countrows==1){
$postdata="'&".$count_tbrows['fieldname']."='+".$count_tbrows['fieldname'].'.value';

$javascriptVarFunc='
function save'.$activetableBody.'DetailsInfo(activetable,recordid,actionitem,paresdisplaytype,msg,tgroup){
';

$javascriptVarbody='
var xmlHttp;'.'
	try{	'.'
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari'.'
	}'.'
	catch (e){'.'
		try{'.'
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer'.'
		}'.'
		catch (e){'.'
		    try{'.'
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");'.'
			}'.'
			catch (e){'.'
				alert("No AJAX!?");'.'
				return false;'.'
			}'.'
		}'.'
	}'.'

xmlHttp.onreadystatechange=function(){'.
'
if(xmlHttp.readyState==4){
';
$javascriptVarind.='
if(paresdisplaytype.indexOf("'.$count_tbrows['fieldname'].'") != -1){
numofradios = document.'.$formName.'.'.$controlName.'_fkhidden.length;
	      for (y =0 ;y<numofradios;y++){
			if (document.'.$formName.'.'.$controlName.'_fkhidden[y].checked==true) {
			  '.$count_tbrows['fieldname'].'value= document.'.$formName.'.'.$controlName.'_fkhidden[y].value;
			}       
		  }
}else{
var '. $count_tbrows['fieldname'].'=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."')".';
'.$count_tbrows['fieldname'].'value='.$count_tbrows['fieldname'].'.value;
}';


}else{
$postdata.="+'&".$count_tbrows['fieldname']."='+".$count_tbrows['fieldname'].'value';
$isid=explode('_',$count_tbrows['fieldname']);

if(($isid[1]=='id')&&(!$isautoincrement)){


$javascriptVarind2.='
var '. $count_tbrows['fieldname'].'=document.getElementById('."'".$controlName."_fkhidden')".';
'.$count_tbrows['fieldname'].'value='.$count_tbrows['fieldname'].'.value;
if(paresdisplaytype.indexOf("'.$count_tbrows['fieldname'].'") != -1){
numofradios = document.'.$formName.'.'.$controlName.'_fkhidden.length;
	      for (y =0 ;y<numofradios;y++){
			if (document.'.$formName.'.'.$controlName.'_fkhidden[y].checked==true) {
			  '.$count_tbrows['fieldname'].'value= document.'.$formName.'.'.$controlName.'_fkhidden[y].value;
			}       
		  }
}else{

}';

}
else{$javascriptVarind2.='
if(paresdisplaytype.indexOf("'.$count_tbrows['fieldname'].'") != -1){
numofradios = document.'.$formName.'.'.$controlName.'_fkhidden.length;
	      for (y =0 ;y<numofradios;y++){
			if (document.'.$formName.'.'.$controlName.'_fkhidden[y].checked==true) {
			  '.$count_tbrows['fieldname'].'value= document.'.$formName.'.'.$controlName.'_fkhidden[y].value;
			}       
		  }
}else{
var '. $count_tbrows['fieldname'].'=document.getElementById('."'".$activetableBody.$count_tbrows['fieldname']."')".';
'.$count_tbrows['fieldname'].'value='.$count_tbrows['fieldname'].'.value;
}';
}

}

$isautoincrement='';






if($countrows==$count_tbrowsfound){
$folderloc=explode('_',$activetableBody);

$javascriptVar.=$javascriptVarFunc.$javascriptVarind.$javascriptVarind2.$javascriptVarbody;
$javascriptVarind='';
$javascriptVarind2='';
$javascriptVarbody='';
$javascriptVar.='
'.'
	
		statusDisplay(xmlHttp,activetable,tgroup);'.'
		
	}'.'
}

'.'

xmlHttp.open("GET","http://localhost/formgen/home/bodysave.php?t="+'."activetable"."+'&act='+actionitem".'+'."'&q='+recordid"."+".$postdata.',true);'.'
xmlHttp.send(null);'.'
}'.'

'.'


'.'
';

}

}
$jsdata='template/functions/currentinsertjs.js';
}//end of the while for show tables
$insertJS=' function statusDisplay(xmlHttp,activetable,tgroup) {
          if (xmlHttp.status == 200) {
					var response=xmlHttp.responseText;	
						if(response!="Saved Successfully"){
						document.getElementById(\'updateclient\'+activetable).innerHTML=response;
						}
						else{
						
						document.getElementById(\'updateclient\'+activetable).innerHTML=\'Saved Successfully\';
						loadTableInfo(activetable,\'NOID\',\'Save\',tgroup);
						}			
						
					
											
					} else {
						alert("There was a problem while using XMLHTTP:\n" + xmlHttp.statusText);
					}
}'  ;
//file_put_contents($jsdata,$insertJS.$javascriptVar);
}
///////
?>
<?php

function createTableDisplayCaptions(){
$sqltbcols="Show tables";   
			$results_tbc=mysql_query($sqltbcols);
	        $cnt_cols=mysql_num_rows($results_tbc); 
			$positioncnt=0;

			while($count_cls=mysql_fetch_array($results_tbc)){
			  $table_name=$count_cls[0]; 
			  $table_namearr=explode('_',$table_name);
               $table_caption='';
			  foreach($table_namearr as $item){
			  $table_caption.=' '.$item;
			  
			  }
			  $table_namearr='';
			  
			  
/*$results_tbcaptions=mysql_query("insert into admin_table values('','$table_name','$table_caption')");
$table_caption='';*/



///

$sqladminTable="Select * from admin_table where table_name='$table_name'";  

			$results_adminctrlsTble=mysql_query($sqladminTable);
	        $cnt_colsATable=mysql_num_rows($results_adminctrlsTble); 
			if($cnt_colsATable>0){
			//donothing
			//exit;
			
			}else{
			$flexcolumn=1;
			$gridwidth=600;
			$gridhieght=350;
			$table_id='';
			$uuid=gen_uuid();
			$created_by=$_SESSION['my_useridloggened'];
			$date_created=date('d-m-Y');
			$formheight=0;
			
			$adminSQL="insert into 
admin_table(table_id,
table_name,table_caption,
statement_caption,flexcolumn,
gridwidth,gridhieght,formheight,orderpos,created_by,date_created,changed_by,date_changed,voided,voided_by,date_voided,uuid) 

values('$table_id',
'$table_name','$table_caption',
'$table_caption','$flexcolumn',
'$gridwidth','$gridhieght','$formheight','$orderpos','$created_by','$date_created','$changed_by','$date_changed','$voided','$voided_by','$date_voided','$uuid')";

echo $adminSQL;

$results_tbcaptions=mysql_query($adminSQL);
$table_caption='';
			}
////
	         }
	}
	
	//table_id


?>
<?php
/*function buildlangTopMenuLinksDetails(){	
	$mytabs=0;										
    $sql_available_tables="show tables"; 
    $results=mysql_query( $sql_available_tables);
	$cntreg=mysql_num_rows($results);  

if ($cntreg>0){ 
                        
            while($count=mysql_fetch_array($results)){                                   
			$table_name=$count[0]; 
			$foldnamelinks=explode('_',$table_name);
			
	$sql_getdefaultTableSQL="select defaultgrouptable  from admin_controller where tablename='$table_name' limit 1"; 
	echo $sql_getdefaultTableSQL.'<br>';
    $resultsDefaultTble=mysql_query( $sql_getdefaultTableSQL);
	$cntregDefaultTbl=mysql_num_rows($resultsDefaultTble);
			if($cntregDefaultTbl){
			$countDefaulttbl=mysql_fetch_array($resultsDefaultTble);
			$defaulttable_name=$countDefaulttbl[0];
			}
			
			$foldnamelinkTo=$foldnamelinks[0];
			
				if($foldnamelinkTo==$prevfoloder){
				  $i++;
				  
				  } 
				  else  {
				   $mytabs++;	
				  if($table_name=="admin_controller"){
				$mytabs=1;
				$detailsTopMenu.='
				'."<li><a href=\"#tabs-1"."\" onclick=\"loadActiveMenuDetails('".'admin'."')\""." >".'Admin'."</a></li>";
				$tabsguidea='<div id="tabs-1"><div id="saveadmin"></div><div id="'.$_SESSION['tablegroupadmin_controller'].'"></div></div>
';
				 }else{	
						 
$active_tbl_php=$table_name;
echo("<li><a href=\"#tabs-$mytabs"."\" onclick=\"loadActiveMenuDetails('".$active_tbl_php."')\""." >");

echo($foldnamelinkTo);
echo("</a></li>");
$detailsTopMenu.='
'."<li><a href=\"#tabs-$mytabs"."\" onclick=\"loadActiveMenuDetails('".$_SESSION['tablegroup'.$active_tbl_php]."');loadTableInfo('".$defaulttable_name."','NOID','Save','".$_SESSION['tablegroup'.$active_tbl_php]."')\""." >".$_SESSION['tablegroup'.$active_tbl_php]."</a></li>";

$tabsguide.= '
<div id="tabs-'.$mytabs.'"><div id="save'.$_SESSION['tablegroup'.$active_tbl_php].'"></div><div id="'.$_SESSION['tablegroup'.$active_tbl_php].'">'.'</div></div>';
				 }
				 }
                $prevfoloder=$foldnamelinkTo; 
		
               }
			 }
	
$r=$mytabs+1;	
$a=$mytabs+2;
$h=$mytabs+3; 
$otherdivs='
<div id="tabs-'.$r.'"><div id="savereport"></div><div id="report"></div></div>
<div id="tabs-'.$a.'"><div id="saveanalysis"></div><div id="analysis"></div></div>
<div id="tabs-'.$h.'"><div id="savehelp"><div id="help"></div></div>';
$systab='./template/functions/hometabs.php';
$otherdetails='<li><a href="#tabs-'.$r.'">Reports</a></li>
<li><a href="#tabs-'.$a.'" >Analysis</a></li>
<li><a href="#tabs-'.$h.'" >Help</a></li>
</ul>';
file_put_contents($systab,$tabsguidea.$tabsguide.$otherdivs);

	
$sysfunc='./template/functions/topMenu.php';
file_put_contents($sysfunc,'<ul>  
'.$detailsTopMenu.$otherdetails);

} //end func select tables */

?>
<?php
function getTablesFormPrimaryKeys(){													
    $sql_available_tables="show tables"; 
    $results=mysql_query( $sql_available_tables);
	$cntreg=mysql_num_rows($results);  

if ($cntreg>0){ 
                        
            while($count=mysql_fetch_array($results)){                                   
			$table_name=$count[0]; 
			$foldnamelinks=explode('_',$table_name);
			$foldnamelinkTo=$foldnamelinks[0];
			$primary_keyitem=$foldnamelinks[1].'_id';
		     $prevfoloder=$foldnamelinkTo; 
			$sqltbcols="Show columns from $table_name";   
			$results_tbc=mysql_query($sqltbcols);
	        $cnt_cols=mysql_num_rows($results_tbc); 
			
			
			while($count_cls=mysql_fetch_array($results_tbc)){
			   $table_col_Name=$count_cls['Field']; 
			   $isprimarytblskarr=explode('_',$table_col_Name);
               $primarydeterminant=$isprimarytblskarr[1];
				  if($primarydeterminant=='name'){
					   $primarytablefoundhere= $table_name;
					  }
			} //end while columns
			 $primarykeydescriptionstr.= $primarytablefoundhere.'    ';
			} //end while tbls
			
       } //end if for tables
      return $primarykeydescriptionstr;
    } //end func function create pri tables 

?>
<?php
function buildSearchFunctions(){ 
$DescriptiveTables=getTablesFormPrimaryKeys();

$sql_available_tables="show tables"; 
$results=mysql_query( $sql_available_tables);
$cntreg=mysql_num_rows($results);  
if ($cntreg>0){ 
	$firstitem='';        
	  while($count=mysql_fetch_array($results)){                                   
		$table_name=$count[0]; 
		$sqlshowcolumns="Show columns from $table_name";   
		$results_showcolumns=mysql_query($sqlshowcolumns);
		$cnt_foundcolumns=mysql_num_rows($results_showcolumns);
		
		if($cnt_foundcolumns>0){
		    $countnumberofcolmns=0;
			$firstSearch='';
			$separor='';
			while($count_colmn=mysql_fetch_array($results_showcolumns)){
				$countnumberofcolmns++;
				$tableFieldRetrievedValueOr=$count_colmn['Field'];
			    $columnArray=explode('_',$tableFieldRetrievedValueOr);
				
				foreach  ($columnArray as $tem){
				//echo 'xxxxxxxxxx='.$columnArray[1].'xxxxxxxx<br>';
				}
				$columnpart=explode('_',$columnArray[1]);
		        $checksecondpart=$columnArray[1];
				//echo $tableFieldRetrievedValueOr.'M<br>'.$tableFieldRetrievedValueOr.'kkkkk<br>';

////////////////////////////COMPLETED
if($countnumberofcolmns==$cnt_foundcolumns){$separor='';}  else { $separor=' , ';}//Cif

if($firstSearch==''){ $table_primary_key=$count_colmn[0];
$isforeignff_descr='Select '.$table_name.'.'.$count_colmn[0].$separor; $firstSearch='processed';
$primaryidcolumn=1; } //Cif
///////////////////////////COMPLETED

      if(( $checksecondpart=='id')&&($primaryidcolumn=1)){
	 
			        $table_foreign_key=$count_colmn[0];
				    $activeTable=trim($_SESSION["$tableFieldRetrievedValueOr"]);
					//echo"$DescriptiveTables <br><br><br><br>,$activeTable";
				    $fkdetermine=strpos($DescriptiveTables,$activeTable);
				if($fkdetermine){
					$columnaff=explode('_',$table_foreign_key);
				    $isforeigkey_name=$columnArray[0].'_name';
					$isforeigkey_id=$columnArray[0].'_id';
					
					$withforeignkeydesc.=$_SESSION[$table_foreign_key.'_id_search'].'.'.$isforeigkey_name.$separor;
					echo '<br>'.$withforeignkeydesc;
				
					   if($_SESSION[$table_foreign_key.'_id_search']!=$table_name){
					   //echo $table_foreign_key.'=ppspspspspsps='.$table_name;
						$DynamicSQLcondition.="  inner join 
						".$_SESSION[$table_foreign_key].
						" on "
						.$_SESSION[$table_primary_key].'.'.$table_foreign_key.' = '
						.$_SESSION[$table_foreign_key].'.'.$table_foreign_key;}//foreignkey
						
						}//end of determine if
				
			     else{
				    if($primaryidcolumn==2){
				    $withforeignkeydesc.=$table_name.'.'.$count_colmn[0].$separor;
					}
				  }
				 
				 }
				 
				 elseif($checksecondpart=='name'){
				
				 $withforeignkeydesc.=$table_name.'.'.$count_colmn[0].$separor;
				 }
				 else{
				 
				 $withforeignkeydesc.=$table_name.'.'.$count_colmn[0].$separor;
				 
				 }//end of checking ID
				  $primaryidcolumn=2;
			  }//end while columns were FOUND
			  $correctfrom='  from';
              $DynamicSQLWHEREcondition="<br>";
			$cmbsearch.= '
			
			$_SESSION["'.$table_name.'_SearchSQL"]="'.$isforeignff_descr.' '.$withforeignkeydesc.' from '.$table_name.'  '. $DynamicSQLcondition.'";
			
			';
			
			   $isforeignff_descr='';
			   $DynamicSQLcondition='';	
			   $DynamicSQLWHEREcondition=''; 
			   $withforeignkeydesc=''; 
			   $checksecondpart='';
	 }//end of while for selecting all tables
  }//end of if for tables

$sysfunc='./template/functions/searchSQL.php';
//file_put_contents($sysfunc,'<?php'.$cmbsearch.'?>');
}//end func if create SQL
return $cmbsearch;
}
?>
<?php
function buildSearchFunctionsV2(){ 
$DescriptiveTables=getTablesFormPrimaryKeys();

$sql_available_tables="show tables"; 
$results=mysql_query( $sql_available_tables);
$cntreg=mysql_num_rows($results);  
	$firstitem='';        
	  while($count=mysql_fetch_array($results)){                                   
		$table_name=$count[0]; 
		$DynamicSQLcondition='';
		$vars='';
		//$Sqlstatement='';
		$countnumberofcolmns=0;
		$cnt_foundcolumns=0;
		//$Sqlstatementfinal='';
		
		$sqlshowcolumns="Show columns from $table_name";  
		
		$results_showcolumns=mysql_query($sqlshowcolumns);
		$cnt_foundcolumns=mysql_num_rows($results_showcolumns);
		$countrows=0;
	while($count_colmn=mysql_fetch_array($results_showcolumns)){
		$countrows++;
		if($cnt_foundcolumns==$countrows){$sep='';}else{$sep=' , ';}
		$fks='';
		$tableFieldRetrievedValue=$count_colmn['Field'];
		$columnArray=explode('_',$count_colmn['Field']);				
		
		
				if(($columnArray[1]=='id')&&($countrows>1)){
				
			    $revisedcolId=$columnArray[0].'_id';
				$revisedcolName=$columnArray[0].'_name';
				$fks.=$_SESSION[$tableFieldRetrievedValue].'.'.$tableFieldRetrievedValue.$sep.$_SESSION[$tableFieldRetrievedValue].'.'.$revisedcolName.$sep;
				
				}	
				
				if(($fks)&&($_SESSION[$columnArray[0].'_id_search']!=$table_name)){
					
						$vars.=$fks.$sep;
						$DynamicSQLcondition.="  inner join ".$_SESSION[$tableFieldRetrievedValue]." on ".$_SESSION[$tableFieldRetrievedValue].'.'.$revisedcolId.' = '.$table_name.'.'.$revisedcolId;}
						else{
						
						$vars.=$table_name.'.'.$tableFieldRetrievedValue.$sep;}
						
						
						if($countrows==$cnt_foundcolumns){
						
						$Sqlstatement.=
						'
						$_SESSION["'.$table_name.'_SearchSQL"]="'.'
						
						'.'select '.$vars.'  from '.$table_name.$DynamicSQLcondition.'
						
						";';
						
						
						$Sqlstatementfinal=$Sqlstatement;
						
						
						}
						
						
							
	}//end inner tables

}//end all tables whjile
$sysfunc='./template/functions/searchSQL.php';

$finalstr=str_replace(",  ,",",",$Sqlstatementfinal);
//file_put_contents($sysfunc,'<?php'.$finalstr.'?>');
return $cmbsearch;
}//end func


?>

<?php
function buildlangTopMenu_links($dbinuse){													
    $sql_available_tables="show tables"; 
    $results=mysql_query( $sql_available_tables);
	$cntreg=mysql_num_rows($results);  

if ($cntreg>0){ 
                        
            while($count=mysql_fetch_array($results)){                                   
			$table_name=$count[0]; 
			$foldnamelinks=explode('_',$table_name);
			$foldnamelinkTo=$foldnamelinks[0];
			
				if($foldnamelinkTo==$prevfoloder){
				  $i++;
				  } 
				  else  {
				 $initialLinkPart='print "<a href=\"../';
				 $completeLink=$completeLink.$initialLinkPart.$foldnamelinkTo.'/'.trim($table_name).'.php\">'
				 .ucwords($foldnamelinkTo).'</a>";
				 ';
				 }
                $prevfoloder=$foldnamelinkTo; 
			
               }
			 }
$sysfunc='./template/functions/topmenulinks.php';
/*file_put_contents($sysfunc,'<?php   
'.$completeLink.'
'.' ?>');*/

} //end func select tables 

?>
<?php
function createPDFstatements($table_name,$foldnamelinkToUp){
$part_PDF='./template/pdf/pdftemp.php';
$pdfpartone = '';//file_get_contents($part_PDF);
//$newfilePDFdetails=$foldnamelinkToUp.'/'.$table_name.'_stm.php';

$newfilePDFdetails='./'.'../'.'statements/statement.php';

$currentPdf.='$tableinuse=$_POST["crrtbl"];
$table_pridarr=explode('."'_',".'$tableinuse);
if($table_pridarr[1]!='."''){".'
$tableprimaryvalue=$_POST["col"];
$table_name=$tableinuse;
$search_col=$table_pridarr[1].'."'_id';".'
createinsurance_clientPDFreports($table_name,$tableprimaryvalue); 
}';

$currentPdf.='$dbtable_input_tbl='."'".$table_name."';".'
create'.$table_name.'PDFreports($dbtable_input_tbl);
function create'.$table_name.'PDFreports($dbtable_input_tbl){
require('."'".'../template/pdf/fpdf.php'."');
class PDF extends FPDF
{
//Start column headers
function getheaders(".'$table_name){
}		  

//end column headers
function Header()
{
$this->Image('."'".'../template/reportimages/images/zul_logo.jpg'."',93,12,40,27);".
'$this->SetFont('."'"."Arial','',18);".'
$this->Image('."'".'./template/reportimages/images/word_zul_V31.jpg'."'".',75,40,80,4);
$this->SetFont('."'"."Arial','',6);".'
$date_printed=date('."'"."d-m-Y');".'
$this->Ln(35.5);
$this->Cell(20);
$this->Cell(40,5,'."'Address: P.O. Box 208 Eldoret  ',0,0,'C');".'
//$this->Cell(80);
$this->Cell(40,5,'."' Tel: 30100 - 30352, 30373 Fax: 056 - 30793',0,0,'C');".'
//$this->Cell(80);
$this->Cell(40,5,'."' Mobile: 0722 244504 / 0722 557102 ',0,0,'C');".'
$this->Cell(40,5,'."'Email: WesternWater@yahoo.com',0,1,'C');
".'$this->Cell(190,0,'."'','T');".'
//$this->Cell(80);
//$this->Cell(20,5,'."'Web: WesternWater.or.ke',0,1,'C');".'
$this->SetFont('."'Arial','',12);".'
  $this->Ln(10);
  $this->Cell(75,5, $_SESSION['."'".$table_name."'],0,1,'L');".'
  $this->SetFont'."('Courier','',8);".'
  //$this->Cell(75,5,'."'Date : '.".'$date_printed,1,1,'."'L');".
  '
  $this->Ln(5);
}
//Page footer
function Footer()
{
    //Position at 1.5 cm from bottom
    $this->SetY(-25);
    //Arial italic 8
	$date_printed=date('."'d-m-Y');".'
    $this->SetFont('."'Courier','',8);".'
    $this->Cell(180,6,'."' WesternWater ',0,1,'C');".'
	 $this->SetY(-18);
	 $this->SetFont('."'Courier','I',6);".'
	 $this->Cell(180,6,$_SESSION['."'".$table_name."'].'  printed by '".'.$_SESSION['."'my_username'].'  as at '".'.$date_printed'.",0,1,'C');
  //".'$this->Cell(100,6,$_SESSION['.$table_name."'].'  printed by '.".'$_SESSION['."'my_username'],0,1,'R');".'
  $this->Cell(100,6,'."' Page '.".'$this->PageNo()'.".' of {nb}',0,1,'R');
}

function LoadData(".'$dbtable_input_tbl,$headerfields)
{
$sql=$_SESSION[$dbtable_input_tbl.'."'_SearchSQL'];".'
$results_qry=mysql_query($sql) or die('."'Could not execute the query');
while(".'$count=mysql_fetch_array($results_qry)){
$cntcols=0;
foreach($headerfields as $pdffielditem){


$arrDataRow[$cntcols]=$count[$pdffielditem];
$processedfieldname=$pdffielditem;
$cntcols++;
}
$data[]=array_unique($arrDataRow);
}
return $data;
}
//Colored table
function CreateDynamicPDFLayout($header,$data,$headerfields,$headerWidth)
{
    $this->SetFillColor(150,125,255);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->'."SetFont('','B');
    //Header".'
  $w=array(30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30);
    for($i=0;$i<sizeof($header);$i++)
    $this->Cell($headerWidth[$i],6,$header[$i],1,0,'."'L',true);".'
    $this->Ln();
    //Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('."'');".'
    $this->SetFont('."'Courier','',7);".
	'
    //Data
    $fill=false;
	$rowitemnumber=0;
	$tcolmns=sizeof($headerWidth);
    foreach($data as $raw)
  {
        for($rowitemnumber=0;$rowitemnumber<$tcolmns;$rowitemnumber++){
		if($header[$rowitemnumber]!='."''){".'
		$this->Cell($headerWidth[$rowitemnumber],5,$raw[$rowitemnumber],'."'LRT'".', 0,'."'L'".', $fill);
		}
		}
       
		$rowitemdetails++;                    
        
        $this->Ln();
        $fill=!$fill;
    }
		$curentwidhtotal=array_sum($headerWidth);
    $this->Cell($curentwidhtotal,0,'."''".','."'T'".');
}

function summary_calculations($header,$data)
{
    //Column widths
    $w=array(1,15,10, 1);
    //Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'."'C');".'
    $this->Ln();
    //Data
    foreach($data as $row)
    {

     $totalsum=$row[4];
    }

}
function summary_table($data,$dbtable_input_tbl){
     $this->Ln();
    $this->SetFont('."'Arial','',8);

  
 foreach(".'$data as $raw)
  {

     //$totalsum=$raw[4];
    }


   $this->Cell(120,3,'."'',0,1,'L');".
'
$this->Ln(5);
}

}
$orientpdf='."'P';
if(sizeof(".'$header)>6){
$orientpdf='."'L';
};
".'$pdf=new PDF($orientpdf,'."'mm','A4');".'
$sqlcontrols="select distinct fieldname , fieldcaption, tablecaption , pdfvisible , position,colnwidth from admin_controller where tablename='."'".'$dbtable_input_tbl'."' and pdfvisible='Show' order by position".'"; '.'  
			$results_ctrls=mysql_query($sqlcontrols);
	        $cnt_cols=mysql_num_rows($results_ctrls);
			$countcurrentfield=0; 
			$displayvalues='."'';
			if(".'$cnt_cols>0){
			while($table_formcontrols=mysql_fetch_array($results_ctrls)){
			  $tablename=$table_formcontrols['."'tablename']; ".'
			  $table_caption=$table_formcontrols['."'tablecaption'];".
			  '$table_field=$table_formcontrols['."'fieldname'];".'
			  $table_col_caption=$table_formcontrols['."'fieldcaption'];".'
			  $table_col_viewdetails=$table_formcontrols['."'detailsvisiblepdf'];".'
              $table_col_viewonpdf=$table_formcontrols['."'pdfvisible'];".'
			  $table_col_positionb=$table_formcontrols['."'position'];".'
              $displayvalues[$countcurrentfield]=$table_formcontrols[0];
			  $header[$countcurrentfield]=$table_formcontrols[1];
			  $table_col_colnwidth=$table_formcontrols['."'colnwidth'".'];
			  if($table_formcontrols[3]=='."'Show'".'){
			  $headerWidth[$countcurrentfield]=$table_formcontrols[5];
			  }else{
			  $headerWidth[$countcurrentfield]=0;}
			  $headerfields[$countcurrentfield]=$table_formcontrols[0];
			  $countcurrentfield++;
			  }}//end of while

//Instanciation of inherited class
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('."'Arial','',12);".'
//for($i=1;$i<=40;$i++)

$data=$pdf->LoadData($dbtable_input_tbl,$headerfields);
$pdf->SetFont('."'Arial','',8);".'
$pdf->CreateDynamicPDFLayout($header,$data,$headerfields,$headerWidth);
//$pdf->summary_table($data);
$pdf->Output();

}';
$currentPdf=$pdfpartone.'<?php

 
'.$currentPdf.'

?>';
//file_put_contents($newfilePDFdetails, $currentPdf);
$currentPdf='';

}//end of pdf func
?>
<?php
function createPDFfilesDyanamically($table_name,$foldnamelinkToUp){
$part_PDF='./template/pdf/pdftemp.php';
$pdfpartone = file_get_contents($part_PDF);
$newfilePDFdetails=$foldnamelinkToUp.'/'.$table_name.'_pdf.php';
$currentPdf.='$dbtable_input_tbl='."'".$table_name."';"."
include('../template/functions/menuLinks.php');".'
create'.$table_name.'PDFreports($dbtable_input_tbl);
function create'.$table_name.'PDFreports($dbtable_input_tbl){
require('."'".'../template/pdf/fpdf.php'."');

class PDF extends FPDF
{
//Start column headers
function getheaders(".'$table_name){
}		  

//end column headers
function Header()
{
$companyArrInfo=getCompanyInfo();
$companyArr=explode(\'||\', $companyArrInfo[0]);
$this->setFont(\'Arial\',\'B\',10);
$year=\'/2011\';
$this->setY(10);
$this->cell(0,4,$companyArr[0],0,1,\'C\');
$this->Ln(2);
$this->cell(0,4,$_SESSION[\'stm'.$table_name.'\'],0,1,\'C\');
$this->Ln(5);
$this->SetFont(\'Arial\',\'\',6);
$date_printed=date(\'d-m-Y\');
$this->Cell(40,5,\'Address: P.O. Box  \'.$companyArr[4].\' - \'.$companyArr[5].\'  \'.$companyArr[6],0,0,\'C\');
//$this->Cell(80);
$this->Cell(40,5,\' Tel: \'.$companyArr[7].\' Fax: \'.$companyArr[8],0,0,\'C\');
//$this->Cell(80);
$this->Cell(20,5,\' Mobile: \'.$companyArr[9],0,0,\'C\');
$this->Cell(30,5,\'Email: \'.$companyArr[10],0,0,\'C\');
$this->Cell(30,5,\'Website: \'.$companyArr[11],0,1,\'C\');
$this->Cell(200,0,\'\',\'T\');
$this->SetFont(\'Arial\',\'\',12);
  $this->Ln(2);
  $this->SetFont(\'Courier\',\'\',8);
  $this->Ln(5);
}
//Page footer
function Footer()
{
$companyArrInfo=getCompanyInfo();
$companyArr=explode(\'||\', $companyArrInfo[0]);
    //Position at 1.5 cm from bottom
    $this->SetY(-25);
    //Arial italic 8
	$date_printed=date('."'d-m-Y');".'
    $this->SetFont('."'Courier','',8);".'
    $this->Cell(180,6,'.'$'."companyArr[0],0,1,'C');".'
	 $this->SetY(-18);
	 $this->SetFont('."'Courier','I',6);".'
	 $this->Cell(180,6,$_SESSION['."'stm".$table_name."'].'  printed by '".'.$_SESSION['."'my_username'].'  as at '".'.$date_printed'.",0,1,'C');
  //".'$this->Cell(100,6,$_SESSION['."stm".$table_name."'].'  printed by '.".'$_SESSION['."'my_username'],0,1,'R');".'
  $this->Cell(100,6,'."' Page '.".'$this->PageNo()'.".' of {nb}',0,1,'R');
}

function LoadData(".'$dbtable_input_tbl,$headerfields)
{
$sql=$_SESSION[$dbtable_input_tbl.'."'_SearchSQL'];".'
$results_qry=mysql_query($sql) or die('."'Could not execute the query');
".'$countRowsOut=0;'."
while(".'$count=mysql_fetch_array($results_qry)){
$cntcols=0;
$countRowsOut++;
foreach($headerfields as $pdffielditem){


$arrCutblArr=explode(\'_\',$dbtable_input_tbl);
$curtpk=$arrCutblArr[1].\'_id\';
if($pdffielditem==$curtpk){
$arrDataRow[$cntcols]=$countRowsOut;

}else{
$arrDataRow[$cntcols]=$count[$pdffielditem];

}

$processedfieldname=$pdffielditem;
$cntcols++;
}
$data[]=array_unique($arrDataRow);
}
return $data;
}
//Colored table
function CreateDynamicPDFLayout($header,$data,$headerfields,$headerWidth)
{
    $this->SetFillColor(150,125,255);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->'."SetFont('','B');
    //Header".'
  $w=array(30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30);
    for($i=0;$i<sizeof($header);$i++)
    $this->Cell($headerWidth[$i],6,$header[$i],1,0,'."'L',true);".'
    $this->Ln();
    //Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('."'');".'
    $this->SetFont('."'Courier','',7);".
	'
    //Data
    $fill=false;
	$rowitemnumber=0;
	$tcolmns=sizeof($headerWidth);
    foreach($data as $raw)
  {
        for($rowitemnumber=0;$rowitemnumber<$tcolmns;$rowitemnumber++){
		if($header[$rowitemnumber]!='."''){".'
		$this->Cell($headerWidth[$rowitemnumber],5,$raw[$rowitemnumber],'."'LRT'".', 0,'."'L'".', $fill);
		}
		}
       
		$rowitemdetails++;                    
        
        $this->Ln();
        $fill=!$fill;
    }
		$curentwidhtotal=array_sum($headerWidth);
    $this->Cell($curentwidhtotal,0,'."''".','."'T'".');
}

function summary_calculations($header,$data)
{
    //Column widths
    $w=array(1,15,10, 1);
    //Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'."'C');".'
    $this->Ln();
    //Data
    foreach($data as $row)
    {

     $totalsum=$row[4];
    }

}
function summary_table($data,$dbtable_input_tbl){
     $this->Ln();
    $this->SetFont('."'Arial','',8);

  
 foreach(".'$data as $raw)
  {

     //$totalsum=$raw[4];
    }


   $this->Cell(120,3,'."'',0,1,'L');".
'
$this->Ln(5);
}

}
$orientpdf='."'P';
if(sizeof(".'$header)>6){
$orientpdf='."'L';
};
".'$pdf=new PDF($orientpdf,'."'mm','A4');".'
$sqlcontrols="select distinct fieldname , fieldcaption, tablecaption , pdfvisible , position,colnwidth,isautoincrement from admin_controller where tablename='."'".'$dbtable_input_tbl'."' and pdfvisible='Show' order by position".'"; '.'  
			
			$results_ctrls=mysql_query($sqlcontrols);
	        $cnt_cols=mysql_num_rows($results_ctrls);
			$countcurrentfield=0; 
			$displayvalues='."'';
			if(".'$cnt_cols>0){
			while($table_formcontrols=mysql_fetch_array($results_ctrls)){
			
			  $tablename=$table_formcontrols['."'tablename']; ".'
			  $isautoincrement=$table_formcontrols['."'isautoincrement'];".'
			  $table_caption=$table_formcontrols['."'tablecaption'];".
			  '$table_field=$table_formcontrols['."'fieldname'];".'
			  $table_col_caption=$table_formcontrols['."'fieldcaption'];".'
			  $table_col_viewdetails=$table_formcontrols['."'detailsvisiblepdf'];".'
              $table_col_viewonpdf=$table_formcontrols['."'pdfvisible'];".'
			  $table_col_positionb=$table_formcontrols['."'position'];".'
              $displayvalues[$countcurrentfield]=$table_formcontrols[0];
			  $header[$countcurrentfield]=$table_formcontrols[1];
			  $table_col_colnwidth=$table_formcontrols['."'colnwidth'".'];
			  if($table_formcontrols[3]=='."'Show'".'){
			  $headerWidth[$countcurrentfield]=$table_formcontrols[5];
			  }else{
			  $headerWidth[$countcurrentfield]=0;}
			  
			   $fieldnameARR=explode(\'_\',$table_formcontrols[\'fieldname\']);
			  if(( $fieldnameARR[1]==\'id\')&&(!$isautoincrement)){
			  $headerfields[$countcurrentfield]=$fieldnameARR[0].\'_name\';
			  }
			  else{
			  $headerfields[$countcurrentfield]=$table_formcontrols[0];
			  }
			  $isautoincrement=\'\';
			  
			  
			  $countcurrentfield++;
			  
			  
			  
			  }}//end of while

//Instanciation of inherited class
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('."'Arial','',12);".'
//for($i=1;$i<=40;$i++)

$data=$pdf->LoadData($dbtable_input_tbl,$headerfields);
$pdf->SetFont('."'Arial','',8);".'
$pdf->CreateDynamicPDFLayout($header,$data,$headerfields,$headerWidth);
//$pdf->summary_table($data);
$pdf->Output();

}';
$currentPdf=$pdfpartone.'<?php

 
'.$currentPdf.'

?>';
//file_put_contents($newfilePDFdetails, $currentPdf);
$currentPdf='';

}//end of pdf func
?>
<?php
function buildPHPfiles($dbinuse){	
    $sql_available_tables="show tables"; 
    $results=mysql_query($sql_available_tables);
	$cntreg=mysql_num_rows($results);  

if ($cntreg>0){ 
               $table_namePrevious='';                      
            while($count=mysql_fetch_array($results)){                                   
			 $table_name=$count[0];
			 $foldnamelinks=explode('_',$table_name);
			 $foldnamelinkTo=$foldnamelinks[0];
			 $newfilefolder=$foldnamelinkTo;
					
			 if($table_namePrevious==''){
			   $foldnameArry=explode('_',$table_name);
				$newfilefolder='./'.$foldnameArry[0];
                 }
			 
			 $table_namePrevious=$table_name;
			 
				$directorytest=is_dir($newfilefolder);
				
				if(!$directorytest){
				//mkdir($newfilefolder, 0700);
				}
				$creatednewfilefolder=$newfilefolder;
				$newfiledetails="$newfilefolder/".$table_name.'.php';
				$newfileViewdetails="$newfilefolder/".$table_name.'details.php';
				$newfileoptions="$newfilefolder/".$table_name.'_options.php';
				$part_one='d:design/part1.txt';
				$ajaxfile='./template/functions/scriptsAJAX.js';
				$currentAjaxSripts = file_get_contents($ajaxfile);
				$displayfile='./template/functions/ctrDisplay.php';
				//$currentDisplay = file_get_contents($displayfile);
				//$current = file_get_contents($part_one);
				
				
				
				
				
$current.='<div id="container">
<div class="full_width big">
<div id="options_tab"><p><a href="../'.$newfilefolder.'/'.$table_name.'.php'.'" > Add </a> |<a href="#" >  Statement </a>| 
<a href="../'.$newfilefolder.'/'.$table_name.'_options.php"> Options </a> | <a href="../'.$newfilefolder.'/'.$table_name.'_pdf.php"> PDF </a> | <a href="../home/view.php?token='.base64_encode($table_name).'&&r='.base64_encode($_SESSION['currentusergroup']).'" > View </a> | </p></div></div>';

$current.='<div id="tablecontentdetails"></div><div id="demo"><table width="100%" border="0"><tr><td><td><div align="right">';

//////////////////////////////////////////////////////////////////////////////////// 
                $partone_raw=file_get_contents($part_one); 
								                     
						//get the first column
						$sqltbcols1="Show columns from $table_name";   
			                   $results_tbc1=mysql_query($sqltbcols1);
	                           $cnt_cols1=mysql_num_rows($results_tbc1);							                          $count_colmn=mysql_fetch_array($results_tbc1);                               
							   //if($Seach=''){    
			                 $table_name_link_field_id=$count_colmn[0];
							 //}
							 //$Seach=$count_colmn[0];
			                 //*****************

//builing recordsets
$current.= '
<?php $found_recordset = "-1";
$sub_cption="Save";
$btnprec="submit_";
if (isset($_GET['."'q'".'])) {
  $colname_to_name =base64_decode($_GET['."'q'".']);
  $query_recs = $_SESSION["'.$table_name.'_SearchSQL"]." WHERE '.$table_name_link_field_id.' = $colname_to_name";

$sub_cption="Update";
$btnprec="update_";
$found_recordset = mysql_query($query_recs) or die(mysql_error());
$row_found_recordset = mysql_fetch_array($found_recordset);
$totalRows_recordRetrievePayment = mysql_num_rows($found_recordset);
}

 //end of building recordsets '."<br".'?>';
 				$ajaxcalled='';
				$firstItemProcessedID='';								
   $sqltbcols="Show columns from $table_name";
   	   
			$results_tbc=mysql_query($sqltbcols);
	        $cnt_cols=mysql_num_rows($results_tbc);
			//add view links
			$foldnamelinks=explode('_',$table_name);
			 $foldnamelinkToUp=$foldnamelinks[0];
			$viewtablelink= base64_encode($table_name);
			$current.="
			<br /><p><".'?php echo "'. 
'<a href=\"../home/view.php?token='.$viewtablelink.'\"> View/Edit" .$_SESSION["'.$table_name.'"]."'.
			' </a><img src=\"../template/images/comment.gif\" alt=\"\" />'.'
<img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a  href=\"../'.$foldnamelinkToUp.'/'.$table_name.'_pdf.php\"/>View PDF </a><img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a href=\"../'.$foldnamelinkToUp.'/'.$table_name.'_options.php\"/>Options </a></p>'."'".'"; ?>';
			
			
			//end of view details links
			$current.='<form name ="frm'.$table_name.'" action="" method="post">';
			$current.='<div align="left">'.'<h3><?php echo $_SESSION["'.$table_name.'"]; ?></h3><hr></p>
  
  <table width="400" border="0">
    ';
  $foundcolmnlocactionId=0;
  $notprocessedrowidentifier='';
			while($count_cls=mysql_fetch_array($results_tbc)){
			
			  $table_col_Name=$count_cls['Field']; 
			  $table_col_Type=$count_cls['Type']; 
			  $table_col_Null=$count_cls['Null'];
         $sectionty=substr($table_col_Type,0,3);
	     $fkcheck=substr($table_col_Name,0,3);
		 $row_found_recordsetvalue='';
		 $sub_cption='Save';
		 $btn_name='submit_'.$table_name;
		 if ($totalRows_recordRetrievePayment>0){
		 $row_found_recordsetvalue='<?php echo $row_found_recordset["'.$foundcolmnlocactionId.'"]; ?>';
		 $sub_cption='Update';
		 $btn_name='Update_'.$table_name;
		 }
  //CHECK TO CREATE AJAX
	$table_ajaxchk=explode('_',$table_col_Name);
     $columnhasajaxName=$table_ajaxchk[1];
	 
	 if(($columnhasajaxName=='id')&&($prcap!='')){
	 $determinectrlvalue=$table_ajaxchk[0].'_name';
	 $determinectrlvalueIndV=$table_ajaxchk[0].'_name';
	 $determinectrlvalue='<?php echo $_SESSION["rowFnd'.$table_ajaxchk[0].'_name"]'.' ?>';
	 }else{
	 //$determinectrlvalue=$table_col_Name;
	 $determinectrlvalueIndV=$table_col_Name;
	 $determinectrlvalue='<?php echo $row_found_recordset['.$table_col_Name.']; ?>';
	 
	 }
	 $prcap='processed captions in values';
	 
	if($columnhasajaxName=='name'){
	//print_ajax_search_box();
	$columnhasajaxNamefoundid=$table_col_Name;
	$columnhasajaxNamefounddecs=$table_ajaxchk[0].'_name';
//$AjaxJavascriptString.=ajaxJavascriptor($table_col_Name,$table_name);
$RpcPageStr=createRpcPage($table_col_Name,$table_name);

            }
			$captiondetailsfield='<?php echo $_SESSION["'.$table_name.$determinectrlvalueIndV.'"]; ?>';
			if(($columnhasajaxName=='id')&&($ajaxcalled!='')){
	        $columnhasajaxNamefoundid='onkeyup=" lookup_'.$_SESSION[$table_col_Name].'(this.value);'
			.'"';
			//.'fill_hidden'.$table_col_Name.'(this.value);'
			//$recentnamefillout.='$_SESSION["lastname"'.$table_ajaxchk[0].'_name"];'
	        }        
			
			if(($columnhasajaxName=='id')&&($ajaxcalled=='')){
	        $ctrlTypeTP='hidden';
			//$captiondetailsfield='';
	        } 
			$ajaxcalled='called Ajax';
			$columnhasajaxName='';
	//END OF AJAX
	
	if( $fkcheck!='fk_'){
	$current.="<tr>";
    $current.="<td>"; 

	if( $firstItemProcessedID==''){
	$captiondetailsfield='';
	
	}
	if( $table_col_Name=='employee_id'){
	$captiondetailsfield='';
	//$foundcolmnlocactionId=$foundcolmnlocactionId-1;
	 
	}
	if( $table_col_Name=='user_password'){
	$ctrlTypeTP='password';
	}
	$current.=$captiondetailsfield;
	$current.= "</td>";
	$current.="<td>
	";
	$ctrlTypeTP='text';
	} 
	//$first columntest';
	if( $firstItemProcessedID==''){
	$ctrlTypeTP='hidden';
	//$foundcolmnlocactionId=$foundcolmnlocactionId-1;
	
	}
	
	$firstItemProcessedID='ProcessedFirstRow';
	
	
	
	if( $sectionty=='dat'){
	//echo $table_col_Name;
	$current.='<?php print_date_picker('.$table_col_Name.',$_SESSION["'.$table_name.$table_col_Name.'"]); ?>';
	}
	//begin rem emp
	
	if(( $sectionty=='int')&&($table_col_Name=='employee_id')){
	
	//do nothing
	}else{ //else
	if( $sectionty=='int'){
	
	$current.='<input type="'.$ctrlTypeTP.'"  size="32"'.$columnhasajaxNamefoundid.' id="'.$table_col_Name.'" name="'.$table_col_Name.'"value="'.$determinectrlvalue.'">';
	}
	
	$table_checkfkedarr=explode('_',$table_col_Name);
    $columnfkIdefiedfksearch=$table_checkfkedarr[1];
	 
	if(($sectionty=='int')&&($firstItemProcessedIDfked!='')){
	
	if(($columnfkIdefiedfksearch=='id')&&($firstItemProcessedIDfked!='')){
	
	$activeTable=$_SESSION["$table_col_Name"];
	$isaforeignkeytable=strpos($_SESSION["DescriptiveTables"],$activeTable);
	
	
	if($isaforeignkeytable){
		//determining foreign key details
	
	$lastfoundvaliditemARR=explode('_',$table_col_Name);
$lastfoundvaliditem=$lastfoundvaliditemARR[0];
//if($notprocessedrowidentifier==''){
$current.='<?php

if($row_found_recordset["'.$lastfoundvaliditem.'_name"]=='."''".'){
	
	//do nothing
	}else{
	
	$_SESSION["rowFnd'.$lastfoundvaliditem.'_id"]'.'=$row_found_recordset['."'".$lastfoundvaliditem."_id'];".'
	$_SESSION["rowFnd'.$lastfoundvaliditem.'_name"]'.'=$row_found_recordset['."'".$lastfoundvaliditem."_name'];".'
	}
	
	?>';
	$notprocessedrowidentifier='processed';
	//}
	
	//end of foreign key
	$current.='<input type="hidden"  size="32" id="'.$table_col_Name.'hidden" name="'.$table_col_Name.'hidden' .'"value="'.'<?php echo $_SESSION["rowFnd'.$lastfoundvaliditem.'_id"]; ?>'.'">';
	//$determinectrlvalue=
	$lastfoundvaliditem='';
	}
	
	}
	
	}
	}//end testemp
	$firstItemProcessedIDfked='ProcessedKey';
	if( $sectionty=='var'){
	$current.='<input type="'.$ctrlTypeTP.'"  size="32" id="'.$table_col_Name.'" name="'.$table_col_Name.'" value="'.$determinectrlvalue.'">';
	}
	 
	 if( $sectionty=='tex'){
	$current.='<textarea cols="48"'.'"  rows="4" id="'.$table_col_Name.'" name="'.$table_col_Name.'">'.$determinectrlvalue.'</textarea>';
	}
	
	 if( $sectionty=='dou'){
	$current.='<input type="'.$ctrlTypeTP.'"  size="32" id="'.$table_col_Name.'" name="'.$table_col_Name.'" value="'.$determinectrlvalue.'">';
	}
	 if( $sectionty=='tin'){
	$current.='<input type="'.$ctrlTypeTP.'"  size="32" id="'.$table_col_Name.'" name="'.$table_col_Name.'" value="'.$determinectrlvalue.'">';
	}
	if( $sectionty=='big'){
	$current.='<input type="'.$ctrlTypeTP.'"  size="32" id="'.$table_col_Name.'" name="'.$table_col_Name.'" value="'.$determinectrlvalue.'">';
	}
	if( $sectionty=='sma'){
	$current.='<input type="'.$ctrlTypeTP.'"  size="32" id="'.$table_col_Name.'" name="'.$table_col_Name.'" value="'.$determinectrlvalue.'">';
	}
	if( $sectionty=='dec'){
	$current.='<input type="'.$ctrlTypeTP.'"  size="32" id="'.$table_col_Name.'" name="'.$table_col_Name.'" value="'.$determinectrlvalue.'">';
	}
	if( $sectionty=='yea'){
	$current.='<input type="'.$ctrlTypeTP.'"  size="32" id="'.$table_col_Name.'" name="'.$table_col_Name.'" value="'.$determinectrlvalue.'">';
	}
	$firstKprocessed='processedFJ';
	if( $fkcheck!=='fk_'){
	$current.="</td>";
	$current.="</tr>
	";
	$fkcheck='';
	$ctrlTypeTP='';
	}
	
  $foundcolmnlocactionId++;
  } 
  $locatorDetails='';//=moveNextLink($table_name);
  
 $current.='<tr>
    <td colspan="2"><P  class=\"date\"></p></td></tr>'
	.'<tr>
    <td colspan="2"><input type="submit" class="resetbutton"'.' name=" <?php echo $btnprec."'.$table_name.'"; ?>"'.' id=" <?php echo $btnprec."'.$table_name.'SQL"; ?>"'.'value="'.'<?php echo trim($sub_cption); ?>'.'">
<input type="button" '.$locatorDetails.'class="resetbutton"id="next'.$table_name.'" name="next'.$table_name.'" value="Next ">&nbsp;<input type="reset" class="resetbutton"id="rst'.$table_name.'" name="rst'.$table_name.'" value="Cancel ">


</td>
<tr>
    <td colspan="2">&nbsp;</p></td></tr>

</table><hr>'.

'<td><?php print_ajax_search_box();?></td></div></div></form>';
  
//mysql_free_result($table_name);

//*****************************************************************************
$linkIntrofile='d:design/linkIntro.txt';
$newformatbotton='d:design/newformatBotton.txt';
$newformattop='d:design/newformatheader.txt';
$linkIntrofile='d:design/linkIntro.txt';
$linkIntrotext = file_get_contents($linkIntrofile);
$newformatbottom = file_get_contents($newformatbotton);
$newformatheader = file_get_contents($newformattop);
////********************************
$tableFromId=$table_name;
$foldnamelinks=explode('_',$tableFromId);
$foldnamelinkTo=$foldnamelinks[0];
$searchfielddetails=$foldnamelinks[1].'_name';
//removed links
/*$linkIntrotext.='<?php  
foreach ($'.$foldnamelinkTo.'_links as $linkitem){
$tableFromId=$linkitem;
$foldnamelinks=explode('."'_',".'$tableFromId);
$foldnamelinkTo=$foldnamelinks[0];'.
'
echo "<a href=\"../'.$foldnamelinkTo.'/$linkitem'.'.php'.'\">".'.'$_SESSION["'.'$linkitem'.'"].'
."'".'</a>'."'".';'.
'$item++;'.
'
}
?>';*/
//////
$headerspintr='d:design/headers.txt';
$part_two='d:design/part2.txt';
$suggbox='';
$headerspintr = file_get_contents($headerspintr);
$cpart2 = file_get_contents($part_two);
$finaldata=$headerspintr.$currentAjaxSripts.$current.$suggbox.$newformatbottom.$linkIntrotext.$cpart2;
//echo $newfiledetails;
//exit;
$currentNeedsStartForeign='';
//file_put_contents($newfiledetails, $finaldata);

///Create List display
$finaldata_links=$current."<br />".$linkIntrotext.$cpart2;

$listDataInitial=$headerspintr.$partone_raw;
$listDataInitial.="
			<br /><p><".'?php echo "'. '<a href=\"../'.$foldnamelinkToUp.'/'.$table_name.'details.php \"/> View ".$_SESSION["'.$table_name.'"]."'.'</a><img src=\"../template/images/comment.gif\" alt=\"\" /><a href=\"../'.$foldnamelinkToUp.'/'.$table_name.'.php\"> Add ".$_SESSION["'.$table_name.'"]."'.
			' </a>'.'<img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a href=\"../'.$foldnamelinkToUp.'/'.$table_name.'_pdf.php\"/>View PDF </a><img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a href=\"../'.$foldnamelinkToUp.'/'.$table_name.'_options.php\" />Options </a></p>'."'".'"; ?>';

$listDataInitial.='<?php displayallrecs('."'".$table_name."'".','."'".$table_name_link_field_id."'".','."'".$table_name."','".$table_name."',"."'".$table_name.'_SearchSQL'."'".','."'".
$searchfielddetails."'".'); ?>'."<br />".$linkIntrotext.$cpart2;
//file_put_contents($newfileViewdetails, $listDataInitial);

//options
$listoptions=$headerspintr.$partone_raw;
$listoptions.="
			<br /><p><".'?php echo "'. '<a href=\"../'.$foldnamelinkToUp.'/'.$table_name.'details.php \"/> View ".$_SESSION["'.$table_name.'"]."'.'</a><img src=\"../template/images/comment.gif\" alt=\"\" /><a href=\"../'.$foldnamelinkToUp.'/'.$table_name.'.php\"> Add ".$_SESSION["'.$table_name.'"]."'.
			' </a>'.'<img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a href=\"../'.$foldnamelinkToUp.'/'.$table_name.'_pdf.php\"/>View PDF </a><img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a href=\"../'.$foldnamelinkToUp.'/'.$table_name.'_options.php\"/>Options </a></p>'."'".'"; ?>';
$listoptions.='<?php display_found_search_records('."'".$table_name."'".');
submit_options('."'".$table_name."'".');  
?>'."<br />".$linkIntrotext.$cpart2;
//file_put_contents($newfileoptions, $listoptions);
//end of options


/// end of the listdisplay

//PDF                       create                   PDF

//create pdfs
createPDFfilesDyanamically($table_name,$foldnamelinkToUp);
//end of creating pdfs

//Now creating Ajax Calls
if($RpcPageStr!=''){
//$rpcfiledetails="$newfilefolder/rpc".$table_name.'.php';
//file_put_contents($rpcfiledetails, $RpcPageStr);
            }
$columnhasajaxName='';
$RpcPageStr='';
//$AjaxJavascriptString='';
//End AJAX CALLS




} //end while tables************
  
               } //end if checking for  tables************



} //end func select tables  

//function link sessions

function buildlangLinkSessions($dbinuse){	
//select all tables
    $sql_available_tables="show tables"; 
    $results=mysql_query($sql_available_tables);
	$cntreg=mysql_num_rows($results);  

if ($cntreg>0){ 
               $table_namePrevious='';
			   //$linkdetailssummary='';
			   $donefilesrecent=''; 
			    //$foldnamelinks='';                       
            while($count=mysql_fetch_array($results)){               
			 $table_name=$count[0];
			 $foldnamelinks=explode('_',$table_name);
			 $foldnamelinkTo=$foldnamelinks[0];
			  
		$linkdetailssummary.='<a href="../'. $foldnamelinkTo.'/'.              $table_name.'.php"><?php echo $_SESSION["'.$table_name.'"]; ?></a>';
			 	
				
	//echo '$_SESSION["'.$table_name.'"]='.'<a href="../'. $table_name.'/'."<br>";              
		}	//endwhille		
	}				
}
					//end of the link sesssions

?><?php
function generateUpdateStmsts($dbinuse){													
    $sql_available_tables="show tables"; 
    $results=mysql_query( $sql_available_tables);
	$cntreg=mysql_num_rows($results);  

if ($cntreg>0){ 
                       
            while($count=mysql_fetch_array($results)){                                   
			$table_name=$count[0]; 
			
			
			$sqltbcols="Show columns from $table_name";   
			$results_tbc=mysql_query($sqltbcols);
	        $cnt_cols=mysql_num_rows($results_tbc);
			
			 $prossedcolcnt=0; 	
			$firstclm='';
			$countpreviouscolmns=0;
			while($count_cls=mysql_fetch_array($results_tbc)){
			$prossedcolcnt++;
			$countpreviouscolmns++;
			$separatorcm="' , ";
			if($cnt_cols==$prossedcolcnt){
			 $separatorcm="'";
			 }
			
			  $table_col_Name=$count_cls['Field']; 
			  $columnfoundtoprocessarr=explode('_',$table_col_Name);
			$fieldidentifiedforcurrentfield=$columnfoundtoprocessarr[1];
			  //process assign for first colmn
			  if($countpreviouscolmns==1){
			  
			  $assigncolmone='$'.$table_col_Name.'=$_POST['."'".$table_col_Name."hidden'];";
			  $firstcolidentifiedas=$columnfoundtoprocessarr[0];
			  }
			  //end of first colmn
			  //determine foreign handle
			  
			
			
			if(($table_col_Name=='employee_id')&&($countpreviouscolmns>1)){
			//echo '$'.$table_col_Name."=".'$_SESSION'."['".'my_username_id'."'];"."<br>";
			
			$updateSQLscript.='$'.$table_col_Name."=".'$_SESSION'."['".'my_username_id'."'];"."
			";
			
			
			}
			
			else if(($fieldidentifiedforcurrentfield=='id')&&($table_col_Name!='employee_id')&&($countpreviouscolmns>1)){
				$instations.='$'.$table_col_Name.'=$_POST['."'".$table_col_Name."hidden'];"."";
				$processedcolumnnames.=$table_col_Name.' ';
				$updateSQLscript.=$instations;
				$updateSQLscriptCheck='if($_POST["'.$columnfoundtoprocessarr[0].'_idhidden"]=='."''){".'
				$'.$columnfoundtoprocessarr[0].'_id=$_SESSION["rowFnd'.$columnfoundtoprocessarr[0].'_id"];
				}else
				{$_SESSION["rowFnd'.$columnfoundtoprocessarr[0].'_id"]=$'.$columnfoundtoprocessarr[0].'_id;}';	
				$updateSQLscript.='$_SESSION["rowFnd'.$columnfoundtoprocessarr[0].'_name"]=trim($'."_POST['".$columnfoundtoprocessarr[0]."_id'])".
				';
';
//$lastidnamed='';
						
						}
			else{
			     $isaforeignkeytable=strpos($_SESSION["DescriptiveTables"],$activeTable);
	            /*if($isaforeignkeytable>0){ 
				//do nothing
				}else{*/
				$instations.='$'.$table_col_Name.'=$_POST['."'".$table_col_Name."'];"."
				";//}
				}
				
			  //end of foreighn handler
              //$updateStr=$table_col_Name ."='".'$table_col_Name'."' , "."<br>";
           if($firstclm==''){
		   //do nothing
		   }
		   else{
		   $declationsSQLs.= $table_col_Name.'='."'".'$'.$table_col_Name.$separatorcm."
		   ";
		   }
		   
		   if($firstclm==''){
		   $table_pr_key=$table_col_Name;
			 
$updateSQLscript.='
function update_'.$table_name.'_stmt(){'."
".'
if (isset($_POST["update_'.$table_name.'"])) {'."
".'
// Defining Variables for '. $table_name.' Update SQL Statement
'."
"; 
			 
			 }else{
			 //
			 }
			 
			 if($cnt_cols==$prossedcolcnt){
			 $separatorcm='';
			 //echo 'after  ='.$instations."<br><br>";
			 
			 $updateSQLscript.=$instations.'
			 '.$updateSQLscriptCheck.' 
			 '.$assigncolmone.'
			 $_SESSION["rowFnd'.$firstcolidentifiedas.'_id"];';
			 $firstcolidentifiedas='';
			$updateSQLscript.='
			$UpdateSQL'.$table_name.' = " UPDATE '. $table_name."
			".' SET 
			';
			//echo  "<br>".$declationsSQLs."  WHERE  $table_pr_key".'=$'.$table_pr_key.'";'."<br>";
			$updateSQLscript.= "
			".$declationsSQLs."  WHERE  $table_pr_key".'=$'.$table_pr_key.'";'."
			
			";
			$updateSQLscriptCheck='';
		//get session for last id
	//$_SESSION["rowFnd'.$lastfoundvaliditem.'_id"]'
	//$_SESSION["lastid'.$table_pr_key.'"]	
$lastidnames=explode('_',$table_pr_key);
$updateSQLscript.='
$_SESSION["rowFnd'.$lastidnames[0].'_id"]= '.'$'.$table_pr_key.';
$_SESSION["rowFnd'.$lastidnames[0].'_name"]= '.'$'.$lastidnames[0].'_name;
';
$lastidnames='';
		//end of last id session	
$updateSQLscript.='
// END of Update SQL Statement for user'."
".
';
$Result_update = mysql_query($UpdateSQL'.$table_name.') or die(mysql_error());'."
".'} //End If'."
".'
}'."
".' //End function Update//initialize '.$table_name. "
".

'if (isset($_POST["'.'update_'.$table_name.'"])) {'."
".'
if (isset($_GET['."'q'".'])) { '."
".'$colname_to_nameID =base64_decode($_GET['."'q'".']);'."
".'update_'.$table_name.'_Stmt ();'."
".'}'."
".'}';

			 }
			  
			
			$firstclm='Started';
			
			} 
$declationsSQLs='';
$instations='';
$table_name='';
$table_pr_key='';
$processedcolumnnames='';  
} //end while

//echo $updateStr;
$updateStr='';
$updateSQLscript.=$updateStr;
} //end if

$sysfunc='./template/functions/updateSQL.php';
//file_put_contents($sysfunc,'<?php'.$updateSQLscript.'?>');
} //end func select tables   

?>
<?php
function buildlangfileRSVTb_links($dbinuse){													
    $sql_available_tables="show tables"; 
    $results=mysql_query( $sql_available_tables);
	$cntreg=mysql_num_rows($results);  

if ($cntreg>0){ 
                        
            while($count=mysql_fetch_array($results)){                                   
			$table_name=$count[0]; 
			$foldnamelinks=explode('_',$table_name);
			$foldnamelinkTo=$foldnamelinks[0];
			$primary_keyitem=$foldnamelinks[1].'_id';
			//identify primary keys
			$folderlinkstrprimary.= '
			$'.'_SESSION["primary_'.$primary_keyitem.'"]="'.$table_name.'";';
			
			//echo $table_name.'<br>'; 
			if(!$prevfoloder){
  $i=1;
   //echo '$'.$foldnamelinkTo."_links[0]=".$table_name."<br>";
  }
  
  if($foldnamelinkTo==$prevfoloder){
  $i++;
  } else
  {
  $i=1;
  //echo '$'.$foldnamelinkTo."_links[0]=".$table_name."<br>";
  }
  $prevfoloder=$foldnamelinkTo; 
			$sqltbcols="Show columns from $table_name";   
			$results_tbc=mysql_query($sqltbcols);
	        $cnt_cols=mysql_num_rows($results_tbc); 
			while($count_cls=mysql_fetch_array($results_tbc)){
			  $table_col_Name=$count_cls['Field']; 
			  $table_col_Type=$count_cls['Type']; 
			  $table_col_Null=$count_cls['Null'];
			 
    $isprimarytblskarr=explode('_',$table_col_Name);
          $primarydeterminant=$isprimarytblskarr[1];
		  if($primarydeterminant=='name'){
		  $primarykeydescriptionstr= $primarykeydescriptionstr.'
		    
		                          '. $table_name.
		  '                                              ';
		  }
			}  
			
			$folderlinkstr.= '
			$'.$foldnamelinkTo."_links[".$i."]='"
			. $table_name
			. "';
			";
			
			


} //end while
} //end if
$primarykeydetermination=
'
$foundtableswithforeignkeys="'.$primarykeydescriptionstr.'
";';

$primarykeydescriptionstr=
'$_SESSION["DescriptiveTables"]="'.$primarykeydescriptionstr.'
";';



$sysfunc='./template/functions/folderlinks.php';
$determinLinks='./template/functions/determinelinks.php';
/*file_put_contents($sysfunc,'<?php  
'.$primarykeydescriptionstr.'
'.$folderlinkstrprimary.'
'.$folderlinkstr.'?>');*/

echo $primarykeydetermination;
/*file_put_contents($determinLinks,'<?php  

function tableswithforeignkeys(){'
.
$primarykeydetermination.'
'.'

return $foundtableswithforeignkeys;
}?>');*/

} //end func select tables 

?>
<?php
function buildAjaxSearchQriesMainfile(){ 
$DescriptiveTables=getTablesFormPrimaryKeys();
$sql_available_tables="show tables"; 
$results=mysql_query( $sql_available_tables);
$cntreg=mysql_num_rows($results);  
if ($cntreg>0){ 
            $firstitem='';        
            while($count=mysql_fetch_array($results)){                                   
			$table_name=$count[0]; 
			  $sqlshowcolumns="Show columns from $table_name";   
			  $results_showcolumns=mysql_query($sqlshowcolumns);
	          $cnt_foundcolumns=mysql_num_rows($results_showcolumns);
			   $firstcomn='';  
			 if($cnt_foundcolumns>0){
			     $countnumberofcolmns=0;
			    while($count_colmn=mysql_fetch_array($results_showcolumns)){
						   $countnumberofcolmns++;
						   $tableFieldRetrievedValueOr=$count_colmn[0];
						   $tableFieldforSearch=$count_colmn[0];
									//CHECK TO CREATE AJAX
									$table_ajaxchk=explode('_',$tableFieldRetrievedValueOr);
									 $columnhasajaxName=$table_ajaxchk[1];
									 $iprimaryLinkfield=strpos($DescriptiveTables,$table_name);
									  if($countnumberofcolmns==1){
												 if($iprimaryLinkfield){
												  $columnhasajaxNamefoundid=$tableFieldRetrievedValueOr;
												  $columnhasajaxNamefounddecs=$table_ajaxchk[0].'_name';
												  $AjaxJavascriptString.=ajaxJavascriptor($tableFieldRetrievedValueOr,$table_name);			
												  file_put_contents('./template/functions/scriptsAJAX.js', $AjaxJavascriptString);
											
												  }
									
										}//END OF AJAX
									  
			   // ||||||||||||||||||||||||||||| SEARCHING  |||||||||||||||||||||||||||||||||
			   
							   $columnarr=explode('_',$tableFieldforSearch);
							   $isforeignitem=$columnarr[1];
                                 if($countnumberofcolmns==$cnt_foundcolumns){$separor='';}  else { $separor=' , ';}
								 if($cnt_foundcolumns==2){$separor='';}  else { $separor=' , ';}
			if($firstSearch==''){ $table_primary_key=$count_colmn[0];$isforeignff_descr='Select '.$table_name.'.'.$count_colmn[0].$separor; } 
			   //mark row as processed
			   $firstSearch='processed';
			   
			   if($isforeignitem=='id'){
			        $table_foreign_key=$count_colmn[0];
				    $activeTable=trim($_SESSION["$tableFieldRetrievedValueOr"]);
					//echo"$DescriptiveTables <br><br><br><br>,$activeTable";
					if(($DescriptiveTables)&&($activeTable)){
				    $fkdetermine=strpos($DescriptiveTables,$activeTable);
					}
				
				if($fkdetermine){
					$columnaff=explode('_',$table_foreign_key);
				    $isforeigkeynamed=$columnarr[0].'_name';
					$isforeigkeynamed_id=$columnarr[0].'_id';
					$withforeignkeydesc.=$_SESSION[$table_foreign_key].'.'.$isforeigkeynamed.$separor;
					
					if($_SESSION[$table_foreign_key]!=$table_name){
					$DynamicSQLcondition.="  inner join 
					".$_SESSION[$table_foreign_key].
					" on "
					.$_SESSION[$table_primary_key].'.'.$table_foreign_key.' = '
					.$_SESSION[$table_foreign_key].'.'.$table_foreign_key;
					
					  
			         }
					}
				
			     }else{
				 $columnaffnamedarr=explode('_',$count_colmn[0]);
				    $isforeignfffounded=$columnaffnamedarr[1];
					if(($isforeignfffounded=='name')&&($table_foreign_key!='')){
					//do nothing
					}
					else{
				 $withforeignkeydesc.=$table_name.'.'.$count_colmn[0].$separor;
				 }
				 
				 }
				 
			  }//end while columns
			  $correctfrom='  from';
              $DynamicSQLWHEREcondition="<br>";
			$cmbsearch.= '
			
			$_SESSION["'.$table_name.'_SearchSQL"]="'.$isforeignff_descr.' '.$withforeignkeydesc.' from '.$table_name.'  '. $DynamicSQLcondition.'";
			
			';
			
			   $isforeignff_descr='';
			   $DynamicSQLcondition='';	
			   $DynamicSQLWHEREcondition=''; 
			   $withforeignkeydesc=''; 
}//end while tables	
}//end if for checking colmns		
} //end tables if

$sysfunc='./template/functions/searchSQLold.php';
file_put_contents($sysfunc,'<?php'.$cmbsearch.'?>');
return $cmbsearch;
}//end func create SQL

?>
<?php
function buildlangfileRSVInsertsPlus($dbinuse){													
    $sql_available_tables="show tables"; 
    $results=mysql_query( $sql_available_tables);
	$cntreg=mysql_num_rows($results);  

if ($cntreg>0){ 
//print "<input type=\"text\" name=\"num_found_contacts\" value=\"$cntreg\">";                        
            while($count=mysql_fetch_array($results)){                                   
			$table_name=$count[0]; 
	//echo '//********** Starting  Insert Statements  Table'.$table_name.'***********************<p><br>';  

$insertsearch.='
//********** Starting  Insert Statements  Table'.$table_name.'***********************

';  
	
//echo'//initialize '."$table_name <p>";
$insertsearch.='
//initialize '."$table_name".'
';
//print 'if (isset($_POST["submit_'.$table_name.'"])) {'."<p>";
$insertsearch.= '
if (isset($_POST["submit_'.$table_name.'"])) {
';

//echo 'Insert_'. $table_name.'_Stmt  ();';

$insertsearch.=	'
Insert_'. $table_name.'_Stmt  ();
';
//print'}'."<p>";

$insertsearch.=	'
}
';

//print 'function Insert_'. $table_name.'_Stmt  (){'."<p>";

$insertsearch.=	'
function Insert_'. $table_name.'_Stmt  (){'.'
';
//print 'if (isset($_POST["submit_'.$table_name.'"])) {'."<p>";
$insertsearch.='
if (isset($_POST["submit_'.$table_name.'"])) {'.'

';
///////////////////Build post functionalities
	
	$sqltbcols="Show columns from $table_name";   
			$results_tbc=mysql_query($sqltbcols);
	       $cnt_cols=mysql_num_rows($results_tbc); 
	//		echo "<p>". '// Defining Variables for '.$table_name.' Insert SQL Statement '."<p>";
			$insertsearch.='
			// Defining Variables for '.$table_name.' Insert SQL Statement 
			';
			
			
			$countpreviouscolmns=0;
			while($count_cls=mysql_fetch_array($results_tbc)){
			$countpreviouscolmns++;
				$table_foreign_key=$count_cls['Field'];
				$activeTable=$_SESSION["$table_foreign_key"];
				$isinsidefk=strpos($_SESSION["DescriptiveTables"],$activeTable);
			
			$columnfoundtoprocessarr=explode('_',$count_cls['Field']);
			$fieldidentifiedforcurrentfield=$columnfoundtoprocessarr[1];
			
			if(($count_cls['Field']=='employee_id')&&($countpreviouscolmns>1)){
		//	echo '$'.$count_cls['Field']."=".'$_SESSION'."['".'my_username_id'."'];"."<br>";
			$insertsearch.='
			
			$'.$count_cls['Field']."=".'$_SESSION'."['".'my_username_id'."'];".'
			
			';
			}
			
			else if(($fieldidentifiedforcurrentfield=='id')&&($count_cls['Field']!='employee_id')&&($countpreviouscolmns>1)){
			
			//			echo '$'.$count_cls['Field']."=".'$'."_POST['".$count_cls['Field']."hidden'];"."<br>";
			$lasridname=explode('_',$count_cls['Field']);
						$insertsearch.='
						$'.$count_cls['Field']."=".'$'."_POST['".$count_cls['Field']."hidden'];".'
						';
						
						//$_SESSION["rowFnd'.$columnfoundtoprocessarr[0].'_id"]
					
						//$collectSessionIDsFK.='$_SESSION["rowFnd'.$columnfoundtoprocessarr[0].'_id"]= $'.$count_cls['Field'].';';
						
						
				$collectSessionIDsFK.=	
				'if($_POST["'.$columnfoundtoprocessarr[0].'_idhidden"]'."==''){".'
				$'.$count_cls['Field'].'=$_SESSION["rowFnd'.$count_cls['Field'].'"];
				}else
				{$_SESSION["rowFnd'.$count_cls['Field'].'"]=$'.$count_cls['Field'].';}
				'; 
						//Collect sessions
						
						
						
						
						
						
	/*					$insertsearch.='
$_SESSION["rowFnd'.$count_cls['Field'].'_id"]= '.'$'.$count_cls['Field'].';
'.'
$_SESSION["rowFnd'.$lasridname[0].'_name"]= '.'trim($'."_POST['".$lasridname[0]."_id'])".';
';*/
$lasridname='';
						}
			else{
				//echo '$'.$count_cls['Field']."=".'$'."_POST['".$count_cls['Field']."'];"."<br>";
				$insertsearch.='
				$'.$count_cls['Field']."=".'$'."_POST['".$count_cls['Field']."'];".'
				
				';
				}
			
			
			
			
			//echo '$'.$count_cls['Field']."=".'$'."_POST['".$count_cls['Field']."'];"."<br>";
			}
			
	///////////////////	End of post
//print'$insertSQL'."$table_name".' = "INSERT INTO '. $table_name  .' VALUES ( '."<p>'";
$insertsearch.=$collectSessionIDsFK.'
';
$collectSessionIDsFK='';
$insertsearch.='
$insertSQL'."$table_name".' = "INSERT INTO '. $table_name  .' VALUES ( 
'."'";
//end of initialize

			$sqltbcols="Show columns from $table_name";   
			$results_tbc=mysql_query($sqltbcols);
	        $cnt_cols=mysql_num_rows($results_tbc); 
			$numbprocessed='';
			$collecthisfirtst='';
			while($count_cls=mysql_fetch_array($results_tbc)){
			
			
			//echo '$'.$count_cls['Field'];
			
			if($collecthisfirtst==''){
			$primaryiditemsearch=$count_cls['Field'];
			$insertsearch.=" ";
			}else{
			$insertsearch.='$'.$count_cls['Field'];
			}
			
			$collecthisfirtst='Collected first item';
			$numbprocessedComp=$numbprocessed+1;
			
			if ($numbprocessedComp==$cnt_cols){
			
			//echo"')\";<br>";
			//echo '// END of Insert SQL Statement for '.$table_name."<p>";
			$insertsearch.="')\";
			"
			.'
			// END of Insert SQL Statement for '.$table_name."
			";
			}else
			{//echo"','";
			$insertsearch.="','";
			}
			$numbprocessed++;
			
			  $table_col_Namef=$count_cls['Field'];
			  $table_col_Type=$count_cls['Type']; 
			  $table_col_Null=$count_cls['Null'];
	

			} 
	
		

//echo "<p>";		
$lastprknames=explode('_',$primaryiditemsearch);
//echo '$Result1 = mysql_query($insertSQL'.$table_name.') or die(mysql_error());';
$insertsearch.='
$_SESSION["rowFnd'.$lastprknames[0].'_name"]= $'.$lastprknames[0].'_name;'.'
$Result1 = mysql_query($insertSQL'.$table_name.') or die(mysql_error());
';

//sms
if($table_name=='company_employee'){
$insertsearch.='
if (isset($_POST["submit_company_employee"])) {

addcontactdetail($phoneNumber,$employee_name,"Employees");

}';

}
if($table_name=='housing_landlord'){
$insertsearch.='if (isset($_POST["submit_housing_landlord"])) {

addcontactdetail($phoneNumber,$landlord_name,"Landlords");

}';
}
if($table_name=='housing_tenant'){
$insertsearch.='if (isset($_POST["submit_housing_tenant"])) {

addcontactdetail($phoneNumber,$tenant_name,"Tenants");

}';
}

//sms


//update sessions for current items
if($primaryiditemsearch!=''){
$insertsearch.='
$qry="select max('.$primaryiditemsearch.') as '."'LastPrimaryId'".' from  '.$table_name.'";
$rows = mysql_query($qry) or die(mysql_error());

while ($resultId=mysql_fetch_array($rows))
{
$_SESSION["rowFnd'.$primaryiditemsearch.'"]= $resultId['."'LastPrimaryId'".'];
}
';
}
$primaryiditemsearch='';
//end of updating sessions for current fields
//echo'} //End If'."<br>";
$insertsearch.='
} //End If'."<br>";

//echo'} //End function insert

$insertsearch.='
} //End function insert

';
//echo "<p>".'//END  of the Insert process for '.$table_name ."<p><br>";

$insertsearch.='
//END  of the Insert process for '.$table_name .'
';

 
} //end while
} //end if

$sysfunc='./template/functions/insertSQL.php';
file_put_contents($sysfunc,'<?php'.$insertsearch.'?>');
} //end func select tables 
//end of all interts
///End of actuals
?><?PHP 
/*function display_found_search_records($table_name){													
 $sql_available_rcds="select * from admin_controller 
 where tablename='$table_name' order by tablename,detailsvisiblepdf,position "; 
                                             
						$results=mysql_query( $sql_available_rcds);                                          
						$cntreg=mysql_num_rows($results);  
	$cntreg_count=$cntreg;
			if ($cntreg_count>0){
	
	 }		
if ($cntreg>0){ 
$num_found_contacts=$cntreg;
echo("<form name =\"frm$table_name\" action=\"\" method=\"post\"><tr><td class='Stable_td' colspan=\"4\">");
//echo("<hr>");
echo("<h3>$_SESSION[$table_name]</h3></p></td></tr>");
print( "<input type=\"hidden\"   name=\"num_found_controls\" value=\"$num_found_contacts\"> ");                        
echo("<table width='98%' class='Stable_table'> "); 
echo("<tr class='Stable_th'>");
print "<td colspan=\"5\"><hr></td >";
echo("<tr class='Stable_th'>"); 		     
print "<th align=left>Field Caption </td >";
print "<th align=left>List </td >";      
print "<th align=left>PDF</td >";     
print "<th align=left>Position</td >";
print "<th align=left>Width</td >";
echo("</tr>"); 
echo("<tr class='Stable_th'>");
print "<td colspan=\"5\"><hr></td >";
echo("</tr>");
          
			$rec_count=0;
			$emp_count=0;          
			while($count_ctrls=mysql_fetch_array($results)){ 
			$emp_count++;                                  
			 $controller_id=$count_ctrls['controller_id'];
	          $tablename=$count_ctrls['tablename']; 
			  $table_caption=$count_ctrls['tablecaption'];
			  $table_field=$count_ctrls['fieldname'];
			  $table_col_caption=$count_ctrls['fieldcaption'];
			  $table_col_viewdetails=$count_ctrls['detailsvisiblepdf'];
              $table_col_viewonpdf=$count_ctrls['pdfvisible'];
			  $table_col_positionb=$count_ctrls['position'];
	          $table_col_colnwidth=$count_ctrls['colnwidth'];
	//ended		            	
if(isset($emp_count)){
$even_row=$emp_count%2;
}

if($table_col_viewonpdf=='Show'){
$pdfdiso='checked';
$pdfdisVal="Show";
}
if($table_col_viewdetails=='Show'){
$listdiso='checked';
$listdisVal="Show";
}

if($even_row<=0){

print ("<tr class='Stable_even_row'>");
}
if($even_row>0){
	print "<tr class='Stable_non_even_row'>";
	}
	//$listdiso $pdfdiso
echo"
</td><td class='Stable_td'>			  
<input type=\"hidden\"    size=\"30\" name=\"ctrlerfound$rec_count\" value=\"$controller_id\">		  
<input type=\"text\"    size=\"20\" name=\"fieldcaption$rec_count\" value=\"$table_col_caption\">
</td>
<td class='Stable_td'>			  
<input type=\"checkbox\"  $listdiso size=\"20\" name=\"details$rec_count\" value=\"Show\">
</td>
<td class='Stable_td'> 
<input type=\"checkbox\"  $pdfdiso  size=\"20\" name=\"pdf$rec_count\" value=\"Show\">
</td>  
<td class='Stable_td'>
<input type=\"text\"    size=\"3\" name=\"position$rec_count\" value=\"$table_col_positionb\"> 
</td>
<td class='Stable_td'>
<input type=\"text\"    size=\"4\" name=\"colnwidth$rec_count\" value=\"$table_col_colnwidth\"> 
</td>";
print"</tr>";
$rec_count++; 
$listdiso='';
$pdfdiso='';

}
print "<td colspan=\"5\"><p class=\"date\"></td >";
echo("</tr>");
echo("<tr> <td><input type=\"submit\" class=\"savebutton\"    size=\"20\" name=\"ctrupdate$table_name\" value=\"Save\">");
print"</td><tr><td>";
print" </td></tr>";
print" <tr><td><td>";
echo("</table>");



}

echo("</form>");		
}
*/
?><?php
function display_available_admin_assign_options(
$drop_down_name , 
$drop_down_caption,             
$group_tbl  ,                  
$group_name ,                  
$group_id ){
echo("<table class='Stable_table'>");
echo("<tr bgcolor='#483B8D'> <th class='Stable_th' >Group Membership ");
print"<tr><td class='Stable_td'>";
build_db_table_list(           
$drop_down_name , 
$drop_down_caption,             
$group_tbl  ,                  
$group_name ,                  
$group_id                      
);  
print"</td ></tr>";

print"<tr><td >";
print "<P  class=\"date\"></p>";
print"<input  class=\"savebutton\"type=\"submit\"   size=\"6\" name=\"submit_button_$drop_down_name\" value=\"Save Group Members\"> ";
print "<P  class=\"date\"></p>";
print"</td ></tr>";
echo("</table>");
}
?><?php 
function submit_tiled_details_no_addons(
$drop_down_name,
$insert_to_table 
)
{

if (isset($_POST["num_found_contacts"])){
$num_of_employees=$_POST["num_found_contacts"];

if(isset($_POST["submit_button_$drop_down_name"])){
for ($i=1;$i<=$num_of_employees;$i++){

if (isset($_POST["checked_contact_id$i"])){
$emp_details=trim($_POST["checked_contact_id$i"]);
$effective_dt=date('Y-m-d');
$group_id= trim($_POST["$drop_down_name"]);
$dupsFound=-1;
if(strlen($group_id)>0){
$dupsFound=checkDupsGroups($emp_details,$group_id);
}
$insert_details="INSERT INTO `$insert_to_table` 
VALUES ('','$emp_details','$group_id')";
if (($dupsFound<=0)&&(strlen($group_id)>0)){
$results=mysql_query($insert_details);

}

}
}
}
}
}
?><?php
function createAjaxJavaScriptsAllTables(){													
    $sql_available_tables="show tables"; 
    $results=mysql_query( $sql_available_tables);
	$cntreg=mysql_num_rows($results);  

if ($cntreg>0){ 
                        
            while($count=mysql_fetch_array($results)){                                   
			$table_name=$count[0]; 
			$sqltbcols="Show columns from $table_name";   
			$results_tbc=mysql_query($sqltbcols);
	        $cnt_cols=mysql_num_rows($results_tbc); 
			while($count_cls=mysql_fetch_array($results_tbc)){
			  $table_col_Name=$count_cls['Field']; 
			  $table_col_Type=$count_cls['Type']; 
			  $table_col_Null=$count_cls['Null'];
			 //CHECK TO CREATE AJAX
			 
	$table_ajaxchk=explode('_',$table_col_Name);
     $columnhasajaxName=$table_ajaxchk[1];
	if($columnhasajaxName=='name'){
	//echo "I found $cntreg rows";
	//print_ajax_search_box();
	$columnhasajaxNamefoundid=$table_col_Name;
	$columnhasajaxNamefounddecs=$table_ajaxchk[0].'_name';
$AjaxJavascriptString.=ajaxJavascriptor($table_col_Name,$table_name);
echo $AjaxJavascriptString; 
            }
			
			     
			$ajaxcalled='called Ajax';
			$columnhasajaxName='';
	//END OF AJAX
		   //end ajax
			
			} 
  
} //end while

} //end if
return $AjaxJavascriptString;
} //end func select tables   

?><?php
//Start AJAX functions
function ajaxJavascriptor($table_col_Name,$table_name){

$table_folderop=explode('_',$table_name);
$foldername=$table_folderop[0];

$table_colm_idarrax=explode('_',$table_col_Name);
$table_colm_id=$table_colm_idarrax[0].'_id';

$ajaxscript='
function lookup_mylinked'.$table_colm_id.'('.$table_name.$table_colm_id.') {
    if('.$table_name.$table_colm_id.'.length == 0) {
        
		'.
        '
		$('."'".'#'.$table_name.$table_colm_id.'suggestions'."'".').hide();
    } else {
        $.post("'.'../'.$foldername.'/rpc'.$table_name.'.php", {queryString: ""+'.$table_name.$table_colm_id.'+""}, function(data){
            if(data.length >0) {
                $('."'".'#'.$table_name.$table_colm_id.'suggestions'."'".').show();
                $('."'".'#'.$table_name.$table_colm_id.'autoSuggestionsList'."'".').html(data);
            }
        });
    }
} // '. $table_name.'   lookup'.'




function fill_'.$table_name.$table_col_Name.'(thisValue) {
	
    $('."'".'#'.$table_name.$table_col_Name."'".').val(thisValue);
	
	
   $('."'".'#'.$table_name.$table_colm_id.'suggestions'."'".').hide();
}

function fill_hidden'.$table_name.$table_col_Name.'(thisValue) {
	
    $('."'".'#'.$table_name.$table_col_Name.'hidden'."'".').val(thisValue);
	
	
   $('."'".'#'.$table_name.$table_colm_id.'suggestions'."'".').hide();
}

';

return $ajaxscript;
}
//end of Ajax functions

//RPC Page

function createRpcPage($table_col_Name,$table_name){
$table_namearrrs=explode('_',$table_col_Name);
$colmn_name_descriptor=$table_namearrrs[0].'_id';
			
$rpcpage='<?php 


echo "Processed   ".'.'$_SESSION['."'".$table_name."'].".'    $table_col_Name;  
      				


 '.
'include('."'".'../Connections/cf4_HH.php'."'".');
 if(isset($_POST['."'queryString'])) {".'
   			$queryString = trim($_POST["queryString"]); 
   				if(strlen($queryString) >0) {
   					 $query = "SELECT  '. $table_col_Name.' , '.$colmn_name_descriptor. ' FROM  ' .$table_name.' WHERE    '.$table_col_Name.' LIKE '."'".'$queryString%'."'".' order by  '.$table_col_Name.' LIMIT 10 ";
					
   					 $result = mysql_query($query) or die("There is an error in database please contact support@intellibizafrica.com");
     					while($row = mysql_fetch_array($result)){
						
     						echo "<li onClick=\"fill_'.$table_name.$colmn_name_descriptor.
							'('."'".'$row['.$table_col_Name.']'."'); ".
							'fill_hidden'.$table_name.$colmn_name_descriptor.
							'('."'".'$row['.$colmn_name_descriptor.']'."'".')\">'.'$row['.$colmn_name_descriptor.']'. '$row['.$table_col_Name.'] '.'</li>";                                    
							
									}
   }
   }
   
   ?>';
 
 return $rpcpage;
 }  //End of RPC page
   
   //AJax Initiator
   $ajaxInitiator='<?php print_'.$table_name.'_search_print();?>';
   $onkeyupOptn='onkeyup="lookup_'.$table_name.'_'.$table_col_Name.'(this.value);"';
   
   //Ajax form functions 

 


?><?php
//dynamic table
///working list table function
function displayallrecs($datatablelisted,$linkTID,$editpageTo,$viewpageTo,$searchSQLidentifier,
$searchfieldDetails){

//Handling Table properties
$sqlcontrols="select fieldname , tablecaption , pdfvisible , position, colnwidth, fieldcaption from admin_controller where tablename='$datatablelisted' and detailsvisiblepdf='Show' order by position";   
			$results_ctrls=mysql_query($sqlcontrols);
	        $cnt_cols=mysql_num_rows($results_ctrls);
			$countcurrentfield=0; 
			$displayvalues='';
			if($cnt_cols>0){
			while($table_formcontrols=mysql_fetch_array($results_ctrls)){
			$countcurrentfield++;
			  $tablename=$count_ctrls['tablename']; 
			  $table_caption=$count_ctrls['tablecaption'];
			  $table_field=$count_ctrls['fieldname'];
			  $table_col_caption=$count_ctrls['fieldcaption'];
			  $table_col_viewdetails=$count_ctrls['detailsvisiblepdf'];
              $table_col_viewonpdf=$count_ctrls['pdfvisible'];
			  $table_col_positionb=$count_ctrls['position'];
			  $table_col_colnwidth=$count_ctrls['colnwidth'];
              $displayvalues[$countcurrentfield]=$table_formcontrols[0];
			  
			  }}//end of while
			  

//end of table display properties
$currentPage = $_SERVER["PHP_SELF"];
$image1="<img src=\"../template/images/comment.gif\" alt=\"\" />";
$image2="<img src=\"../template/images/timeicon.gif\" alt=\"\" />";
$maxRows_RecordsetSearch = 10;
$pageNum_RecordsetSearch = 0;
if (isset($_GET['pageNum_RecordsetSearch'])) {
  $pageNum_RecordsetSearch = $_GET['pageNum_RecordsetSearch'];
}


if (isset($_POST["seach$datatablelisted"])){

if (isset($_POST["$searchfieldDetails"])){
  $searchfieldDetailsModifier = strtoupper($_POST["$searchfieldDetails"]);
  $searchfieldDetailsModifier='WHERE ucase('.$searchfieldDetails .") Like '%$searchfieldDetailsModifier%'";
}
}


$startRow_RecordsetSearch = $pageNum_RecordsetSearch * $maxRows_RecordsetSearch;
$query_RecordsetSearch = $_SESSION["$searchSQLidentifier"]." $searchfieldDetailsModifier";
$query_limit_RecordsetSearch = sprintf("%s LIMIT %d, %d", $query_RecordsetSearch, $startRow_RecordsetSearch, $maxRows_RecordsetSearch);

$RecordsetSearch = mysql_query($query_limit_RecordsetSearch) or die(mysql_error());
$row_RecordsetSearch = mysql_fetch_array($RecordsetSearch);

if (isset($_GET['totalRows_RecordsetSearch'])) {
  $totalRows_RecordsetSearch = $_GET['totalRows_RecordsetSearch'];
} else {
  $all_RecordsetSearch = mysql_query($query_RecordsetSearch);
  $totalRows_RecordsetSearch = mysql_num_rows($all_RecordsetSearch);
}
$totalPages_RecordsetSearch = ceil($totalRows_RecordsetSearch/$maxRows_RecordsetSearch)-1;

$queryString_RecordsetSearch = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecordsetSearch") == false && 
        stristr($param, "totalRows_RecordsetSearch") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordsetSearch = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordsetSearch = sprintf("&totalRows_RecordsetSearch=%d%s", $totalRows_RecordsetSearch, $queryString_RecordsetSearch);
?>
<form action="" method="post">
  <div align="left">
<table width="400" border="0">
  <tr>
  
    <td><table border="0" width="400" align="left">
	<tr align="left"> <td colspan="4"><h3>Search <?php echo $_SESSION["$datatablelisted"];?></h3></td></tr>
      <tr>
        <th colspan="4"><hr /> </th>
		 <tr>
        <td >&nbsp;</td>
      
            <td >
              <?php  echo  $_SESSION["$datatablelisted$searchfieldDetails"];
			  echo " <input size=\"32\"  type=\"text\" name=\"$searchfieldDetails\" />";?>
             <td > 
              
            <?php  echo " <input class=\"savebutton\" type=\"submit\" name=\"seach$datatablelisted\" value=\"Find\"/>" ;
			?></td>
			
			<tr><td colspan="4"><hr /></td></tr>
          </tr>
		  
		  <tr > <th colspan="2" align="left"><?php echo $_SESSION["$datatablelisted"];?></th>
		  <th align="left">View</th>
		  <th align="left">Edit</th></tr>
		  </tr>
		  <tr><td colspan="4"><hr /></td></tr>
      <?php do { ?>
          
          <tr>
       
		
        <td colspan="2"><?php 
		
		if(isset($row_RecordsetSearch["$field2"])){
		$field2ext=' - '.$row_RecordsetSearch["$field2"];
		} echo $image1;
		foreach($displayvalues as $displayitem){
		echo $row_RecordsetSearch[$displayitem].' ';
		}
		?></td>
        
		
<?php 

//Links
/*print"<td>".$image2;
print"<a href=".$viewpageTo.".php?q=".base64_encode($row_RecordsetSearch["$linkTID"])."\">View</a> ";*/
print " </td>";
$viewpageTo='options';
$datatablelistedArray=explode('_',$datatablelisted);
if($datatablelistedArray[1]!=''){
$tbl_nameLinkFndDetails=$datatablelistedArray[1].'_name';
}
print"<td>".$image2."<a href=".'../statements/'.$viewpageTo.".php?q=";print base64_encode($row_RecordsetSearch["$linkTID"]).'&t='.base64_encode($datatablelisted).'&rt='.base64_encode($row_RecordsetSearch[$tbl_nameLinkFndDetails])." target = \"_blank\">Statement</a></td>";
print"<td>".$image2."<a href=".$editpageTo.".php?q=";print base64_encode($row_RecordsetSearch["$linkTID"]).">Edit</a></td>";			
//print"<td>".$image2."<a href=\"../statements/options.php?q=";print base64_encode($row_RecordsetSearch["$linkTID"]).">Statement</a></td>";
			
echo "</tr>";?>
      </tr>
     
      </tr>
      <?php } while ($row_RecordsetSearch = mysql_fetch_assoc($RecordsetSearch)); ?>
    </table></td></div></td>
  </tr>
  <tr>
    <td height="74">
	
	<p class="date">&nbsp;</p>
	<table border="0" width="20%" align="right">
  <tr>
    <td width="23%" align="center"><?php if ($pageNum_RecordsetSearch > 0) { // Show if not first page
	 ?>
          <a href="<?php printf("%s?pageNum_RecordsetSearch=%d%s", $currentPage, 0, $queryString_RecordsetSearch); ?>"><img src="../template/images/First.gif" border=0></a>
          <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center"><?php if ($pageNum_RecordsetSearch > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_RecordsetSearch=%d%s", $currentPage, max(0, $pageNum_RecordsetSearch - 1), $queryString_RecordsetSearch); ?>"><img src="../template/images/Previous.gif" border=0></a>
          <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_RecordsetSearch < $totalPages_RecordsetSearch) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_RecordsetSearch=%d%s", $currentPage, min($totalPages_RecordsetSearch, $pageNum_RecordsetSearch + 1), $queryString_RecordsetSearch); ?>"><img src="../template/images/Next.gif" border=0></a>
          <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_RecordsetSearch < $totalPages_RecordsetSearch) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_RecordsetSearch=%d%s", $currentPage, $totalPages_RecordsetSearch, $queryString_RecordsetSearch); ?>"><img src="../template/images/Last.gif" border=0></a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table></td>
  </tr>
</table>
<p> Records <?php echo ($startRow_RecordsetSearch + 1) ?> to <?php echo min($startRow_RecordsetSearch + $maxRows_RecordsetSearch, $totalRows_RecordsetSearch) ?> of <?php echo $totalRows_RecordsetSearch ?></p>
</form>

<?php
mysql_free_result($RecordsetSearch);
}
?>
<?php
//end of primary keys
$topmenuDetails['mainTop']="
<a href=\"#\">Home</a>
<a href=\"../company/company_company.php\">company</a>
<a href=\"../admin/admin_user.php\">admin	</a>
<a href=\"../bank/bank_bank.php\">banking</a>
<a href=\"../commission/commission_companyinscommission.php\">commission</a>
<a href=\"../insurance/insurance_insurer.php\">insurance</a>
<a href=\"../housing/housing_tenant.php\">Housing</a>
<a href=\"../comm/comm.php\">Communication</a>
<a href=\"../events/events_event.php\">Events</a>
<a href=\"#\">Reports</a>";
//////////////////////////////////////////////////////////////
 
$submenuIn['mainSub']="All Events </a><img src=\"../template/images/comment.gif\" alt=\"\" /><a href=\"pastevents.php\">Past Events </a> 
<img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a href=\"uevents.php\">Upcoming Events </a>";

$submenuIn['commSub']= "<a href=\"#\">Compose Email </a><img src=\"../template/images/comment.gif\" alt=\"\" /><a href=\"#\">Read Email </a> 
<img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a href=\"#\">Group Email </a>";


$imageL['d1']="<img src=\"../template/images/comment.gif\" alt=\"\" />";
$imageL['d2']="<img src=\"../template/images/timeicon.gif\" alt=\"\"/>";
$imageL['id1']="<img src=\"../template/images/comment.gif\" alt=\"\" />";
$imageL['id2']="<img src=\"../template/images/timeicon.gif\" alt=\"\"/>";

$rightmenu['mainPaged']="<a href=\"../comm/SendINP.php\">Send Message </a><a href=\"../comm/SendToMany.php\">Send SMS to Group </a><a href=\"#\">Read Message </a><a href=\"../comm/contact.php\">New contact </a>
<a href=\"../comm/createGroup.php\">Create Group </a>
<a href=\"#\">Manage Groups </a>
<a href=\"../group/groupTenants.php\">SMS Tenants </a>
<a href=\"../group/groupLandlords.php\">SMS Landlords</a>
<a href=\"../group/groupEmployees.php\">SMS Employees </a>
<a href=\"#\">Handle Exceptions </a>";
?>
<?php
function print_datetime_picker($field_name,$field_caption){
$effective_dt=date("d/m/y : H:i:s", time());
print"
<input name=\"$field_name\" type=\"text\" size=\"32\" id=\"$field_name\"  value=\"$effective_dt\" readonly=\"readonly\"/>
<a href=\"javascript:NewCal('$field_name','yyyymmmdd')\" title=\"click to pick dates\"><img src=\"../template/images/cal.gif\" width= \"16\" height=\"16\" border=\"0\" alt=\"Pick a date\"></a>
";
}

?>
<?php 
//Vital Sessions
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
//Generating vital functions
?>
<?php
function buildInsitialLangDescription($dbinuse){													
    $sql_available_tables="show tables"; 
    $results=mysql_query( $sql_available_tables);
	$cntreg=mysql_num_rows($results);  

if ($cntreg>0){ 
                        
            while($count=mysql_fetch_array($results)){       
			                            
			$table_name=$count[0]; 
			$processedfolderArray=explode('_',$table_name);
			if($processedfolderArray[0]==$processedfolder){
			//do nothing
			}else{
			$processedfolder=$processedfolderArray[0];
			$processedTable=$table_name;
			}
			
		
			//echo $table_name;
			$sqltbcols="Show columns from $table_name"; 
			
			  
			$results_tbc=mysql_query($sqltbcols);
	        $cnt_cols=mysql_num_rows($results_tbc); 
			$positioncnt=0;
$countInserts=0;
			while($count_cls=mysql_fetch_array($results_tbc)){
			  $table_col_Name=$count_cls['Field']; 
			  $table_col_Type=$count_cls['Type']; 
			  $table_col_Null=$count_cls['Null'];
			  $Key=$count_cls['Key'];
			  $isautoincrement=$count_cls['Extra'];
			 //echo $cntreg;
//echo '$_SESSION'."['".$table_name.$table_col_Name."']='".$table_col_Name."'; <br>";

//insert
// Defining Variables for admin_controller Insert SQL Statement
$table_fieldarr=explode('_',$table_col_Name);

foreach($table_fieldarr as $fielditems){
$fieldcaption.=$fielditems.' ';
}
$table_captionsss=explode('_',$table_name);
$groupdisplay=$table_captionsss[0];
foreach($table_captionsss as $tableitems){
$tablecaption.=$tableitems.' ';
}
$countInserts++;
$idportionprocessed=explode('_' , $table_col_Name);
if(($countInserts>1)&&($idportionprocessed[1]=='id')){
//$table_col_Name=$idportionprocessed[0].'_name';
}
$controller_id='';
$tablename=$table_name;

$fieldname=$table_col_Name;
$tablecaption=ucwords($tablecaption);

//retain field names if already defined
if($_SESSION[$tablename.$fieldname]){
$fieldcaption=$_SESSION[$tablename.$fieldname];
}else{
$fieldcaption=ucwords($fieldcaption);
}
$detailsvisiblepdf='Show';
$pdfvisible='Show';
$position=$positioncnt;


//retain field width if already defined
if($_SESSION['fwd'.$tablename.$fieldname]){
$colnwidth=$_SESSION['fwd'.$tablename.$fieldname];
}else{
$colnwidth=20;
}
$groupfolder=$groupdisplay;
if($groupfolder!=$groupfolderProcessedFld){
$defaultgrouptable=$tablename;
}
$groupfolderProcessedFld=$groupfolder;
$displaygroup=ucwords($groupdisplay);
$showgroup='Show';
$displaysubgroup=ucwords($groupdisplay);
$showgroupposition=$positioncnt;
$defaultGroupTable=$processedTable;

$infpos=$positioncnt;
if($positioncnt>0){
$infshow='Show';
}
else{
$infshow='Hide';
}

$caption_position=0;
$control_position=0;
$infwidth=0;
$infhieght=0;
$dataformat=$table_col_Type;
$dispaytype='Normalview';
$required=$table_col_Null;
$screenpostion='defaultpos';
$displaysize=32;
$primarykeyidentifier=$Key;
$accessrights=''; 
$infsubgroup='Nosubgroup';
$infgroup='Nogroup';
$gridwidth=0;

if($_SESSION['uuid'.$tablename.$fieldname]){
$uuid=$_SESSION['uuid'.$tablename.$fieldname];
}
else{
$uuid=gen_uuid();
}


			$created_by=$_SESSION['my_useridloggened'];
			$date_created=date('d-m-Y');

//lllllllllllll
if($previouslyrpossed!=$tablename){
insertPrivilegeInfo($uuid,$tablename);
}
$previouslyrpossed=$tablename;
//-------------
$insertSQLadmin_controller ="
INSERT INTO admin_controller VALUES (
'$controller_id',
'$tablename'
,'$groupfolder'
,'$displaygroup'
,'$displaysubgroup'
,'$infsubgroup'
,'$showgroup'
,'$infgroup'
,'$showgroupposition'
,'$defaultgrouptable'
,'$tablecaption'
,'$fieldname'
,'$gridwidth'
,'$fieldcaption'
,'$detailsvisiblepdf'
,'$pdfvisible'
,'$position'
,'$menuposition'
,'$colnwidth'
,'$dataformat'
,'$dispaytype'
,'$required'
,'$caption_position'
,'$control_position'
,'$infwidth'
,'$infhieght'
,'$infpos'
,'$infshow'
,'$displaysize'
,'$primarykeyidentifier'
,'$isautoincrement',
'$accessrights','$created_by','$date_created','$changed_by','$date_changed','$voided','$voided_by','$date_voided','$uuid')
";





$positioncnt++;
// END of Insert SQL Statement for admin_controller
//echo $insertSQLadmin_controller;
//check duplicate

$sqladmin="Select * from admin_controller where tablename='$tablename' and fieldname='$fieldname' ";   
			$results_adminctrls=mysql_query($sqladmin);
	        $cnt_cols=mysql_num_rows($results_adminctrls); 
			if($cnt_cols>0){
			//echo 'the table exist 88888888888888888s'.$tablename;
			//exit;
			
			}else{
			$Result1 = mysql_query($insertSQLadmin_controller) or die(mysql_error());
			}
				
//end of checking duplicates

$tablecaption='';
$fieldcaption='';
$table_acapts='';
$table_captionsss='';
//end of inserting values
			} 
  
} //end while

//set standard inform

 
 $sqladminStd="Select * from admin_controller where tablename='accounts_invoiceitems' ";   
			$results_adminctrlsStd=mysql_query($sqladminStd);
			$cntls=mysql_num_rows($results_adminctrlsStd); 
			if($cntls>0){
			
			$sqladminEDit="update admin_controller set pdfvisible='Hide' where tablename='accounts_invoiceitems' and fieldname='invoice_id' ";   
			$results_adminctrlsEDit=mysql_query($sqladminEDit);
			
			$sqladminEDit="update admin_controller set pdfvisible='Hide' where tablename='accounts_invoiceitems' and fieldname='tablename' ";   
			$results_adminctrlsEDit=mysql_query($sqladminEDit);
			
					$sqladminEDit="update admin_controller set pdfvisible='Hide' where tablename='accounts_invoiceitems' and fieldname='vat' ";   
			$results_adminctrlsEDit=mysql_query($sqladminEDit);
			
			$sqladminEDit="update admin_controller set pdfvisible='Hide' where tablename='accounts_invoiceitems' and fieldname='enty_type' ";   
			$results_adminctrlsEDit=mysql_query($sqladminEDit);
			
			$sqladminEDit="update admin_controller set fieldcaption='Date' where tablename='accounts_invoiceitems' and fieldname='transaction_date' ";   
			$results_adminctrlsEDit=mysql_query($sqladminEDit);
			
			$sqladminEDit="update admin_controller set fieldcaption='#' where tablename='accounts_invoiceitems' and fieldname='invoiceitems_id' ";   
			$results_adminctrlsEDit=mysql_query($sqladminEDit);
			
			$sqladminEDit="update admin_controller set pdfvisible='Hide' where tablename='accounts_invoiceitems' and fieldname='effective_date' "; 
			$results_adminctrlsEDit=mysql_query($sqladminEDit);
			
			$sqladminEDit="update admin_controller set pdfvisible='Hide' where tablename='accounts_invoiceitems' and fieldname='credit' "; 
			$results_adminctrlsEDit=mysql_query($sqladminEDit);
			
			$sqladminEDit="update admin_controller set pdfvisible='Hide' where tablename='accounts_invoiceitems' and fieldname='debit' "; 
			$results_adminctrlsEDit=mysql_query($sqladminEDit);
			
			$sqlHideMultiplecols="update admin_controller set pdfvisible='Hide',detailsvisiblepdf='Hide', infshow='Hide' where ucase(fieldname ) in ('CREATED_BY','DATE_CREATED','CHANGED_BY','DATE_CHANGED','VOIDED','VOIDED_BY','DATE_VOIDED','UUID','DELETED') "; 
			$results_adminctrlsEDit=mysql_query($sqlHideMultiplecols);
			
			}

 //echo '//************* End of captions for       '.$table_name.'      *******************'."<br>";
} //end if
} //end func select tables   

?>
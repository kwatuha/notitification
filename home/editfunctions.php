<?php
function createAjaxInsterScripts(){
$query_RcdAll_getbody="show tables";
$Rcd_tall_results=mysql_query($query_RcdAll_getbody);
$count_tballfound=mysql_num_rows($Rcd_tall_results);
while($count_tballrows=mysql_fetch_array($Rcd_tall_results)){
$activetableBody=$count_tballrows[0];
echo $activetableBody.'<br>';
 /////
$query_Rcd_getbody= "SELECT distinct tablename,fieldname,fieldcaption,fieldcaption,dataformat,dispaytype,
required,screenpostion FROM admin_controller where ucase(tablename)='$activetableBody'";
//echo $query_Rcd_getmenus;
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
$countrows=0;
$postdatainsert="''";
$count_tbrowsfound=mysql_num_rows($Rcd_tbody_results);


while($count_tbrows=mysql_fetch_array($Rcd_tbody_results)){
$countrows++;
$postdatainsert.=$count_tbrows['fieldname'];



if($countrows==1){
$postdata="'".$count_tbrows['fieldname']."='+".$count_tbrows['fieldname'].'.value';

$javascriptVarFunc='
function save'.$activetableBody.'DetailsInfo(activetable,recordid,actionitem,msg){
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
var '. $count_tbrows['fieldname'].'=document.getElementById('."'".$count_tbrows['fieldname']."')".';';
}else{
$postdata.="+'&".$count_tbrows['fieldname']."='+".$count_tbrows['fieldname'].'.value';

$javascriptVarind2.='
var '. $count_tbrows['fieldname'].'=document.getElementById('."'".$count_tbrows['fieldname']."')".';';

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

xmlHttp.open("GET","http://localhost:8080/clockplus/home/bodysave.php?t="+'."activetable"."+'&act='+actionitem".'+'."'&q='+recordid"."+".$postdata.',true);'.'
xmlHttp.send(null);'.'
}'.'

'.'


'.'
';

}

}

?>
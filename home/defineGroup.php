<?php
restrictaccess();
function restrictaccess(){
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
}
require_once('../Connections/cf4_HH.php');
?>
<head><?php
include('../template/functions/menuLinks.php');
include('../template/functions/insertSQL.php');
include('../template/functions/folderlinks.php');
include('../template/functions/searchSQL.php');
include('../template/functions/updateSQL.php');



function getITemsToinsert($activetablelinked){
$activetablelinked=trim($activetablelinked);
 $SQlGroup="show columns from $activetablelinked ";
            $results_essQrp=mysql_query($SQlGroup);
	        $cntGrp=mysql_num_rows($results_essQrp);
			
			if($cntGrp>0){
			$colpos=0;
			while($table_grp=mysql_fetch_array($results_essQrp)){
			$colpos++;
			  $tablefield=$table_grp['Field']; 
			  $ess_view='Show';
              $ess_position=$colpos;
			  $tablename=$_POST["mytable"];
			  $usergroup_id=$_POST["mygroup"];
			  $tablecaption=$_SESSION[$activetablelinked];

				$insertSQLTrole = "INSERT INTO admin_tablerole VALUES ( 
				' ','$tablename','$tablecaption','$tablefield','$usergroup_id','$ess_view','$ess_position')";
				
				if(($usergroup_id!='')&&($tablename!='')){
				
				$Result1 = mysql_query($insertSQLTrole) or die(mysql_error());
				}
				
	}
  }

}
if (isset($_POST["SubmitGroup"])) {

if(isset($_POST['mytable'])){
		$activetablelinked=$_POST['mytable'];
		if(isset($_POST['mygroup'])){
		$usergroup_id=$_POST['mygroup'];
		if(($usergroup_id!='')&&($activetablelinked!='')){
		
		      getITemsToinsert($activetablelinked);
		}
		}

}

}
?>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="../template/images/style.css" />
	<link rel="stylesheet" href="../template/images/dtpicker.css" type="text/css" />
<script language="JavaScript" src="../template/js/calendarDateInput.js"></script>
<script language="JavaScript" src="../template/js/dtpicker.js"></script>


<link type="text/css" href="../viewdesign/css/custom-theme/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="../viewdesign/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="../viewdesign/js/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript">
			$(function(){

				// Accordion
				$("#accordion").accordion({ header: "h3" });
	
				// Tabs
				$('#tabs').tabs();
				$('#tabs2').tabs();
	
	// Options
				//$('#options_tab').options();
				
//hover states on the static widgets
				$('#dialog_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); }, 
					function() { $(this).removeClass('ui-state-hover'); }
				);
				
			});
		</script>
		
		
	<script>	
		
		$(document).ready(function() {
				/* Add a click handler to the rows - this could be used as a callback */
				$('#example tr').click( function() {
					if ( $(this).hasClass('row_selected') )
						$(this).removeClass('row_selected');
					else
						$(this).addClass('row_selected');
				} );
				
				/* Init the table */
				var oTable = $('#example').dataTable( );
			} );
			
			/*
			 * I don't actually use this here, but it is provided as it might be useful and demonstrates
			 * getting the TR nodes from DataTables
			 */
			function fnGetSelected( oTableLocal )
			{
			    //var oTable = $('#oTableLocal').dataTable( );
				var aReturn = new Array();
				var aTrs = oTableLocal.fnGetNodes();
				
				for ( var i=0 ; i<aTrs.length ; i++ )
				{
					if ( $(aTrs[i]).hasClass('row_selected') )
					{
						aReturn.push( aTrs[i] );
					}
				}
				divto=document.getElementById('selecteddata');
	            divto.innerHTML=myarray;
				alert('It is workin d');
				return aReturn;
			}
			
		</script>
		<script type="text/javascript">
<!--//---------------------------------+
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use
// --------------------------------->
$(document).ready(function()
{
	//slides the element with class "menu_body" when paragraph with class "menu_head" is clicked 
	$("#firstpane p.menu_head").click(function()
    {
		$(this).css({backgroundImage:"url(images/down.png)"}).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
       	$(this).siblings().css({backgroundImage:"url(images/left.png)"});
	});
	//slides the element with class "menu_body" when mouse is over the paragraph
	$("#secondpane p.menu_head").mouseover(function()
    {
	     $(this).css({backgroundImage:"url(images/down.png)"}).next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
         $(this).siblings().css({backgroundImage:"url(images/left.png)"});
	});
});
</script>





<title>Clocking System</title>
<style type="text/css">
<!--
.style2 {
	color: #003300;
	font-weight: bold;
}
.style3 {color: #3C6491}</style>
<link href="../template/themes/Smart/css/style.css" rel="stylesheet" type="text/css" media="screen" />
</head><body>
<div id="header"><div id="logo"><p class="slogan"></p><div style="float: left;">
</div></div><div id="hmenu"></div></div><div class="content"><div id="articles"><div id="left_pannel">
</div></div>
<div id="hmenu"><p></div></div><div class="content">
.<p>.&nbsp;
.<br>.&nbsp;
<div id="articles"><div id="left_pannel">


<div id="tabs">
<ul>
<li><table><tr><td><b> <?php  $tbl=base64_decode($_GET['token']);
echo $_Session[$tbl]. 'Details';
?>
</b></td></tr></table></li>
</ul>
<div id="tabs-1"> 
<tr>
      
      <td colspan="2"><p align="center">&nbsp;</p>
      </td>
    </tr>
<div id="container">
<div class="full_width big">
<div id="options_tab"><p><a href="../leave/leave_leave.php" > Add </a> |<a href="#" >  Statement </a>| 
<a href="../leave/leave_leave_options.php"> Options </a> | <a href="../leave/leave_leave_pdf.php"> PDF </a> | <a href="../home/view.php?token=bGVhdmVfbGVhdmU=&&r=RVNT" > View </a> | </p></div></div><div id="tablecontentdetails"></div><div id="demo"><table width="100%" border="0"><tr><td><td><div align="right">
<?php $found_recordset = "-1";
$sub_cption="Save";
$btnprec="submit_";
if (isset($_GET['q'])) {
  $colname_to_name =base64_decode($_GET['q']);
  $query_recs = $_SESSION["leave_leave_SearchSQL"]." WHERE leave_id = $colname_to_name";

$sub_cption="Update";
$btnprec="update_";
$found_recordset = mysql_query($query_recs) or die(mysql_error());
$row_found_recordset = mysql_fetch_array($found_recordset);
$totalRows_recordRetrievePayment = mysql_num_rows($found_recordset);
}

 //end of building recordsets <br?>
			<br /><p><?php echo "<a href=\"../home/view.php?token=bGVhdmVfbGVhdmU=\"> View/Edit" .$_SESSION["leave_leave"]." </a><img src=\"../template/images/comment.gif\" alt=\"\" />
<img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a  href=\"../leave/leave_leave_pdf.php\"/>View PDF </a><img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a href=\"../leave/leave_leave_options.php\"/>Options </a></p>'"; ?><form name ="frmleave_leave" action="" method="post"><div align="left"><h3><?php echo $_SESSION["leave_leave"]; ?></h3><hr></p>
  
  <table width="400" border="0">
    <tr><td></td><td>
	<input type="hidden"  size="32"onkeyup=" lookup_pim_employee(this.value);" id="leave_id" name="leave_id"value="<?php echo $_SESSION["rowFndleave_name"] ?>"><?php

//********** Starting  Insert Statements  Tableadmin_usergrouprole***********************


//initialize admin_usergrouprole



/*function Insert_admin_usergrouprole_Stmt  (){

if (isset($_POST["SubmitGroup"])) {

 
			// Defining Variables for admin_usergrouprole Insert SQL Statement 
			
				/*$usergrouprole_id=$_POST['usergrouprole_id'];
				$usergroup_id=$_POST['usergroup_idhidden'];
				$tablename=$_POST['tablename'];
				$previge=$_POST['previge'];
				$start_date=$_POST['start_date'];
				$end_date=$_POST['end_date'];
				$effective_dt=$_POST['effective_dt'];
				
				if($_POST["usergroup_idhidden"]==''){
				$usergroup_id=$_SESSION["rowFndusergroup_id"];
				}else
				{$_SESSION["rowFndusergroup_id"]=$usergroup_id;}
				
$postValue=getITemsToinsert($activetablelinked);
$insertSQLadmin_usergrouprole = "INSERT INTO admin_usergrouprole VALUES ( 
' ','$postValue["usergroup_id"]','$postValue["tablename"]','$postValue["previge"]','$postValue["start_date"]','$postValue["end_date"]','$postValue["effective_d"]')";
			
			// END of Insert SQL Statement for admin_usergrouprole
			
$_SESSION["rowFndusergrouprole_name"]= $usergrouprole_name;
$Result1 = mysql_query($insertSQLadmin_usergrouprole) or die(mysql_error());

$qry="select max(usergrouprole_id) as 'LastPrimaryId' from  admin_usergrouprole";
$rows = mysql_query($qry) or die(mysql_error());

while ($resultId=mysql_fetch_array($rows))
{
$_SESSION["rowFndusergrouprole_id"]= $resultId['LastPrimaryId'];
}

} //End If<br>
} //End function insert*/


//END  of the Insert process for admin_usergrouprole*/
	
	?><input type="hidden"  size="32" id="leave_idhidden" name="leave_idhidden"value="<?php echo $_SESSION["rowFndleave_id"]; ?>"></td></tr>
	<tr><td>&nbsp;</td><td><?php build_db_usergroup(); ?> 
	</td></tr>
	<tr><td>&nbsp;</td><td>
	<?php build_db_allTables(); ?></td></tr>
	<tr>
    <td colspan="2"><P  class=\"date\"></p></td></tr><tr>
    <td colspan="2"><input type="submit" class="resetbutton" name="SubmitGroup" id="SubmitGroup"value="<?php echo trim($sub_cption); ?>">
&nbsp;<input type="reset" class="resetbutton"id="rstgroup" name="rstgroup" value="Cancel ">


</td>
<tr>
    <td colspan="2">&nbsp;</p></td></tr>

</table><hr><td><?php print_ajax_search_box();?></td></div></div></form></div>
</div> 
</div>
</p> </div></td></td></tr></table></div>
			
	</div></table></div><div >
</div></div></div></div><div id="additional"><p></p></div><div id="whiteline"></div>
</body>	
</html>
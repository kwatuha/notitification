<?php
restrictaccessMenu();
function restrictaccessMenu(){
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";
// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized_menu($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assumiaccng the visitor is NOT authorized. 
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
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized_menu("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
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
require_once('../PHPMailer/class.phpmailer.php');
///sms
include('../template/functions/menuLinks.php');
?><?php
$isapproved=$_POST['filterapproved'];
$primarytable=$_POST['primarytable'];
$showashidden='inddefinition_id,query_code';//$_POST['showashidden'];
$showcols='report_caption';//$_POST['showcols'];
$pkey=$_POST['pkey'];


//$primarytable='admin_person';
//$showcols='person_fullname';
//$showashidden='pin,gender,dob,person_id';
$primarykey=$_POST['primarykey'];
$displytype=$_POST['displytype'];
$rptroles=$_POST['rptroles'];
$displytype='tbl';
$dtable=$primarytable;

$showcolArrays=explode(',',$showcols);
$hidecolArrays=explode(',',$showashidden);
$actableArray=explode('_',$primarytable);
$primarytableColumn=$actableArray[1].'_id';
//$mainmenuitems=createTopDyanamicMenu($dtable,$rptroles);
//$gridproperty=createDynamicGridbySQL($showcolArrays,$hidecolArrays);

$gridproperty=createDynamicReportGridbySQL($pkey);
$gridmodel=$gridproperty['model'];
$gridcols=$gridproperty['gridcols'];
$selcols=$gridproperty['selcols'];
$sql=$gridproperty['query_code'];



$gridcolsRprtview=$gridcols;
$gridmodelrptview=$gridmodel;


//echo $mainmenuitems;
echo "function createIDVrpt(){
var  viewgrbtnhousing_housinglandlord = Ext.get('gridViewhousing_housinglandlord');	
     Ext.define('ReportViewModel', {
    extend: 'Ext.data.Model',
	fields:[$gridmodelrptview]
			
	});
	
	var rptviewstore = Ext.create('Ext.data.Store', {
    model: 'ReportViewModel',
	
	
    proxy: {
        type: 'ajax',
		url : 'buidgrid.php?dysqlrpt=1&dtt=$sql',
        reader: {
            type: 'json'
        }
    }
});
  rptviewstore.load();
  
  ;
  var divobj=document.getElementById('dynamicviewdetailinfo');
  divobj.innerHTML='';
var gridrpt = Ext.create('Ext.grid.Panel', {
						  
        store: rptviewstore,
		renderTo:'dynamicviewdetailinfo',
		
		margins    : '0 0 0 3',
		listeners : {
		itemdblclick:function(dv, record, item, index, e){
		//showEmployeePersonAccts();
		},
    itemclick: function(dv, record, item, index, e) {
	     
	
		}}
	   ,
        stateful: true,
		multiSelect: true,
		iconCls: 'icon-grid',
        stateId: 'stateGrid',
		animCollapse:false,
        constrainHeader:true,
        layout: 'fit',
		columnLines: true,
		bbar:{height: 20},
		columns:[
		new Ext.grid.RowNumberer(),$gridcols,
				 {
                menuDisabled: true,
                sortable: false,
                xtype: 'actioncolumn',
                width: 30,
                items: [
				  {
                    icon   : '../shared/icons/fam/report-paper.png',
                    tooltip: 'Contract ',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
                        var accaccount_name=rec.get('accaccount_name');
						 var accaccount_id=rec.get('accaccount_id');
						  var person_fullname=rec.get('person_fullname');
						   var person_id=rec.get('person_id');
						   var insurancedebitnote_id=rec.get('insurancedebitnote_id');
						    var tid='';
		insuredStatement(tid,person_id,person_fullname,accaccount_name,insurancedebitnote_id,accaccount_id,57);
                    }
                }]
            }
        ]
		
		,width: 800,
		maxHeight: 490,
        maxWidth: 1000,
		margin:'0 0 0 10',
        title: 'Report Details',
		autoScroll:true,
       // region: 'center',
        viewConfig: {
            stripeRows: true,
           // enableTextSelection: true,
			listeners: {
                itemcontextmenu: function(view, rec, node, index, e) {
                    e.stopEvent();
                    contextMenu.showAt(e.getXY());
                    return false;
                }
            }
		}

	
    });


}
createIDVrpt()";

?>
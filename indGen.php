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

$MM_restrictGoTo = "index.php";
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
?>
<?php
			
$part_default='./template/functions/'.'default.php';
//$part_default = file_get_contents($part_default); 
require_once('template/functions/core.php'); 
require_once('template/functions/menulinks.php');
require_once('Connections/cf4_HH.php');
require_once('PHPMailer/class.phpmailer.php');
require_once('template/functions/tablefieldtypes.php');

//core functions


//general Design
               	//removeEffectiveDateColumn('formdb');
				//updateInsuredDB();
				//////////////////////////////////
				
			//
      
        
      
      
        createDefaultTableFields();
				buildInsitialLangDescription($dbinuse);
				$cmbsearch=buildSearchFunctionsV2();
				createTableDisplayCaptions();
				updateStdFields();
        setDefaultVoidedALL();
				echo $_SESSION['voideindb'];
		    // setDefaultVoided($_SESSION['voideindb']);
				/*$var=fillAutoFillController('admin_person','person_name');
			echo($var['filval']);*/
				/*$tablename='admin_person';
				$md=getSingleGroupItems($tablename);
				echo $md;*/
				
			/*	$res=getDynamicFunction('admin_role');
				$fn=$res['custfunc_name'];
			 eval($fn;);*/
		/*$ecd=getPrefferedEmailSender();
		$emailusername=trim($ecd['email_address']);
				$emailpassword=trim($ecd['password']);
				
				$from='kwatuha@yahoo.com';
				$prefferedemail='kwatuha@gmail.com';
				$from_name='Intellibiz Africa dev';
				$subject='System testtin';
				$body='Wonderful people in dev team';
				$emailresult=smtpmailer($prefferedemail, $from, $from_name, $subject, $body,$emailusername,$emailpassword);
				
				//echo $emailresult;
		exit;		
echo $_SESSION['uuid'.'payment_receivablepayment'.'receivablepayment_id'];
*/
$olde="<br />
0ae1e9fd-12fc-49b5-9c0f-139560528dc7";

echo $olde;
/*$primaryselector='de5095c1-ef84-47a0-9846-c93d92c3be62';
$primarytable='admin_person';
$datafn=fillPrimaryData($primarytable,$primaryselector);
*/
//removeEffectiveDateColumn('intellib_zulm');

//End of core

/*createAjaxInsterScripts();
createDisplayGroupOptionScripts();
createModalScripts();
buildAjaxSearchQriesMainfile();*/

/*createAjaxOptionsScripts();
createTableDisplayCaptions();*/

//createAjaxInsterScripts();
//buildPHPfiles($dbinuse);
//$cmbsearch=buildSearchFunctionsV2();


/*buildInsitialLangDescription($dbinuse);
buildlangfileRSVTb_links('db');
buildlangfileRSVInsertsPlus($dbinuse);
generateUpdateStmsts($dbinuse);				 
buildPHPfiles($dbinuse); 
    */
	
	
 WriteGridColums(40);
function WriteGridColums($limit){

//$alltbales=getAllTables();

//$headerfields=getHeaderDetails($activetableBody);

$jsGridInfo='template/functions/gridColumns.js';

///////////////////

$gridcolumnsReviesed=createRange($limit);

$gridcolumnsReviesedFinalStr='';
for ($k=1;$k<=$limit;$k++){
$range=$limit-$k;
$gridcolumnsReviesed=createRange($range);



//gen functions
$actionfncs='// Grid functions
'.",{
                menuDisabled: true,
                sortable: false,
                xtype: 'actioncolumn',
                width: 50,
                items: [{
                    icon   : '../shared/icons/fam/delete.gif',  
                    tooltip: 'Sell stock',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
                        alert(\"Sell \" + rec.get('alert_name'));
                    }
                }".$plaincomma." {
                    getClass: function(v, meta, rec) {          
                        if (rec.get('alert_name') < 0) {
                            this.items[1].tooltip = 'Hold stock';
                            return 'alert-col';
                        } else {
                            this.items[1].tooltip = 'Buy stock';
                            return 'buy-col';
                        }
                    },
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
                        alert((rec.get('alert_id') < 0 ? \"Hold \" : \"Buy \") + rec.get('alert_name'));
                    }
                }]
            }";
//end gen functions
$varinfo='if (displaycolums=='.$range.'){
var gridcolums=['.$gridcolumnsReviesed.'

'.$actionfncs.'
];
}
';
$gridcolumnsReviesedFinalStr.=$varinfo;

}

file_put_contents($jsGridInfo,'
funtion selectGridColums(displaycolums){
'.$gridcolumnsReviesedFinalStr.'

return gridcolums;
}');
}

function createRange($limit){
for($i=0;$i<$limit;$i++){

				if($item==0){
						 $plaincomma=',';
						 }
					$enditem=$limit-1;	 
				if($item==$enditem){
						 $plaincomma='';
						 }
						 $item++;
						 
				if($item==2){
						$gridcolumnsReviesed.='{
						' ."text     : textArray[".$i."] , 
						 flex     : 1 , 
						 sortable : true , 
						 dataIndex : dataIndexArray[". $i.']
						 }'.$plaincomma.'
						 ';
					}	
						 
				else{ 
				 $gridcolumnsReviesed.='{
						' ."text     : textArray[".$i."] , 
						 width    : columnWidthArray[".$i."] , 
						 sortable : true , 
						 dataIndex : dataIndexArray[". $i.']
						 }'.$plaincomma.'
						 ';
						 }
		 
}

return $gridcolumnsReviesed;
}  






/////////////////////////////////////
/*$_SESSION["admin_contactdetails_SearchSQL"]="
						
						select admin_contactdetails.contactdetails_id , admin_contact.contact_id , admin_contact.contact_name , admin_contactdetails.syowner , admin_contactdetails.syownerid , admin_contactdetails.preferred , admin_contactdetails.comment , admin_contactdetails.created_by , admin_contactdetails.date_created , admin_contactdetails.changed_by , admin_contactdetails.date_changed , admin_contactdetails.voided , admin_contactdetails.voided_by , admin_contactdetails.date_voided , admin_contactdetails.uuid  from admin_contactdetails  inner join admin_contact on admin_contact.contact_id = admin_contactdetails.contact_id
						
						";*/
						
$sqlvdym=reviseSQLToDynamic('payment_receivablepayment','admin_person','syownerid','');



//echo $sqlvdym;

?>

<script>
var textArray=new Array();
var columnWidthArray=new Array();
var dataIndexArray=new Array();
var stblInfo="8|###|alertactivity_id|Num |75||alert_name|Task|75||activitystatus_name|Activity|75||alert_success|Success Action|75||alert_success_caption|Activity Caption |75||is_active_status|Is Active|75||status_after_action|Status to|75||mark_task_completion|Mark Task Completion |75||";

createJavascriptDataArray(stblInfo);
function createJavascriptDataArray(stblInfo){
var fieldcountArr=stblInfo.split('|###|');
var actualfieldsArr=fieldcountArr[1].split('||');
var fiedlen=fieldcountArr[0];
		for(i=0;i<fiedlen;i++){
		var indcolumArr=actualfieldsArr[i].split('|');
		textArray[i]=indcolumArr[0];
		columnWidthArray[i]=indcolumArr[1];
		dataIndexArray[i]=indcolumArr[2];
		}
		
		
 
}
//alert(textArray[0]+columnWidthArray[0]+dataIndexArray[0]);
alert( 'Configuration Completed');

</script>

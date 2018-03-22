<?php
restrictaccessMenu_mlkns();
function restrictaccessMenu_mlkns(){
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized_menu_fmks($strUsers, $strGroups, $UserName, $UserGroup) {
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
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized_menu_fmks("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {
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
include('../template/functions/menuLinks.php');

function createAllGridFunctions(){
$allscripts='';
$query_Rcd_getbody= "SELECT distinct table_name FROM admin_table ";
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
$gridinfo='';
while ($rows=mysql_fetch_array($Rcd_tbody_results)){
$table_name=$rows['table_name'];

$allscripts.=createGRIDdetails($table_name,$dynaictable,$dyamicolmn);
}

return $allscripts;
}

function createGRIDdetails($activetableBody,$dynaictable,$dyamicolmn){
$prarr=explode('_',$activetableBody);
$crntprtbcln=$prarr[1].'_id';

$dymanicARR=explode('_',$dynaictable);
$headerfields=getHeaderDetails($activetableBody);
$columns='';
 $item='';
 $gridcolumnsReviesed='';
 $gridinfo='';
$ctncolms=sizeof($headerfields);
if($headerfields){
$item=0;

      foreach ($headerfields as $fielddata){
	      $fieldgridcptn=$_SESSION[$activetableBody.$fielddata];
		 if(strtoupper($fielddata)==strtoupper($dyamicolmn)){
		 $fielddata=$dymanicARR[1].'_id';
		$myna=$dymanicARR[1].'_name';
		  $fieldgridcptn=$_SESSION[$dynaictable.$myna];
		 }

	      if($item==0){
		 $addstartbrace='[';
		 }
	     $item++;

		 if( $item==$ctncolms){
		 $comma="";
		 $plaincomma=',';
		 }

		 else{
		 $comma=",";
		 $plaincomma=',';
		}

		 //$_SESSION['gridwidth'.$activetableBody]
		 if(( $item==2)&&($item>0)){
		 $width='flex : 1';
		 }else{
		 $width='width : 105';
		 }
         if($fielddata=='amount'){
           $width='width : 105';
         }

         if($fielddata=='message'){
           $width='width : 600';
         }

          if($fielddata=='proposed_message'){
           $width='width : 400';
         }
         if($fielddata=='person_name'){
           $width='width : 120';
         }
         if($fielddata=='schedulegeneralsms_name'){
           $width='width : 200';
         }
         if($fielddata=='schedule_name'){
           $width='width : 300';
         }
         if($fielddata=='phone_number'){
           $width='width : 100';
         }

         if($fielddata=='connection_number'){
           $width='width : 110';
         }
         if($fielddata=='file_brouwse'){
           $width='width : 200';
         }
		 $vartcol=explode('_',$activetableBody);
		 $varcol=explode('_',$fielddata);
		 $tc=$vartcol[1].'_id';
		 $fc=$varcol[0].'_id';
		 $fcntfielddata=$fielddata;
		 if(($varcol[1]=='id')&&($tc!= $fc)){
		 $fielddata=$varcol[0].'_name';
		 }

		 $gridfieldtype='';
		 if(($fielddata=='amount')||($fielddata=='policy_value')||($fielddata=='amount_insured'))
		 $gridfieldtype=", type:'int'";
         if($fielddata=='amount' &&  ($activetableBody=='sms_processedsms' ||  $activetableBody=='sms_billhandle')){
             $gridfieldtype='';
         }
		 $columns.= "{name:'".$fielddata."'".$gridfieldtype.'}'.$comma;

		$hidethiscolumn='';
		if($fielddata=='syowner'){
		if($activetableBody=='housing_housingtenant'||$activetableBody=='housing_housinglandlord'){
		//do nothing
		}else{
		//hide this column
		$hidethiscolumn="hidden:true,";
		}
		}
		//adding summary inf
		$summaryfieldinfo='';
		if((($activetableBody=='accounts_accountactivity')&&($fielddata=='amount'))
		||(($activetableBody=='insurance_insurancedebitnote')&&($fielddata=='policy_value'))
		||(($activetableBody=='insurance_insurancedebitnote')&&($fielddata=='amount_insured'))){
		$summaryfieldinfo="
		  summaryType: 'sum',
            renderer: function(value, metaData, record, rowIdx, colIdx, store, view){
			var cvaluenew=value;
                return cvaluenew ;
            },
            summaryRenderer: function(value, summaryData, dataIndex) {
                return 'Ksh:' + value ;
            },
            field: {
                   xtype: 'numberfield'
            },";
		}
		//end of summary
		//underwriter summary

		//end of underwrite

		if($fielddata!=$crntprtbcln){
				 $gridcolumnsReviesed.='{
				' ."header     : ' ".trim($fieldgridcptn)." ' ,
				 $width ,
				 $summaryfieldinfo
                 $useWordrap
				 sortable : true ,".
				 $hidethiscolumn
				  ."
				 dataIndex : '". $fielddata."'".'/*,
				 filterable: true*/
				 }'.$plaincomma.'
				 ';
		 }

		}

}




//define action functions
$actionfncs=",{
                menuDisabled: true,
                sortable: false,
                xtype: 'actioncolumn',
                width: 50,
                items: [{
                    icon   : '../shared/icons/fam/delete.gif',
                    tooltip: 'Sell stock',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
                       // alert(\"Sell kwwas \" + rec.get('alert_name'));
                    }
                }".$plaincomma." {
                    getClass: function(v, meta, rec) {
                        if (rec.get('alert_name') < 0) {
                            this.items[1].tooltip = 'Hold stock';
                            return 'alert-col';
                        } else {
                            this.items[1].tooltip = 'Buy stock ky';
                            return 'buy-col';
                        }
                    },
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
                       // alert((rec.get('alert_id') < 0 ? \"Hold \" : \"Buy \") + rec.get('alert_name'));
                    }
                }]
            }";

///Action functions ends

$gridtitle=$_SESSION['stm'.$activetableBody];
if($dynaictable){
$gridtitle=$gridtitle.'->'.$_SESSION['stm'.$dynaictable];
}
$gridcolumns=$addstartbrace.$gridcolumns.$actionfncs;
$columnModel=$columns;


$manageInfo='{
                    icon   : \'../shared/icons/fam/cog.gif\',
                    tooltip: \'action \',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
                        var ccrecordid=rec.get('."'".$tc."'".');
						//alert(ccrecordid+":There was an error");
						//createFormTabs('."'loadtype'".",ccrecordid,'".$activetableBody."'".');
                    }
                },';

				$contractinfo='';
				if(($activetableBody=='housing_housingtenant')||($activetableBody=='housing_housinglandlord')
				||($activetableBody=='medicallab_histology')||($activetableBody=='medicallab_labresult')){
				$contractinfo='{
                    icon   : \'../shared/icons/fam/report-paper.png\',
                    tooltip: \'Contract \',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
                        var ccrecordid=rec.get('."'".$tc."'".');
						var tcrtb="'.$activetableBody.'";
						if(tcrtb=="housing_housinglandlord")
						OpenlandlordContract(ccrecordid);

						if(tcrtb=="housing_housingtenant")
						OpenTenantContract(ccrecordid);

							if(tcrtb=="medicallab_histology")
						OpenMyhistology(ccrecordid);
							if(tcrtb=="medicallab_labresult")
						OpenCytology(ccrecordid);
						//alert(ccrecordid+":There was an error");
						//createFormTabs('."'loadtype'".",ccrecordid,'".$activetableBody."'".');
                    }
                },';
				$feedbackfo='';
				if($activetableBody=='housing_housingtenant')
				$feedbackfo='{
                    icon   : \'../shared/icons/fam/feedback.png\',
                    tooltip: \'Notify \',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
                        var ccrecordid=rec.get('."'".$tc."'".');
						OpenTenantNotification(ccrecordid);



						//alert(ccrecordid+":There was an error");
						//createFormTabs('."'loadtype'".",ccrecordid,'".$activetableBody."'".');
                    }
                },';
				}
				$hasview='';
				$contextmenus='';
				$hasview=getPrimaryTableView($activetableBody);
		if(!$hasview){
		$manageInfo='';
		}
		if($hasview_Disabled){
		$contextmenus=getTableContextMenus($activetableBody);
		$ctxmenuitem='';
		$ctxmenuitemcallInitial='buyAction,sellAction';
		$ctxcnt=0;
		$enablemenu='';
        $disalemenuitem='';


		foreach( $contextmenus as $ctxitem){
		$ctx=explode('|',$ctxitem);
		$ctxcnt++;

		if($ctxcnt==sizeof($contextmenus)){
		$ctxxomma='';
		}else{
		$ctxxomma=',';
		}
		$xtctnmenus='';
		$xtctnmenus=sizeof($contextmenus);
		$initialcomma='';
		if($xtctnmenus){
		$initialcomma=',';

		$ctxmenuitemcall.='itemAction'.$ctx[0].$ctxxomma;
		$enablemenu.='itemAction'.$ctx[0].".enable();";
		$disalemenuitem.='itemAction'.$ctx[0].".disable();";

		}else{
		$ctxmenuitemcall='';
		}

		$ctxmenuitemcall=$ctxmenuitemcallInitial.$initialcomma.$ctxmenuitemcall;
		$ctxmenuitem.="
		var "."itemAction".$ctx[0]." = Ext.create('Ext.Action', {
        iconCls: 'user-girl',
        text: '$ctx[1]',
        disabled: true,
        handler: function(widget, event) {
            var rec = grid.getSelectionModel().getSelection()[0];
            if (rec) {
			   var ccrecordid=rec.get('".$tc."');
			   var ctableval='$activetableBody';

				if(ctableval=='admin_role'){
				createCheRolePrivileges('Admin',ccrecordid);
				}else{
				createFormTabs('Save',$ctx[0],'$activetableBody',ccrecordid);
				//alert('There was an error');

				}


            } else {
              //  alert('Please select a $ctx[1] from the grid');
            }
        }
    });";



		}

		}


$actionDetails='{
                menuDisabled: true,
                sortable: false,
                xtype: \'actioncolumn\',
                width: 80,
                items: [
				  '.$contractinfo.$manageInfo.$feedbackfo.'{
                    icon   : \'../shared/icons/fam/delete.gif\',
                    tooltip: \'Delete \',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
						var tblnow="'.$activetableBody.'";
						var msgboxmsg=\'Are you sure you want to delete this record?\';
						var msgtitle=\'Delete Record?\';
                       var ridtr=rec.get(\''.$tc.'\');
						//deleteRecord(\''.$activetableBody.'\',ridtr,store);
						deleteRecordOnconfirmation(\''.$activetableBody.'\',ridtr,store);
						 onMouseOver="showMenuDesign();"
                    }
                }, {
                    getClass: function(v, meta, rec) {
                        if (rec.get(\'alert_name\') < 0) {
                            this.items[1].tooltip = \'Edit\';
                            return \'alert-col\';
                        } else {
                            this.items[1].tooltip = \'Edit\';
                            return \'buy-col\';
                        }
                    },
					handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
'."
var ctv='".$activetableBody."';
var ccrecordid=rec.get('".$tc."');
//alert('wassxxxxxx=='+ccrecordid);

if(ctv=='form_amrsconcepts'){
//alert(ccrecordid);
//editdiv
gridViewform_amrsconceptsFQM('detailinfo','updateload',1);
//form_amrsconceptsForm('editdiv','updateload',ccrecordid));"."
}else{

//alert(rec.get('".$tc."')+'$tc');
var ccrecordid=rec.get('".$tc."');
".$activetableBody."Form('detailinfo','updateload',ccrecordid);".'

}

                    }
                }]
            }
        ]

		';
/*.$activetableBody."Form('editdiv','updateload',rec.get('$tc')".');*/
//admin_adminuserForm(displayhere)
//admin_companyForm(displayhere,loadtype,rid)
$detailinfo='detailinfo';
if($dynaictable&&$dyamicolmn){
$detailinfo='dynamicchild';
}
$groupByFieldNameSSY='';
$grpsorterinfo='';
$pluginEditor='';
$installAddPlugins='';
$summarycols='';
if($activetableBody=='accounts_accountactivity'){
$firstsummaryfield='insurance_insurancedebitnote';
$groupbyfield='accountscategory_name';
$sortbyfield='accountscategory_name';
}

if($activetableBody=='insurance_insurancedebitnote'){
$firstsummaryfield='insurancedebitnote_name';
$groupbyfield='underwriter_name';
$sortbyfield='underwriter_name';

}
if(($activetableBody=='accounts_accountactivity')||($activetableBody=='insurance_insurancedebitnote')){
$summarycols="{
            text: 'Task',
            flex: 1,
            tdCls: 'task',
            sortable: true,
            dataIndex: '$firstsummaryfield',
            hideable: false,
            summaryType: 'count',
            summaryRenderer: function(value, summaryData, dataIndex) {
                return ((value === 0 || value > 1) ? '(' + value + ' Records)' : '(1 Record)');
            }
        },";
$groupByFieldNameSSY="groupField: '$groupbyfield',";
$grpsorterinfo="sorters: {property: '$sortbyfield', direction: 'ASC'},";
$installAddPlugins="plugins: [cellEditing],
dockedItems: [{
            dock: 'top',
            xtype: 'toolbar',
            items: [{
                tooltip: 'Toggle the visibility of the summary row',
                text: 'Toggle Summary',
                handler: function(){
                    var view = grid.getView();
                    showSummary = !showSummary;
                    view.getFeature('group').toggleSummaryRow(showSummary);
                    view.refresh();
                }
            }]
        }],
		features: [{
            id: 'group',
            ftype: 'groupingsummary',
            groupHeaderTpl: '{name}',
            hideGroupedHeader: true,
            enableGroupingMenu: false
        }],";
$pluginEditor="var cellEditing = Ext.create('Ext.grid.plugin.CellEditing', {
        clicksToEdit: 1,
        listeners: {
            edit: function(){
                // refresh summaries
                grid.getView().refresh();
            }
        }
    });
	var showSummary = true;";

	$summarycolumns="{
            text: 'Task',
            flex: 1,
            tdCls: 'task',
            sortable: true,
            dataIndex: 'description',
            hideable: false,
            summaryType: 'count',
            summaryRenderer: function(value, summaryData, dataIndex) {
                return ((value === 0 || value > 1) ? '(' + value + ' Tasks)' : '(1 Task)');
            }
        },";
}
//Additional Functions



$clearQueueBtn='';
$sendsmsbatch='';

if($activetableBody=='sms_generalsmshandle' || $activetableBody=='sms_billhandle' ||$activetableBody=='sms_emailhandle' ||$activetableBody=='sms_msgqueue' || $activetableBody=='sms_groupqueue'){
$qType='SMS';
if($activetableBody=='sms_emailhandle'){
$qType='Email';
}
 $invoiceCaption='Clear Queue';
 if($activetableBody=='sms_billhandle' ){

 }
 $invoiceFunction=' removeQueedItemsOnconfirmation("'.$activetableBody.'",store); ';
 $sendSmsFunction=' sendQueuedSMSByType("'.$activetableBody.'",store); ';
 $iconDisplay='cancelqueues';

 $clearQueueBtn=",'-', {
                    text:'".$invoiceCaption."',
                    tooltip:'Create options',
                    iconCls:'".$iconDisplay."',
					handler:function(buttonObj, eventObj){

					".$invoiceFunction."
					}
                }";

 $sendsmsbatch=",
                '-', {
                    text:'Send Batch $qType',
                    tooltip:'Send Batch $qType',
                    iconCls:'sendsms',
					handler:function(buttonObj, eventObj){

					".$sendSmsFunction."
					}
                }";

}else{
    $iconDisplay='cancelqueues';
    $invoiceCaption='Invoice';
    $invoiceFunction='';
    // $invoiceFunction='OpenInvoice('.base64_encode($activetableBody).'); ';
}
$gridinfo="function gridView$activetableBody( searchitem){
var viewdiv=document.getElementById('$detailinfo');
viewdiv.innerHTML='';
Ext.onReady(function() {
Ext.QuickTips.init();

/*var encode = false;
var local = true;
var filters = {
        ftype: 'filters',
        encode: encode,
        local: local,
        filters: [
            {
                type: 'boolean',
                dataIndex: 'visible'
            }
        ]
    };*/

Ext.define('cmb".$activetableBody."', {
    extend: 'Ext.data.Model',
	fields:['fieldname','fieldcaption']
	});

var search".$activetableBody."data = Ext.create('Ext.data.Store', {
    model: 'cmb".$activetableBody."',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=".$activetableBody."&find=thistable',
        reader: {
            type: 'json'
        }
    }
});
search".$activetableBody."data.load();

var closebtn= Ext.get('close-btn');
	var  viewgrbtn$activetableBody = Ext.get('gridView$activetableBody');

	Ext.define('".ucfirst($activetableBody)."', {
    extend: 'Ext.data.Model',
	fields:[".$columnModel."]
	});
	var store = Ext.create('Ext.data.Store', {
    pageSize: 20,    
    model: '".ucfirst($activetableBody)."',
	$grpsorterinfo
	$groupByFieldNameSSY
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?t=$activetableBody&fdn='+searchitem+'&dyt=$dynaictable',
        reader: {
            type: 'json',
            totalProperty: 'totalCount',
            root: 'data'
        }
    }
});
  store.load({pageSize:50});

  $pluginEditor;
  ////////
      var sellAction = Ext.create('Ext.Action', {
        icon   : '../shared/icons/fam/delete.gif',  // Use a URL in the icon config
        text: 'Delete',
        disabled: true,
        handler: function(widget, event) {

        }
    });

	$ctxmenuitem

    var buyAction = Ext.create('Ext.Action', {
        iconCls: 'user-girl',
        text: 'Edit',
        disabled: true,
        handler: function(widget, event) {
            var rec = grid.getSelectionModel().getSelection()[0];
            if (rec) {
               // alert('asdfasdas dfdfdf');
            } else {
               // alert('Please select a company from the grid');
            }
        }
    });

	var contextMenu = Ext.create('Ext.menu.Menu', {
        items: [
             $ctxmenuitemcall
        ]
    });

  //////////
    var grid = Ext.create('Ext.grid.Panel', {

        store: store,
		/*bbar:[items:[{
		xtype:'button',
		text:'Close'
		}],*/
        stateful: true,
		closable:true,
		$installAddPlugins
        multiSelect: true,
		iconCls: 'icon-grid',
        stateId: 'stateGrid',
		animCollapse:false,
        constrainHeader:true,
        layout: 'fit',
		columnLines: true,
		bbar:{height: 20},
         dockedItems: [{
                xtype: 'pagingtoolbar',
                store: store,
                dock: 'bottom',
                displayInfo: true
            }],
		/*features: [filters],*/
		columns:".'[
		new Ext.grid.RowNumberer({ width: 70, sortable: true }),'.$summarycols.$gridcolumnsReviesed.$actionDetails.",
		maxHeight: 600,
        width: 1100,//working width:::
		resizable:true,
        title: '".ucwords($gridtitle)."',
        renderTo: '$detailinfo',
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
,
		tbar:[{
                    text:'Add Record',
                    xtype:'hidden',
                    tooltip:'".$_SESSION[$activetableBody]."',
                    iconCls:'add',
					handler:function(){
						".'createForm("Save","NOID","'.$activetableBody.'","f")'."
					}
                }, '-', {
                    text:'PDF',
                    tooltip:'Create options',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
                    OpenPDFstatement('".base64_encode($activetableBody)."');
					// OpenReport('".base64_encode($activetableBody)."');
					}
                }".$clearQueueBtn.$sendsmsbatch.",/*
				'-', {
                    text:'Receipt',
                    tooltip:'Print Receipt',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){

					OpenReceipt('".base64_encode($activetableBody)."');
					}
                },
				'-', {
                    text:'Statement',
                    tooltip:'Print Statement',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){

					OpenStatement('".base64_encode($activetableBody)."');
					}
                },'-',{
                    text:'Delete',
                    tooltip:'Delete record',
                    iconCls:'remove'
                },*/'-',
				{ text:'Search',
 tooltip:'Find',
 iconCls:'find',
  handler: function(grid, rowIndex, colIndex) {
//testme();
 }

 }
 ,

 {
    xtype: 'combobox',
	name:'grdsearch".$activetableBody."',
	id:'grdsearch".$activetableBody."',
	forceSelection:true,
    fieldLabel: false,
    store: search".$activetableBody."data,
    queryMode: 'local',
    displayField: 'fieldcaption',
    valueField: 'fieldname',
	listeners: {
  select: function(combo,  record,  index ) {
    var selVal = Ext.getCmp('grdsearch".$activetableBody."').getValue();
	var selValtx = Ext.getCmp('searchfield').getValue();
  //alert(selValtx+selVal);
}}

	},
 { title:'Search',
 tooltip:'Find record',
 xtype:'textfield',
 name:'searchfield',
 id:'searchfield',
 iconCls:'remove',
 listeners: {'render': function(cmp) {
      cmp.getEl().on('keyup', function( event, el ) {
     	 var ke= event.getKey();
	if((ke==39)||(ke==13)||(ke==112)||(ke==37)||(ke==34)||(ke==38)||(ke==20)){
	var selVal = Ext.getCmp('grdsearch".$activetableBody."').getValue();
    var searchitem=el.value;
	store.proxy.extraParams = { searhfield:selVal,searhvalue:searchitem};
	 store.load();
	 }

      });
    }}
 }]

    });

	///grid selection

	grid.getSelectionModel().on({
        selectionchange: function(sm, selections) {
            if (selections.length) {
                buyAction.enable();
                sellAction.enable();
				$enablemenu
            } else {
                buyAction.disable();
                sellAction.disable();
				$disalemenuitem
            }
        }
    });
	///end of grid selection



});//end of testing ext load
}
gridView$activetableBody();
";
echo $gridinfo;
//return $gridinfo;
}

?>
<?php
function codeDate ($date) {
	$tab = explode ("-", $date);
	$r = $tab[1]."/".$tab[2]."/".$tab[0];
	return $r;
}


$loadscriptinfo=createFormLoad();
/*$loadscript='../template/functions/formload.js';
file_put_contents($loadscript,$loadscriptinfo);


$gridinfo=createAllGridFunctions();
$modalscript='../template/functions/grid.js';


file_put_contents($modalscript,$gridinfo);
$extform='../template/functions/extforms.js';

echo $extformdata;
$extformdata=createAllExtForms();
file_put_contents($extform,$extformdata);*/


function createForms($tablename){

//Get field information
$query_Rcd_getbody= " show columns from  $tablename ";
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
$requiredclasses='';
$tfunction='';
$combodata='';
$initialform='';

$formftbl="{xtype:'hidden',
             name:'t',
			 value:'$tablename'
			 },"
			 ;
			 $formfield=$formftbl;
$stdinfo='';
while ($rows=mysql_fetch_array($Rcd_tbody_results)){
$tfname=$count_cls['Field'];
$tfname=$count_cls['Null'];
$tfname=$count_cls['Key'];
$tfname=$count_cls['Extra'];
$allscripts.=createGRIDdetails($tfname);
}

$sqlmain="select groupfolder,
groupfolder	,
showgroup	,
fieldname	,
fieldcaption	,
required	,
control_position	,
infshow	,
displaysize	,
primarykeyidentifier	,
isautoincrement	,
dataformat,
accessrights
from admin_controller where tablename='$tablename' order by infpos";

$sqlmain_results = mysql_query($sqlmain) or die(mysql_error());
$fndCols=mysql_num_rows($sqlmain_results);

while ($rows=mysql_fetch_array($sqlmain_results)){
$dataformat=$rows['dataformat'];
$groupfolder=$rows['groupfolder'];
$showgroup=$rows['showgroup'];
$fieldname=$rows['fieldname'];
$fieldcaption=$rows['fieldcaption'];
$required=$rows['required'];
$control_position=$rows['control_position'];
$infshow=$rows['infshow'];
$displaysize=$rows['displaysize'];
$primarykeyidentifier=$rows['primarykeyidentifier'];
$isautoincrement=$rows['isautoincrement'];
$accessrights=$rows['accessrights'];

$datatype=substr($dataformat,0,3);
//echo $datatype.'=wwwwwwwwwwwwwwwww<br>'.$datatype.'MMMMMMMMMMMMMMM<br>';
$fldsplit=explode('_',$fieldname);
//$fieldtype=$datatype
if(($datatype=='int') || ($datatype=='tin')|| ($datatype=='dou')||($datatype=='sma')
|| ($datatype=='med')|| ($datatype=='big')|| ($datatype=='flo')|| ($datatype=='num')
|| ($datatype=='dec')){

if($isautoincrement){
$fieldtype='hidden';
}
if((!$isautoincrement)&&($fldsplit[1]=='id')){
$fieldtype='combobox';
}

if((!$isautoincrement)&&($fldsplit[1]!='id')){
$fieldtype='numberfield';
}

}


if($datatype=='var'){
$fieldtype='textfield';
}
// add word wrap x-grid-cell-inner
$useWordrap='';
if($datatype=='tex'){
$fieldtype='textareafield';
$useWordrap="class:'x-grid-cell-inner',";
}

if($datatype=='dat'){
$fieldtype='datefield';
}


if($fieldtype=='combobox'){

$comboFields=explode('_',$_SESSION[$fieldname]);
$combodata.="

Ext.define('cmb".ucfirst($_SESSION[$fieldname])."', {
    extend: 'Ext.data.Model',
	fields:['".$comboFields[1]."_id','".$comboFields[1]."_name']
	});

var ".$_SESSION[$fieldname]."data = Ext.create('Ext.data.Store', {
    model: 'cmb".ucfirst($_SESSION[$fieldname])."',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=".$_SESSION[$fieldname]."',
        reader: {
            type: 'json'
        }
    }
});

".$_SESSION[$fieldname]."data.load();
";


}
$colnum++;
if($fndCols==$colnum){
$commadelimiter='],';

}else{
$commadelimiter=',';
}


if($fieldtype=='combobox'){
$formfield.="
   {
    xtype: 'combobox',
	name:'$fieldname',
	forceSelection:true,
    fieldLabel: '$fieldcaption',
    store: ".$_SESSION[$fieldname]."data,
    queryMode: 'local',
    displayField: '$comboFields[1]_name',
    valueField: '$comboFields[1]_id'
	}".$commadelimiter;
}
else{
$formfield.="{
            xtype: '$fieldtype',
            name: '$fieldname',
            fieldLabel: '$fieldcaption',
            allowBlank: false,
            minLength: 1

		}".$commadelimiter;
}




}
$tfunction="
function ".$tablename."Form(displayhere,loadtype,rid){

var obj=document.getElementById(displayhere);

obj.innerHTML='';
var encode = false;
var local = true;
var filters = {
        ftype: 'filters',
        encode: encode,
        local: local,
        filters: [
            {
                type: 'boolean',
                dataIndex: 'visible'
            }
        ]
    };

";

//other standard infor
$stdinfo=" dockedItems: [{
            xtype: 'container',
            dock: 'bottom',
            layout: {
                type: 'hbox',
                align: 'middle'
            },
            padding: '10 10 5',

            items: [{
                xtype: 'component',
                id: 'formErrorState',
                baseCls: 'form-error-state',
                flex: 1,
                validText: 'Form is valid',
                invalidText: 'Form has errors',
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=\".\"><li><span class=\"field-name\">{name}</span>: <span class=\"error\">{error}</span></li></tpl></ul>'),

                getTip: function() {
                    var tip = this.tip;
                    if (!tip) {
                        tip = this.tip = Ext.widget('tooltip', {
                            target: this.el,
                            title: 'Error Details:',
                            autoHide: false,
                            anchor: 'top',
                            mouseOffset: [-11, -2],
                            closable: true,
                            constrainPosition: false,
                            cls: 'errors-tip'
                        });
                        tip.show();
                    }
                    return tip;
                },

                setErrors: function(errors) {
                    var me = this,
                        baseCls = me.baseCls,
                        tip = me.getTip();

                    errors = Ext.Array.from(errors);

                    /* Update CSS class and tooltip content*/
                    if (errors.length) {
                        me.addCls(baseCls + '-invalid');
                        me.removeCls(baseCls + '-valid');
                        me.update(me.invalidText);
                        tip.setDisabled(false);
                        tip.update(me.tipTpl.apply(errors));
                    } else {
                        me.addCls(baseCls + '-valid');
                        me.removeCls(baseCls + '-invalid');
                        me.update(me.validText);
                        tip.setDisabled(true);
                        tip.hide();
                    }
                }
            },


	/*now submit*/
	{
		xtype: 'button',
        text: 'Submit Data',
        handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'bodysave.php',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                        Ext.Msg.alert('Success', 'Your changes has been saved.');
                    }
                });
            }
        }
    }
	/*end of cols*/
		]

		 }]
    });";
	$tablename64=base64_encode($tablename);
	$displayWindow="var win = Ext.create('Ext.Window', {

        title: '".$_SESSION['stm'.$tablename]."',

        layout: 'fit',
		autoScroll :true,
		items: formPanel,
		 tbar:[{
                    text:'Add Something',
                    tooltip:'Add a new row',
                    iconCls:'add'
                }, '-', {
                    text:'Options',
                    tooltip:'Blah blah blah blaht',
                    iconCls:'option'
                },'-',{
                    text:'Search',
                    tooltip:'Delete Record',
                    iconCls:'find'
                }]
    }).show();


});";

$toolbars="[{
                    text:'Add new',
                    tooltip:'Add a new row',
                    iconCls:'add'
                }, '-', {
                    text:'Options',
                    tooltip:'Configure options',
                    iconCls:'option'
                },'-',{
                    text:'Search',
                    tooltip:'Delete selected item',
                    iconCls:'search'
                },'-',{
                    text:'View',
                    tooltip:'View Information Grid',
                    iconCls:'grid',
					handler:function(buttonObj, eventObj) {
									gridView$tablename();
									//createForm('Save','NOID','$tablename','g')
											}
                }]";
$displayWindow='';
$initialform="

Ext.onReady(function() {
Ext.tip.QuickTipManager.init();
        var formPanel = Ext.widget('form', {
        renderTo: displayhere,
		tbar:$toolbars,
		resizable:true,
        frame: true,
		url:'bodysave.php',
        width: 400,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: '".ucfirst($_SESSION['stm'.$tablename])."',

        defaults: {
            anchor: '100%'
        },
        fieldDefaults: {
            labelAlign: 'left',
            msgTarget: 'none',
            /*invalidCls: ''
			unset the invalidCls so individual fields do not get styled as invalid*/
        },

        /*
         * Listen for validity change on the entire form and update the combined error icon
         */
        listeners: {
            fieldvaliditychange: function() {
                this.updateErrorState();
            },
            fielderrorchange: function() {
                this.updateErrorState();
            }
        },

        updateErrorState: function() {
            var me = this,
                errorCmp, fields, errors;

            if (me.hasBeenDirty || me.getForm().isDirty()) { //prevents showing global error when form first loads
                errorCmp = me.down('#formErrorState');
                fields = me.getForm().getFields();
                errors = [];
                fields.each(function(field) {
                    Ext.Array.forEach(field.getErrors(), function(error) {
                        errors.push({name: field.getFieldLabel(), error: error});
                    });
                });
                errorCmp.setErrors(errors);
                me.hasBeenDirty = true;
            }
        },

        items: [

		";

	$lastpart=" dockedItems: [{
            xtype: 'container',
            dock: 'bottom',
            layout: {
                type: 'hbox',
                align: 'middle'
            },
            padding: '10 10 5',

            items: [{
                xtype: 'component',
                id: 'formErrorState',
                baseCls: 'form-error-state',
                flex: 1,
                validText: 'Form is valid',
                invalidText: 'Form has errors',
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for="."><li><span class=\"field-name\">{name}</span>: <span class=\"error\">{error}</span></li></tpl></ul>'),

                getTip: function() {
                    var tip = this.tip;
                    if (!tip) {
                        tip = this.tip = Ext.widget('tooltip', {
                            target: this.el,
                            title: 'Error Details:',
                            autoHide: false,
                            anchor: 'top',
                            mouseOffset: [-11, -2],
                            closable: true,
                            constrainPosition: false,
                            cls: 'errors-tip'
                        });
                        tip.show();
                    }
                    return tip;
                },

                setErrors: function(errors) {
                    var me = this,
                        baseCls = me.baseCls,
                        tip = me.getTip();

                    errors = Ext.Array.from(errors);

                    // Update CSS class and tooltip content
                    if (errors.length) {
                        me.addCls(baseCls + '-invalid');
                        me.removeCls(baseCls + '-valid');
                        me.update(me.invalidText);
                        tip.setDisabled(false);
                        tip.update(me.tipTpl.apply(errors));
                    } else {
                        me.addCls(baseCls + '-valid');
                        me.removeCls(baseCls + '-invalid');
                        me.update(me.validText);
                        tip.setDisabled(true);
                        tip.hide();
                    }
                }
            },


	//now submit
	{
		xtype: 'button',
        text: 'Submit Data',
        handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'bodysave.php',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                        Ext.Msg.alert('Success', '' + o.result.savemsg + '\"');
                    }
                });
            }
        }
    }
	///end of cols
		]
        }]
    });

	/*var win = Ext.create('Ext.Window', {

        title: 'User Registration',
       // height: 700,
        width: 1800,
        layout: 'fit',
		autoScroll :true,
		items: formPanel,
		 tbar:[{
                    text:'Add new',
                    tooltip:'Add a new record',
                    iconCls:'add'
                }, '-', {
                    text:'Options',
                    tooltip:'Configure options',
                    iconCls:'option'
                },'-',{
                    text:'Delete',
                    tooltip:'Delete the selected item',
                    iconCls:'remove'
                },'-',{
                    text:'View',
                    tooltip:'View Information Grid',
                    iconCls:'grid',
					handler:function(buttonObj, eventObj) {
									///eventObj.click(eval(tablevalgrpArr[2]));
									//gridView$tablename();
									createForm('Save','NOID','$tablename','g')
											}
                }
				]
    }).show();
	*/

if(loadtype=='updateload'){
load".$tablename."info(formPanel,rid);
}
});
}//launchForm()
$tablename"."Form('detailinfo','Save','NOID');
";

$tableform=$tfunction.$combodata.$initialform.$formfield.$lastpart;
//.'}/* end of '.$_SESSION['stm'.$tablename].' form*/';
return $tableform;
}

function createAllExtForms(){
$tableform='';
$query_Rcd_getbody= "show tables ";
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
$gridinfo='';
while ($rows=mysql_fetch_array($Rcd_tbody_results)){
$table_name=$rows[0];//$rows['table_name'];
$tableform.=createForms($table_name);

}
$requiredclasses="	Ext.require([
    'Ext.form.*',
    'Ext.Img',
    'Ext.tip.QuickTipManager'
]);

";
//echo $requiredclasses.$tableform;
return $requiredclasses.$tableform;
}

function createProgramSubMenus(){

$query_Rcd_getbody= "SELECT distinct tablename,displaygroup, displaysubgroup table FROM admin_controller order by showgroupposition ";
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
$submenuinfo='';
$processed='';
while ($rows=mysql_fetch_array($Rcd_tbody_results)){
$tablename=$rows['tablename'];
$displaygroup=$rows['displaygroup'];
$displaysubgroup=$rows['displaysubgroup'];
$submenuinfo.=createForms($table_name);


$processed='';


}

return $requiredclasses.$tableform;

}

$menu="var item1 =  Ext.create('Ext.Panel', {
                title: 'Accordion Item 1',
				    lbar:[{
                            text: 'Aero Glass',
                            vtype: 'text',
                            group: 'theme',
                            handler: onItemCheck
                        }, {
                            text: 'Vista Black',
                            checked: false,
                            group: 'theme',
                            checkHandler: onItemCheck
                        }, {
                            text: 'Gray Theme  kenya in kwe',
                            checked: false,
                            group: 'theme',
                            checkHandler: onItemCheck
                        }, {
                            text: 'Default Theme',
                            checked: false,
                            group: 'theme',
                            checkHandler: onItemCheck
                        }]//, items:[treePanel]
                //cls:'empty'
            });
}";


function createFormUpdateScript($tablename){

$tablefields=getTableFields($tablename);

$updateFnc='function load'.$tablename."info(activeform,rid){
Ext.define('lmodel$tablename', {
    extend: 'Ext.data.Model',
	fields:[".$tablefields."],
	proxy: {
        type: 'ajax',
		api:{
		      read : 'buidgrid.php?t=$tablename&acn=rd',
		      update : 'bodysave.php?t=$tablename&q=rid&act=Update'
		},

        reader: {
            type: 'json'
        }
    }
});

//Load data
Ext.ModelMgr.getModel('lmodel$tablename').load(rid, {
    success: function(user) {
        activeform.loadRecord(user);

    }
});




}";
return $updateFnc;
}
function getTableFields($tablename){
	$query_Rcd_getbody= "show columns from $tablename";
/*$query_Rcd_getbody="select
fieldname
from admin_controller where tablename='$tablename'  and infshow='Show' order by infpos";
*/
	$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
	$tfield='';
	$fndCols=mysql_num_rows($Rcd_tbody_results);
	$cnt=0;
	while ($rows=mysql_fetch_array($Rcd_tbody_results)){
	$cnt++;
			if($cnt==$fndCols){
			$comma='';
			}else{
			$comma=',';
			}
	$tfield.="'".$rows['fieldname']."'".$comma;
	}

return $tfield;
}

function createFormLoad(){
$query_Rcd_getbody= " show tables ";
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
$loadcripts='';
	while ($rows=mysql_fetch_array($Rcd_tbody_results)){
	$tablename=$rows[0];
	$loadcripts.=createFormUpdateScript($tablename);
	}

	return $loadcripts;
}

//createFormUpdateScript('admin_rights');
$ty=$_GET['ty'];
$tablename=$_GET['t'];
if($ty=='g'){
//createGRIDdetails($tablename);
//$sqlvdym=reviseSQLToDynamic('payment_receivablepayment','admin_person','syownerid');
$showcolumnsdynamic=createFormDisplayColumns($tablename,$tview,$div,$cols,$optlabel,$optwidth,$selected,$target);

//echo $showcolumnsdynamic.'KKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK';
}

////////Dynamic controller

$isdynamicTable=$_SESSION['syownerid'.$tablename];
if($isdynamicTable){
$tview='radiogroup';
$div='detailinfo';
$cols=2;
$optlabel="false";
$optwidth=550;
$target='grid';


$dynamicTbl=$_GET['dcrspdn'];
if($dynamicTbl){

$dynaictable=$dynamicTbl;
$dyamicolmn=$_SESSION['syowneridfield'.$tablename];
createGRIDdetails($tablename,$dynaictable,$dyamicolmn);
$showcolumnsdynamic=createFormDisplayColumns($tablename,$tview,$div,$cols,$optlabel,$optwidth,$selected,$target);
echo $showcolumnsdynamic;
}else{
$showcolumnsdynamic=createFormDisplayColumns($tablename,$tview,$div,$cols,$optlabel,$optwidth,$selected,$target);
echo $showcolumnsdynamic;
}
}else{
$dynaictable='';
$dyamicolmn='';
createGRIDdetails($tablename,$dynaictable,$dyamicolmn);
}
    ?>
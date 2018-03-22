<?php
restrictaccessMenu_mlkns();
function restrictaccessMenu_mlkns(){
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

/*** Restrict Access To Page: Grant or deny access to this page*/
function isAuthorized_menu_fmks($strUsers, $strGroups, $UserName, $UserGroup) { 
/* For security, start by assuming the visitor is NOT authorized. */
  $isValid = False; 

  /*When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  Therefore, we know that a user is NOT logged in if that Session variable is blank. */ 
  if (!empty($UserName)) { 
    /* Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    Parse the strings into arrays. */
    $arrUsers = explode(",", $strUsers); 
    $arrGroups = explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    /* Or, you may restrict access to only certain users based on their username. */
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



?>
<?php
function codeDate ($date) {
	$tab = explode ("-", $date);
	$r = $tab[1]."/".$tab[2]."/".$tab[0];
	return $r;
}

$tableView=$_GET['tview'];
if($tableView){
createFormViews($tableView);
}
function createFormViews($tableView){
/*$sql="select admin_tabmngr.tabmngr_id , admin_sview.sview_id , admin_sview.sview_name , admin_tabmngr.is_primary , admin_tabmngr.tablelist_secondary , admin_tabmngr.secondary_position , admin_tabmngr.display_caption , admin_viewmode.viewmode_id , admin_viewmode.viewmode_name , admin_tabmngr.fieldlist_visible , admin_viewicon.viewicon_id, admin_viewicon.viewicon_name from admin_tabmngr inner join admin_sview on admin_sview.sview_id = admin_tabmngr.sview_id inner join admin_viewmode on admin_viewmode.viewmode_id = admin_tabmngr.viewmode_id inner join admin_viewicon on admin_viewicon.viewicon_id = admin_tabmngr.viewicon_id where admin_tabmngr.sview_id=$tableView";*/
$query_Rcd_getbody= $sql;//$_SESSION["admin_tabmngr_SearchSQL"]."  where sview_id=$tableView ";
$orderbyclause=" Order by designer_tabmngr.secondary_position ";
$query_Rcd_getbody= $_SESSION["designer_tabmngr_SearchSQL"]."  where designer_sform.sform_id=$tableView  ".$orderbyclause;

//echo $query_Rcd_getbody;
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
    $designItems='';
	$designItemGroupTitle='';
	$display_captionTB='';
	$interfaceItem='';
	$combodatavr='';
	$createfields='';
			 $fieldtype='';
			 $createfields='';
			 $combodataInfo='';
			 $interfaceItemComplete='';
			 $interfaceItemTabs='';
					$createTabInitial='';
					$createTabClose='';
			 $numrowsfnd=mysql_num_rows($Rcd_tbody_results);
	while ($rows=mysql_fetch_array($Rcd_tbody_results)){
	
		$sformName=$rows['sform_name'];
		$sviewName=$rows['sview_name'];
		$is_primary=$rows['is_primary'];
		$tablename=$rows['tablelist_secondary'];
		$secondary_position=$rows['secondary_position'];
		$display_caption=$rows['display_caption'];
		$viewmode_id=$rows['viewmode_name'];
		$fieldlist_visible=$rows['fieldlist_visible'];
		$viewicon_id=$rows['viewicon_name'];
		
		$fields='';
		$fields=explode(',',$fieldlist_visible);
		$x=sizeof($fields);
		$colnum=0;
		
		$sviewNameRvied=explode(' ',$sformName);
		$functionName='';
		foreach ($sviewNameRvied as $it){
		$functionName.=ucfirst($it);
		}
		$formftbl="{xtype:'hidden',
             name:'tview_$tablename',
			 value:'$tablename'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },"
			 ;
			 $formfield=$formftbl;
			 $createfields='';
		foreach ($fields as $fieldname){
					$datatypeArr=explode('|',$_SESSION['fieldtype'.$tablename.$fieldname]);
					$datatype=substr($datatypeArr[0],0,3);
					$DV='';
		 			$DV=explode('_',$fieldname);
				    if($DV[1]=='id'){
					 
								  $scrtbl= $_SESSION[$fieldname];
								  $npart=$DV[0].'_name';
								  
								  
					           if($_SESSION[$scrtbl.$npart]){
							   
								 $datatype='combo';
								$tablenmeModel='Model'.ucfirst($scrtbl);
								$fieldtype='combobox';
								$datadefn=createFormFieldRemoteData($fieldtype,$fieldname,$scrtbl);
								$combodataInfo[$scrtbl]=$datadefn;
								/*.'
								'.trim($scrtbl).'data.load();
';*/
								
								
								}else{
								$datatype='hidden';
								}
								$scrtbl='';
								$npart='';
					  
					}    //end check if primry key
		 
		$fieldtype=getFormFieldType($datatype,$fieldname);
		$cmdata='cmb'.ucfirst($_SESSION[$fieldname]);
		$fieldcaption=$_SESSION[$tablename.$fieldname];
		$createfield=createActualFormFields($fieldtype,$fieldname,$fieldcaption);
		           $colnum++;
				   
				   
				   
					if($x==$colnum){
					//createPrimaryDataModels();
					$commadelimiter='';
					}else{
					$commadelimiter=',==KK++++++++++++++++';
					}
					$commadelimiter=',';
					$createfields.=$createfield.$commadelimiter;
					
					
       }  //end of fieldset
	   
	   $combodata.=$combodataInfo;
	   $designItems.='||'.$createfields;
	   $designItemGroupTitle.='||'.$functionName;
	   $display_captionTB.='||'.$display_caption;
	   
	   //********************************
	   $i++;
	   if($i==$numrowsfnd){
	   
	   $enditemdelimit='}],';
	   }else{
	  $enditemdelimit='},';
	   }
	   //if($i==1){
				   if($viewmode_id=='radiogroup'){
					$columnconfig="cls: 'x-check-group-alt',
						columns: $columns,";
				   }else{
				   $columnconfig='';
				   }
				   $numrowsfndCOUNT++;
				   
				   
				   
				    if($viewmode_id=='tabpanel'){
					
					if($numrowsfndCOUNT==$numrowsfnd){
				  $enditemdelimitTab='}]}],';
				   }else{
				   $enditemdelimitTab='},';
				   }
					$countTbs++;
					
					/*if($countTbs==1){*/
					
					$createTabInitial="
					{xtype: 'tabpanel',
						
						$icon
						title:false,
						width:600,
						iconCls:'$viewicon_id',
						activeTab: 0,
						defaults:{
							bodyStyle:'padding:10px'
						},
						items:[";
						$createTabClose='';
					$interfaceItemTabs.="
						{
						title:'$display_caption',
						items: [$createfields]
						
						
					".$enditemdelimitTab;
					}else{
					
					$createfieldsPass='';
					$createfieldsPass=$createfields;
				  $interfaceItem.= "{
						xtype: '$viewmode_id',
						
						$icon
						title: '$display_caption',
						width:600,
						iconCls:'$viewicon_id',
						items: [$createfieldsPass]
					".$enditemdelimit;
					
			}
	   //}
	   /*elseif($i>1){
	    if($viewmode_idProcessed!=$viewmode_id){
		
		echo $interfaceItem;
		}
	   
	   }*/
	   $viewmode_idProcessed=$viewmode_id;
	   //********************************
		$interfaceItemComplete.=$interfaceItem;
	}    //end of while
	
	
	///
$titemData='';
foreach($combodataInfo as $titem){
$titemData.=$titem;
}
$tfunction="
function ".$functionName."Form(displayhere){
$titemData
var obj=document.getElementById(displayhere);
obj.innerHTML='';

";



/*//other standard infor*/
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
                    tooltip:'View table Grid',
                    iconCls:'grid',
					handler:function(buttonObj, eventObj) { 
									createFormGrid('Save','NOID','$tablename','g')
									}
                }]";
				
$initialform="

Ext.onReady(function() {
Ext.tip.QuickTipManager.init();
        var formPanel = Ext.widget('form', {
        renderTo: displayhere,
		tbar:$toolbars,
		resizable:true,
        frame: true,
		url:'bodysave.php',
        width: 600,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: '".ucfirst($sformName)."',

        defaults: {
            anchor: '100%'
        },
        fieldDefaults: {
            labelAlign: 'left',
            msgTarget: 'none'
			/*,
            invalidCls: '' 
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

            if (me.hasBeenDirty || me.getForm().isDirty()) { "./*//prevents showing global error when form first loads*/
			"
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

                    "./*Update CSS class and tooltip content*/
					"
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
                        Ext.Msg.alert('Success', '' + o.result.savemsg + '\"');
                    }
                });
            }
        }
    }
	"./*///end of cols*/"
		]
        }]
    });
	
	
if(loadtype=='updateload'){
load".$tablename."info(formPanel,rid);
}

});



}/*launchForm()*/
$functionName"."Form('detailinfo');
";

	
	$tabpaninfor=$createTabInitial.$interfaceItemTabs.$createTabClose;
	//$reviseString=str_replace('},]','}]',$tableform);
	$closePrevious=']';	
		
$tableform=$tfunction.$combodatavr.$initialform.$interfaceItem.$tabpaninfor.$lastpart;

$reviseString=str_replace('},]','}]',$tableform);

echo $reviseString	;			

}
?>

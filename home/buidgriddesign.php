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

$allscripts.=createGRIDdetails($table_name);
}

return $allscripts;
}

function createGRIDdetails($activetableBody){
$headerfields=getHeaderDetails($activetableBody);
$columns='';
 $item='';
 $gridcolumnsReviesed='';
$ctncolms=sizeof($headerfields);
if($headerfields){
$item=0;
      foreach ($headerfields as $fielddata){
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
		 $width='width : 80';
		 }
		 $vartcol=explode('_',$activetableBody);
		 $varcol=explode('_',$fielddata);
		 $tc=$vartcol[1].'_id';
		 $fc=$varcol[0].'_id';
		 $fcntfielddata=$fielddata;
		 if(($varcol[1]=='id')&&($tc!= $fc)){
		 $fielddata=$varcol[0].'_name';
		 }
		 $columns.= "'".$fielddata."'".$comma;
		 $gridcolumnsReviesed.='{
		' ."text     : ' ".trim($_SESSION[$activetableBody.$fcntfielddata])." ' , 
		 $width , 
		 sortable : true , 
		 dataIndex : '". $fielddata."'".'
		 }'.$plaincomma.'
		 ';
		 
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

///Action functions ends
$gridtitle=$_SESSION['stm'.$activetableBody];
$gridcolumns=$addstartbrace.$gridcolumns.$actionfncs;
$columnModel=$columns;

$actionDetails='{
                menuDisabled: true,
                sortable: false,
                xtype: \'actioncolumn\',
                width: 50,
                items: [{
                    icon   : \'../shared/icons/fam/delete.gif\',
                    tooltip: \'Sell stock\',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
                        alert(\'Sell \' + rec.get(\'alert_name\'));
                    }
                }, {
                    getClass: function(v, meta, rec) { 
                        if (rec.get(\'alert_name\') < 0) {
                            this.items[1].tooltip = \'Hold stock\';
                            return \'alert-col\';
                        } else {
                            this.items[1].tooltip = \'Buy stock\';
                            return \'buy-col\';
                        }
                    },
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);

'.$activetableBody."Form('detailinfo','updateload',rec.get('$tc')".');
                    }
                }]
            }
        ]
		
		';

//admin_adminuserForm(displayhere)
//admin_companyForm(displayhere,loadtype,rid)
$gridinfo="

//$gridtitle

function gridView$activetableBody(){
var viewdiv=document.getElementById('detailinfo');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtn$activetableBody = Ext.get('gridView$activetableBody');	

	Ext.define('".ucfirst($activetableBody)."', {
    extend: 'Ext.data.Model',
	fields:[".$columnModel."]
	});
	var store = Ext.create('Ext.data.Store', {
    model: '".ucfirst($activetableBody)."',
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?t=$activetableBody',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        //collapsible: true,
        multiSelect: true,
		iconCls: 'icon-grid',
        stateId: 'stateGrid',
		animCollapse:false,
        constrainHeader:true,
        layout: 'fit',
		columnLines: true,
		//headerPosition :'left',
		bbar:{height: 20},
		columns:".'[
		new Ext.grid.RowNumberer(),'.$gridcolumnsReviesed.$actionDetails.",
		maxHeight: 600,
        width: 600,
		resizable:true,
        title: '".ucwords($gridtitle)."',
        renderTo: 'detailinfo',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
		},
		tbar:[{
                    text:'Add Record',
                    tooltip:'Add a new row',
                    iconCls:'add',
					handler:function(){
						 
					}
                }, '-', {
                    text:'Options',                  
                    iconCls:'option'
                }]
		
    });
	
	/*var win = Ext.create('Ext.Window', {
		extend: 'Ext.ux.desktop.Module',				  
        title: 'Grid Filters Example',
		collapsable:true,
		autoScroll :true,
        layout: 'fit',
		items: grid
    }).show();*/
	
}//end of gridView$activetableBody function
";
return $gridinfo;
}

?>
<?php
function codeDate ($date) {
	$tab = explode ("-", $date);
	$r = $tab[1]."/".$tab[2]."/".$tab[0];
	return $r;
}


$loadscriptinfo=createFormLoad();
$loadscript='../template/functions/formload.js';
file_put_contents($loadscript,$loadscriptinfo);


$gridinfo=createAllGridFunctions();
$modalscript='../template/functions/grid.js';


file_put_contents($modalscript,$gridinfo);
$extform='../template/functions/extforms.js';

echo $extformdata;
$extformdata=createAllExtForms();
file_put_contents($extform,$extformdata);


function createForms($tablename){

//Get field information
$query_Rcd_getbody= " select fieldname from admin_controller where infshow='Show' 
	And tablename='$tablename' ";
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die($query_Rcd_getbody);
$requiredclasses='';
$tfunction='';
$combodata='';
$initialform='';
$rt=explode('_',$tablename);
$aifield=$rt[1].'_id';
$formftbl="{xtype:'hidden',
             name:'t',
			 value:'$tablename'
			 },
			 {xtype:'hidden',
             name:'$aifield',
			 value:''
			 },"
			 ;
			 $formfield=$formftbl;
$stdinfo='';
while ($rows=mysql_fetch_array($Rcd_tbody_results)){
$tfname=$count_cls['fieldname'];
/*$tfname=$count_cls['Null'];
$tfname=$count_cls['Key'];
$tfname=$count_cls['Extra'];*/
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
from admin_controller where tablename='$tablename' AND infshow='Show' order by infpos";

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
//if($infshow!='Show')
//$fieldtype='hidden';

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
if($datatype=='tex'){
$fieldtype='textareafield';
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



$tfunction="
function ".$tablename."Form(displayhere,loadtype,rid){

var obj=document.getElementById(displayhere);

obj.innerHTML='';

";

}

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
                    text:'Remove Something',
                    tooltip:'Remove the selected item',
                    iconCls:'remove'
                }]
    }).show();
	

});";

$toolbars="[{
                    text:'Add Something',
                    tooltip:'Add a new row',
                    iconCls:'add'
                }, '-', {
                    text:'Options',
                    tooltip:'Blah blah blah blaht',
                    iconCls:'option'
                },'-',{
                    text:'Remove Something',
                    tooltip:'Remove the selected item',
                    iconCls:'remove'
                },'-',{
                    text:'View',
                    tooltip:'View Information Grid',
                    iconCls:'grid',
					handler:function(buttonObj, eventObj) { 
									///eventObj.click(eval(tablevalgrpArr[2]));
									gridView$tablename();
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
		closable:true,
        frame: true,
		url:'bodysave.php',
        width: 550,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: 'Update ".ucfirst($_SESSION['stm'.$tablename])." ',

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
       //width: 800,
        layout: 'fit',
		autoScroll :true,
		items: formPanel,
		 tbar:[{
                    text:'Add Something muse',
                    tooltip:'Add a new row',
                    iconCls:'add'
                }, '-', {
                    text:'Options',
                    tooltip:'Blah blah blah blaht',
                    iconCls:'option'
                },'-',{
                    text:'Remove Something',
                    tooltip:'Remove the selected item',
                    iconCls:'remove'
                },'-',{
                    text:'View',
                    tooltip:'View Information Grid',
                    iconCls:'grid',
					handler:function(buttonObj, eventObj) { 
									///eventObj.click(eval(tablevalgrpArr[2]));
									gridView$tablename();
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
//$submenuinfo.=createFormsNOtuse($table_name);


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
	$query_Rcd_getbody= "
	select fieldname from admin_controller where tablename='$tablename'
	";
	
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
    ?>
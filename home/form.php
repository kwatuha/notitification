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
    $arrUsers = Explode(",", $strUsers);
    $arrGroups = Explode(",", $strGroups);
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

function createForms($tablename){
$query_Rcd_getbody= " show columns from  $tablename ";
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
$requiredclasses='';
$tfunction='';
$combodata='';
$initialform='';
$formftbl="{xtype:'hidden',
             name:'t',
			 value:'$tablename'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },"
			 ;
			 $formfield=$formftbl;
$stdinfo='';
while ($rows=mysql_fetch_array($Rcd_tbody_results)){
$tfname=$count_cls['Field'];
$tfname=$count_cls['Null'];
$tfname=$count_cls['Key'];
$tfname=$count_cls['Extra'];
}

$sqlmain="
select
groupfolder,
showgroup,
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
from admin_controller where tablename='$tablename'  and infshow='Show' order by infpos";



$sqlmain_results = mysql_query($sqlmain) or die(mysql_error());
$fndCols=mysql_num_rows($sqlmain_results);
$tableslist='';
$availableOptions='';
$defaultview='';
while ($rows=mysql_fetch_array($sqlmain_results)){
$dataformat=$rows['dataformat'];
$groupfolder=$rows['groupfolder'];
$showgroup=$rows['showgroup'];
$fieldname=$rows['fieldname'];
$fieldcaption=$rows['fieldcaption'];

if($_SESSION[$tablename.$fieldname])
$fieldcaption=$_SESSION[$tablename.$fieldname];

$required=$rows['required'];
$control_position=$rows['control_position'];
$infshow=$rows['infshow'];
$displaysize=$rows['displaysize'];
$primarykeyidentifier=$rows['primarykeyidentifier'];
$isautoincrement=$rows['isautoincrement'];
$accessrights=$rows['accessrights'];

$datatype=substr($dataformat,0,3);
$fldsplit=explode('_',$fieldname);

if((!$isautoincrement)&&($fldsplit[1]!='id')){
$fieldtype='numberfield';
}

/*/$fieldtype=$datatype*/
if(($datatype=='int') || ($datatype=='tin')|| ($datatype=='dou')||($datatype=='sma')
|| ($datatype=='med')|| ($datatype=='big')|| ($datatype=='flo')|| ($datatype=='num')
|| ($datatype=='dec')){

if($isautoincrement){
$fieldtype='hidden';
}

/*if(($fieldname=='date_created')||($fieldname=='changed_by')||($fieldname=='date_changed')||($fieldname=='voided')||($fieldname=='voided_by')||($fieldname=='date_voided')||($fieldname=='uuid')){
$fieldtype='hidden';
}*/

if((!$isautoincrement)&&($fldsplit[1]=='id')){
$fieldtype='combobox';
}

/*if($datatype=='tli'){

$fieldtype='combobox';
}
if($datatype=='fli'){
$fieldtype='combobox';
}*/
//echo $fldsplit[0].'222222222222222222222222222222222222222222222222222222222222222222222222222222222<br>2222=='.$fieldname;


}

$disdiv='detailinfo';
$referebysub=$_GET['dcrspdn'];
$selected='';
if($referebysub){
//$disdiv='dynamicchild';
$disdiv='detailinfo';
$selected=$selected;
}
$initializetheform=$tablename."Form('$disdiv','Save','NOID');";

if($fieldname=='syowner'){
$referebysub=$_GET['rbs'];
$defaultview=createFlexColumnDefault($tablename);
$target='form';
$availableOptions=createFlexColumnOptions($tablename,$selected,$target);

if($availableOptions){
//$initializetheform='';
}
$disdiv='dataentry';
  $tableslist='
'."Ext.define('cmbtableListdata', {
    extend: 'Ext.data.Model',
	fields:['table_caption','table_name']
	});

var tableListdata = Ext.create('Ext.data.Store', {
    model: 'cmbtableListdata',
    proxy: {
        type: 'ajax',
        url : 'cmbdesgn.php?tbp=admin_table',
        reader: {
            type: 'json'
        }
    }
});
tableListdata.load();
".'
'
;
  }

if($datatype=='sel'){
$fieldtype='itemselector';
}
if($datatype=='mul'){
$fieldtype='multiselect';
}


if($datatype=='var'){

  $fieldtype='textfield';
  if($fieldname=='password'){
    $fieldtype='password';
  }
  $vrem=explode('_',$fieldname);
  if($vrem[0]=='email'){
    $fieldtype='email';
	//$vtype="vtype:'email',";
  }
  if(($fieldname=='attachments')||($fieldname=='file_brouwse')||($fieldname=='chart_icon'))
  $fieldtype='filefield';

  if($fieldname=='person_name'){
  $fieldtype='hidden';
 }


}
if($datatype=='tex'){
$fieldtype='textareafield';
if($fieldname=='email_body'){
  $fieldtype='htmleditor';

  }

}

if($datatype=='dat'){
$fieldtype='datefield';
}


$fieldnameArr=explode('_',$fieldname);
if(($datatype=='tli')||($fieldnameArr[1]=='tablelist')){
$fieldtype='comboboxtablelist';
}
if($datatype=='fli'){
$fieldtype='comboboxtablefieldlist';
}


$referebysub=$_GET['dcrspdn'];
if($referebysub){
$comboFields=explode('_',$referebysub);
$combodata.="

Ext.define('cmb".ucfirst($referebysub)."', {
    extend: 'Ext.data.Model',
	fields:['".$comboFields[1]."_id','".$comboFields[1]."_name']
	});

var ".$referebysub."data = Ext.create('Ext.data.Store', {
    model: 'cmb".ucfirst($referebysub)."',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=".$referebysub."',
        reader: {
            type: 'json'
        }
    }
});

".$referebysub."data.load();
";
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

/*//////////////if it is a tablelist */
if($fieldtype=='comboboxtablelist'){
$combodata.="
Ext.define('cmbdesgn".ucfirst($fieldname)."', {
    extend: 'Ext.data.Model',
	fields:['table_name','table_caption']
	});

var ".$fieldname."data = Ext.create('Ext.data.Store', {
    model: 'cmbdesgn".ucfirst($fieldname)."',
    proxy: {
        type: 'ajax',
        url : 'cmbdesgn.php?tbp=admin_table',
        reader: {
            type: 'json'
        }
    }
});

".$fieldname."data.load();
";



}

if($fieldtype=='comboboxtablefieldlist'){
$combodata.="

Ext.define('cmb".ucfirst($fieldname)."', {
    extend: 'Ext.data.Model',
	fields:['fieldname','fieldcaption']
	});

var ".$fieldname."data = Ext.create('Ext.data.Store', {
    model: 'cmb".ucfirst($fieldname)."',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?myfields=admin_controller&vt=".$tablename."',
        reader: {
            type: 'json'
        }
    }
});

".$fieldname."data.load();
";



}

if($fieldtype=='itemselector'){
$combodata.="

Ext.define('cmb".ucfirst($fieldname)."', {
    extend: 'Ext.data.Model',
	fields:['fieldname','fieldcaption']
	});

var ".$fieldname."data = Ext.create('Ext.data.Store', {
    model: 'cmb".ucfirst($fieldname)."',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=".$tablename."&find=thistable',
        reader: {
            type: 'json'
        }
    }
});

".$fieldname."data.load();
";



}
/*/////////////////////*/
$colnum++;
if($fndCols==$colnum){
//adding repeating
$addrepeatedfield='';
$hasrpt=createRepeatingFormFields($tablename,$fieldname);
if($hasrpt!='NOT')
$addrepeatedfield=','.$hasrpt;
//$formfield=$formfield.$hasrpt;
///end of repeating
//$formfield=$formfield.$hasrpt;
$commadelimiter="$addrepeatedfield],";

}else{
$commadelimiter=',';
}
$custfieldmized='';
if($_SESSION['iscust'.$tablename.$fieldname])
$custfieldmized=customizeFieldItem($tablename,$fieldname);
//echo '==='.$fieldname.'---'. $tfname.'                 xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

$valueDefaultsTo=setFieldDefaultValue($fieldname,$tablename);
$referebysub=$_GET['dcrspdn'];
if($fieldtype=='combobox'){
$formfield.="
   {
    xtype: 'combobox',
	name:'$fieldname',
	forceSelection:true,
    fieldLabel: '$fieldcaption',
  $valueDefaultsTo
    store: ".$_SESSION[$fieldname]."data,
    queryMode: 'remote',
    displayField: '$comboFields[1]_name',
    valueField: '$comboFields[1]_id'
	}".$commadelimiter;
}elseif($fieldtype=='comboboxtablefieldlist'){
$formfield.="
   {
    xtype: 'combobox',
	name:'$fieldname',
	forceSelection:true,
    fieldLabel: '$fieldcaption',
    store: ".$fieldname."data,
    queryMode: 'remote',
    displayField: 'fieldcaption',
    valueField: 'fieldname'
	}".$commadelimiter;

}elseif($fieldtype=='itemselector'){
$formfield.="
   {
    xtype: 'itemselector',
	name:'$fieldname',
	forceSelection:true,
    fieldLabel: '$fieldcaption',
    store: ".$fieldname."data,
    queryMode: 'remote',
    displayField: 'sectionCaption',
    valueField: 'sectionValue',
	allowBlank: false,
    msgTarget: 'side'
	}".$commadelimiter;

}


elseif($fieldtype=='comboboxtablelist'){

$formfield.="
   {
    xtype: 'combobox',
	name:'$fieldname',
	forceSelection:true,
    fieldLabel: '$fieldcaption',
    store: ".$fieldname."data,
    queryMode: 'remote',
    displayField: 'table_caption',
    valueField: 'table_name'
	}".$commadelimiter;
}

elseif($fieldtype=='password'){
$formfield.="{
            xtype: 'textfield',
            name: '$fieldname',
            fieldLabel: '$fieldcaption',
			 inputType: 'password',
            allowBlank: false,
            minLength: 1

		}".$commadelimiter;
}
elseif($fieldtype=='email'){
$formfield.="{
            xtype: 'textfield',
            name: '$fieldname',
            fieldLabel: '$fieldcaption',
			allowBlank: false,
            minLength: 1

		}".$commadelimiter;
}
elseif($fieldname=='syowner'){
		if($referebysub){
				$formfield.="{
					xtype: 'hidden',
					name: '$fieldname',
					value: '$referebysub'

				}".$commadelimiter;

		}
}elseif($fieldname=='syownerid'){
		if($referebysub){
					$comboFVals=explode('_',$referebysub);
					$fcpn=$comboFVals[1].'_name';
					$fcpnid=$comboFVals[1].'_id';
					$fildcptionnew=$_SESSION[$referebysub.$fcpn];
		$formfield.="
		   {
			xtype: 'combobox',
			name:'$fieldname',
			forceSelection:true,
			fieldLabel: '$fildcptionnew',
			store: ".$referebysub."data,
			queryMode: 'remote',
			displayField: '$fcpn',
			valueField: '$fcpnid'
			}".$commadelimiter;

		}
}elseif($custfieldmized){
$formfield.=$custfieldmized.$commadelimiter;
}else{




/*if($fieldtype=='notused'){
    $fieldtype='';
	$vtype="vtype:'email',";
	}*/
	$setthisvalue='';
	// if(($fieldname=='due_after')&&($tablename=='sms_schedule'))
	// $setthisvalue=14;
	$autofilvalues='';
	$otherxcts='';
	if($_SESSION['isautofill'.$tablename.$fieldname]){
	$autofilvalues=fillAutoFillController($tablename,$fieldname);
	$setthisvalue=$autofilvalues['filval'];

	if($autofilvalues['editable']!='editable')
	$otherxcts.="readOnly:true,";

	if($autofilvalues['is_visible']!='visible')
	$otherxcts.="hidden:true,";
	}

$formfield.="{
            xtype: '$fieldtype',
			msgTarget : 'side',
            name: '$fieldname',
			$otherxcts
			value:'$setthisvalue',
            fieldLabel: '$fieldcaption',
            allowBlank: false,
            minLength: 1

		}".$commadelimiter;
}



$tfunction="
function ".$tablename."Form(displayhere,loadtype,rid){
/*alert('$tablename');*/
var obj=document.getElementById(displayhere);

var objchild=document.getElementById('dynamicchild');

objchild.innerHTML='';

obj.innerHTML='';

";

}

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

				///////////////////////////////////


				///////////////////////////////
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
					/////////////

					////////////////////
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
                    tooltip:'View table Grid',
                    iconCls:'grid',
					handler:function(buttonObj, eventObj) {
									createFormGrid('Save','NOID','$tablename','g')
									}
                }]";
$displayWindow='';
$heightdfn='';
if($_SESSION['height'.$tablename]>0)
$heightdfn="height:".$_SESSION['height'.$tablename].',';

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
		$heightdfn

		autoScroll:true,
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
                       // Ext.Msg.alert('Success', '' + o.result.savemsg + '\"');
					   eval(o.result.savemsg);
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
$initializetheform;
";

/*.'} end of '.$_SESSION['stm'.$tablename].' form;*/
/*$availableOptions='';
$defaultview='';*/
//$outputinfo=
$hasrpt=createRepeatingFormFields($tablename,$fieldname);
if($hasrpt!='NOT')
//$formfield=$formfield.$hasrpt;
$tableform=$tfunction.$combodata.$initialform.$formfield.$lastpart;

if($availableOptions){
$tview='radiogroup';
$div='detailinfo';
$cols=2;
$optlabel="false";
$optwidth=550;
$target='form';
$showcolumnsdynamic=createFormDisplayColumns($tablename,$tview,$div,$cols,$optlabel,$optwidth,$selected,$target);
if(!$referebysub){
echo $showcolumnsdynamic;
}else{
echo $showcolumnsdynamic;
echo $tableform;
}

}else{
echo $tableform;
}

return $tableform;
}




/*createFormUpdateScript('admin_rights');*/

$tablename=$_GET['t'];
if($tablename){
createForms($tablename);
}


function setFieldDefaultValue($fieldname,$tablename){
$valueDefaultsTo='';
if($fieldname=='smsmsgcust_id' && $tablename=='sms_disconnschedule')$valueDefaultsTo=   'value:2,';
if($fieldname=='smsmsgcust_id' && $tablename=='sms_schedule')$valueDefaultsTo=   'value:1,';
return $valueDefaultsTo;
}


    ?>
<?php
echo "/*

This file is part of Ext JS 4

Copyright (c) 2011 Sencha Inc

Contact:  http://www.sencha.com/contact

GNU General Public License Usage
This file may be used under the terms of the GNU General Public License version 3.0 as published by the Free Software Foundation and appearing in the file LICENSE included in the packaging of this file.  Please review the following information to ensure the GNU General Public License version 3.0 requirements will be met: http://www.gnu.org/copyleft/gpl.html.

If you are unsure which license is appropriate for your use, please contact the sales department at http://www.sencha.com/contact.

*/
Ext.Loader.setConfig({
    enabled: true
});
Ext.Loader.setPath('Ext.ux', '../sview/ux');

Ext.require([
    'Ext.grid.*',
    'Ext.data.*',
    'Ext.ux.RowExpander',
    'Ext.selection.CheckboxModel'
]);


function insurance_insurancedebitnoteFormRevised(fullname,personcode,iowner,pid,dbnoteid){

var displayhere='detailinfo';
var loadtype='Save';
var rid='NOID';
var obj=document.getElementById(displayhere);

var objchild=document.getElementById('dynamicchild');

objchild.innerHTML='';

obj.innerHTML='';



Ext.define('cmbAdmin_personttypecategory', {
    extend: 'Ext.data.Model',
	fields:['personttypecategory_id','personttypecategory_name']
	});

var admin_personttypecategorydata = Ext.create('Ext.data.Store', {
    model: 'cmbAdmin_personttypecategory',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_personttypecategory',
        reader: {
            type: 'json'
        }
    }
});

admin_personttypecategorydata.load();
Ext.onReady(function(){ 
Ext.tip.QuickTipManager.init();
        var formPanel = Ext.widget('form', {
		id:'insurancedebitnoteform',
		 region           : 'center',
		 bodyStyle  : 'padding: 10px; background-color: #DFE8F6',
		url:'bodysave.php',
        width     : 340,
		margin:'0 0 0 3',
		
	    collapsible:true,
		autoScroll:true,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: 'Person Category',

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

            if (me.hasBeenDirty || me.getForm().isDirty()) { 
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
		{html:'<div id=\"detailinfochild\"></div>'},
		{
 xtype: 'radiogroup',
 autoScroll:true,
 fieldLabel: 'Person Type',
 columns: 1,
 vertical: true,
 items: [{ xtype:'radiofield',boxLabel: 'Tenant',name:'persontype',id: 'tenantsel', inputValue: '1',
 handler:function(){
 Ext.getCmp('gendergrp').hide();
 Ext.getCmp('dob').hide();
 }},
 { boxLabel: 'Landlord',name:'persontype',id: 'landlordsel', inputValue: '2',
 handler:function(){
 Ext.getCmp('gendergrp').hide();
 Ext.getCmp('dob').hide();
 }},
 { boxLabel: 'Employee',name:'persontype',id: 'employeesel', inputValue: '3',
 handler:function(){
 Ext.getCmp('gendergrp').show();
 Ext.getCmp('dob').show();
 }},
 { xtype:'radiofield',boxLabel: 'Insurance Client',name:'persontype',id: 'insurancesel', inputValue: '4',
 handler:function(){
 Ext.getCmp('gendergrp').show();
 Ext.getCmp('dob').show();
 }}]}
 ]});

///////////////////////////////////////////////////////////////////////////////////////////////////
    

      
    // Setup the form panel
    
	
	var formPanel3 = Ext.create('Ext.form.Panel', {
        region     : 'center',
		id:'regiform',
        title      : 'Personal Details',
		collapsible:true,
		autoScroll:true,
        bodyStyle  : 'padding: 10px; background-color: #DFE8F6',
        
        width     : 500,
		tbar:[{
                    text:'Add new',
                    tooltip:'Add a new row',
                    iconCls:'add'
                }, '-',{
                    text:'Options',
                    tooltip:'Configure options',
                    iconCls:'option'
                },'-',{
                    text:'View',
                    tooltip:'View table Grid',
                    iconCls:'grid',
					handler:function(buttonObj, eventObj) { 
									createFormGrid('Save','NOID','admin_person','g');
									Ext.getCmp('idregistrationwin').close();
									}
                },'-',{
                    text:'Close',
                    tooltip:'Delete selected item',
                    iconCls:'delete',
					handler:function(){
				Ext.getCmp('idregistrationwin').close();
				}
                }],
        items      : [
		{  xtype: 'combobox',
	name:'personttypecategory_id',
	anchor:'100%',
	id:'pdpersonttypecategory_id',
	forceSelection:true,
	fieldLabel: 'Category',
	value:7,
    store: admin_personttypecategorydata,
	queryMode: 'remote',
    displayField: 'personttypecategory_name',
    valueField: 'personttypecategory_id',
	listeners: { select: function(combo, record, index ) { 
	var secelVallid = Ext.getCmp('pdpersonttypecategory_id').getValue();
	///////////////////
	if((secelVallid==7)||(secelVallid==8)){
	Ext.getCmp('idorpassport_number').hide();
	 Ext.getCmp('pin').hide(); 
	 Ext.getCmp('dob').hide();
	}else{
	Ext.getCmp('idorpassport_number').show();
	 Ext.getCmp('pin').show(); 
	}
	if((secelVallid==2)||(secelVallid==1)){
	  Ext.getCmp('gendergrp').hide();
	  Ext.getCmp('dob').hide();
	//insurance_insurancedebitnoteFormRevised('kwatuha','kwkw01','insurance_insurancedebitnote',51);
    }else{
	Ext.getCmp('gendergrp').show();
	  
	  Ext.getCmp('dob').show();
	}
	
	if((secelVallid==7)||(secelVallid==8)){
	 Ext.getCmp('dob').hide();
	 Ext.getCmp('gendergrp').hide();
	}
	if((secelVallid==7)){
	 
	 Ext.getCmp('gendergrp').hide();
	}
	}}
	},
	
			 {
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'first_name',
			anchor:'100%',
			id: 'first_name',
			value:'',
            fieldLabel: 'First Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'middle_name',
			id: 'middle_name',
			anchor:'100%',
			value:'',
            fieldLabel: 'Middle Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
			anchor:'100%',
            name: 'last_name',
			id: 'last_name',
			value:'',
            fieldLabel: 'Last Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			anchor:'100%',
			msgTarget : 'side',
            name: 'idorpassport_number',
			id: 'idorpassport_number',
			
			value:'',
            fieldLabel: 'ID/Passport #',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
			anchor:'100%',
			msgTarget : 'side',
            name: 'dob',
			id: 'dob',
			
			value:'',
            fieldLabel: 'Dob ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			anchor:'100%',
			msgTarget : 'side',
            name: 'pin',
			id: 'pin',
			
			value:'',
            fieldLabel: 'Pin ',
            allowBlank: false,
            minLength: 1
        
		},
		{
 xtype: 'radiogroup',
 autoScroll:true,
 fieldLabel: 'Gender',
 id: 'gendergrp',
 columns: 1,
 vertical: true,
 items: [{ boxLabel: 'Female',name:'gender',id: 'female', inputValue: 'F'},
 { boxLabel: 'Male',name:'gender',id: 'male', inputValue: 'M'}]},
   {
            xtype: 'checkbox',
			
			
			inputValue:'',
            name: 'status',
			id: 'CHstatus',
			hidden:true,
            fieldLabel: 'Is Active'
            
        
		    }]
    });
//hide unencessary fields
 Ext.getCmp('idorpassport_number').hide();
  Ext.getCmp('pin').hide();  
  //Simple 'border layout' panel to house both grids
    var displayPanel = Ext.create('Ext.Panel', {
        width    : 500,
        height   : 400,
		autoScroll:true,
        layout   : 'border',
        renderTo : 'panel',
        bodyPadding: '5',
        items    : [
            //formPanel
            formPanel3
        ],
        buttons    : [
			
            '->', // Fill
            {
                text    : 'Save',
				
				alignButton:'center',
                handler : function() {
               	
				var	first_name	=Ext.getCmp('first_name').getValue();	
				var	middle_name	=Ext.getCmp('middle_name').getValue();	
				var	last_name	=Ext.getCmp('last_name').getValue();	
				var	idorpassport_number	=Ext.getCmp('idorpassport_number').getValue();	
				var	dob	=Ext.getCmp('dob').getValue();	
				var	pin	=Ext.getCmp('pin').getValue();	
				var	gender	=Ext.getCmp('gendergrp').getValue();	
				var	status	=Ext.getCmp('CHstatus').getValue();	
				var	pdpersonttypecategoryct	=Ext.getCmp('pdpersonttypecategory_id').getValue();	
				  var status='Active';
				  if(pdpersonttypecategoryct>0){
				   Ext.Ajax.request({
								   url: 'bodysave.php',
								   success: function(resp) {
								   eval(resp.responseText);
								   Ext.getCmp('idregistrationwin').close();
								    /*Ext.getCmp('first_name').setValue('');
									Ext.getCmp('middle_name').setValue('');
									Ext.getCmp('last_name').setValue('');
									Ext.getCmp('idorpassport_number').setValue('');
									Ext.getCmp('dob').setValue('');
									Ext.getCmp('pin').setValue('');
									Ext.getCmp('CHstatus').setValue('');*/

								   },
                                   params:{t:'admin_person',
								   tttact:'Save',
								   personttypecategory_id:pdpersonttypecategoryct,
								   pfids:'pfid',
								    first_name:first_name,
									middle_name:middle_name,
									last_name:last_name,
									idorpassport_number:idorpassport_number,
									dob:dob,
									pin:pin,
									gender:gender,
									status:status
									},
									failure: function(action){
									// you could put an error message here
									}
								   });
					}
				   
				   
				   
                    }
            },'->', // Fill
            {
                text    : 'Reset',
				
				alignButton:'center',
                handler : function() {
                    //refresh source grid
					//var myregform= Ext.getCmp('regiform');
					
					//myregform.getForm.reset();
                    
                }
            }
			,'->', // Fill
            {
                text    : 'Close',
				
				alignButton:'center',
                handler : function() {
                    Ext.getCmp('idregistrationwin').close();
                    
                }
            }
        ]
    });
Ext.getCmp('dob').hide();
var win = Ext.create('Ext.window.Window', {
        title: 'Registration',
        width: 900,
		bodyPadding:10,
		iconCls: 'icon-grid',
		autoScroll:true,
		maximizable :true,
		collapsible :true,
        maximized:true,
		id:'idregistrationwin',
        plain: true,
		layout: 'fit',
        items: displayPanel,
		
	/*	dockedItems: [{
            xtype: 'toolbar',
            dock: 'bottom',
            ui: 'header',
            layout: {
                pack: 'center'
            },
            items: [{
                minWidth: 80,
                text: 'Close',
				handler:function(){
				Ext.getCmp('idregistrationwin').close();
				}
            }]
        }],*/
        buttonAlign:'center',
        buttons: [{
            text: 'Close',
			handler:function(){
				Ext.getCmp('idregistrationwin').close();
				}
			
        }]
    });

    win.show();

});
}
insurance_insurancedebitnoteFormRevised('Kwatuha Alfayo','IN20012','admin_person',51,2);
";

?>
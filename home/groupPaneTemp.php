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



Ext.define('cmbPayment_currency', {
    extend: 'Ext.data.Model',
	fields:['currency_id','currency_name']
	});

var payment_currencydata = Ext.create('Ext.data.Store', {
    model: 'cmbPayment_currency',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=payment_currency',
        reader: {
            type: 'json'
        }
    }
});

payment_currencydata.load();

var admin_grpdata = Ext.create('Ext.data.Store', {
    model: 'cmbsysgroups',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tgr=ggrp',
        reader: {
            type: 'json'
        }
    }
});

admin_grpdata.load();
Ext.onReady(function(){

//////////////////////////////
Ext.define('cmbInsurance_insurancedebitnote', {
    extend: 'Ext.data.Model',
	fields:['insurancedebitnote_id','insurancedebitnote_name']
	});

var insurance_insurancedebitnotedata = Ext.create('Ext.data.Store', {
    model: 'cmbInsurance_insurancedebitnote',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=insurance_insurancedebitnote',
        reader: {
            type: 'json'
        }
    }
});

insurance_insurancedebitnotedata.load();


Ext.define('cmbInsurance_insuranceclass', {
    extend: 'Ext.data.Model',
	fields:['insuranceclass_id','insuranceclass_name']
	});

var insurance_insuranceclassdata = Ext.create('Ext.data.Store', {
    model: 'cmbInsurance_insuranceclass',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=insurance_insuranceclass',
        reader: {
            type: 'json'
        }
    }
});

insurance_insuranceclassdata.load();


Ext.define('cmbInsurance_underwriter', {
    extend: 'Ext.data.Model',
	fields:['underwriter_id','underwriter_name']
	});

var insurance_underwriterdata = Ext.create('Ext.data.Store', {
    model: 'cmbInsurance_underwriter',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=insurance_underwriter',
        reader: {
            type: 'json'
        }
    }
});

insurance_underwriterdata.load();

Ext.define('cmbInsurance_policyscope', {
    extend: 'Ext.data.Model',
	fields:['policyscope_id','policyscope_name']
	});

var insurance_policyscopedata = Ext.create('Ext.data.Store', {
    model: 'cmbInsurance_policyscope',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=insurance_policyscope',
        reader: {
            type: 'json'
        }
    }
});

insurance_policyscopedata.load();
/////// 
Ext.tip.QuickTipManager.init();
        var formPanel = Ext.widget('form', {
		id:'insurancedebitnoteform',
		 region           : 'west',
		 bodyStyle  : 'padding: 10px; background-color: #DFE8F6',
        tbar:[{
                    text:'Add new',
                    tooltip:'Add a new row',
                    iconCls:'add'
                }, '-', {
                    text:'Options',
                    tooltip:'Configure options',
                    iconCls:'option'
                },'-',{
                    text:'View',
                    tooltip:'View table Grid',
                    iconCls:'grid',
					handler:function(buttonObj, eventObj) { 
									createFormGrid('Save','NOID','insurance_insurancedebitnote','g')
									}
                },'-',{
                    text:'Close',
                    tooltip:'Delete selected item',
                    iconCls:'delete',
					handler:function(){
				Ext.getCmp('dbnotecustomization').close();
				}
                }],
		//resizable:true,
		//closable:true,
		//  frame: true,
		url:'bodysave.php',
        width     : 340,
		
	    collapsible:true,
		autoScroll:true,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: 'Insured Information',

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
		{
 xtype: 'radiogroup',
 autoScroll:true,
 fieldLabel: 'Policy Type',
 columns: 2,
 vertical: true,
 items: [{ boxLabel: 'Rewable',id: 'policyrenewable', inputValue: '1'},
 { boxLabel: 'Non-Renewable',id: 'policynonrenewable', inputValue: '0'}]}
 ]});

///////////////////////////////////////////////////////////////////////////////////////////////////
    

      
    // Setup the form panel
    var formPanel2 = Ext.create('Ext.form.Panel', {
        region     : 'east',
        title      : 'Policy Payment',
		collapsible:true,
		autoScroll:true,
        bodyStyle  : 'padding: 10px; background-color: #DFE8F6',
        labelWidth : 100,
        width     : 340,
        margins    : '0 0 0 3',
        items      : [{
            xtype: 'textfield',
			msgTarget : 'side',
			anchor:'100%',
            name: 'bank',
			 id: 'dnbank',
			fieldLabel: 'Bank'
         }
        ]
    });
	
	var formPanel3 = Ext.create('Ext.form.Panel', {
        region     : 'center',
        title      : 'Insurance Class',
		collapsible:true,
		autoScroll:true,
        bodyStyle  : 'padding: 10px; background-color: #DFE8F6',
        margin:'0 0 0 3',
        width     : 200,
        items      : [
			 {
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'first_name',
			value:'',
            fieldLabel: 'First Name ',
            allowBlank: false,
            minLength: 1
        
		}]
    });
//hide unencessary fields
   
  //Simple 'border layout' panel to house both grids
    var displayPanel = Ext.create('Ext.Panel', {
        width    : 1100,
        height   : 550,
		autoScroll:true,
        layout   : 'border',
        renderTo : 'panel',
        bodyPadding: '5',
        items    : [
            formPanel,
            formPanel2,
			formPanel3
        ],
        bbar    : [
			
            '->', // Fill
            {
                text    : 'Reset Example',
                handler : function() {
                    //refresh source grid
                    gridStore.loadData(myData);
                    formPanel.getForm().reset();
                }
            }
        ]
    });

var win = Ext.create('Ext.window.Window', {
        title: 'Insurance Policy Information',
        width: 1100,
		bodyPadding:10,
		iconCls: 'icon-grid',
		autoScroll:true,
		maximizable :true,
		collapsible :true,
        maximized:true,
		id:'dbnotecustomization',
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
				Ext.getCmp('dbnotecustomization').close();
				}
            }]
        }],*/
        buttonAlign:'center',
        buttons: [{
            text: 'Close',
			handler:function(){
				Ext.getCmp('dbnotecustomization').close();
				}
			
        }]
    });

    win.show();

});
}
insurance_insurancedebitnoteFormRevised('Kwatuha Alfayo','IN20012','admin_person',51,2);
";

?>
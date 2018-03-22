function admin_rolenotificationhistFormRevsd(){
/*alert('admin_rolenotificationhist');*/
var displayhere='dynamicchild',loadtype='Save',rid='NOID';
var obj=document.getElementById(displayhere);

var objchild=document.getElementById('dynamicchild');

objchild.innerHTML='';

obj.innerHTML='';



Ext.define('cmbAdmin_rolenotificationevent', {
    extend: 'Ext.data.Model',
	fields:['rolenotificationevent_id','rolenotificationevent_name']
	});

var admin_rolenotificationeventdata = Ext.create('Ext.data.Store', {
    model: 'cmbAdmin_rolenotificationevent',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_rolenotificationevent',
        reader: {
            type: 'json'
        }
    }
});

admin_rolenotificationeventdata.load();

Ext.define('cmbdesgnPrimary_tablelist', {
    extend: 'Ext.data.Model',
	fields:['table_name','table_caption']
	});

var primary_tablelistdata = Ext.create('Ext.data.Store', {
    model: 'cmbdesgnPrimary_tablelist',
    proxy: {
        type: 'ajax',
        url : 'cmbdesgn.php?tbp=admin_table',
        reader: {
            type: 'json'
        }
    }
});

primary_tablelistdata.load();


Ext.onReady(function() {
Ext.tip.QuickTipManager.init();
        var formPanel = Ext.widget('form', {
        renderTo: displayhere,
		tbar:[{
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
									createFormGrid('Save','NOID','admin_rolenotificationhist','g')
									}
                }],
		resizable:true,
		closable:true,
		  frame: true,
		url:'bodysave.php',
        width: 550,
		id:'notificationfrm',
	
		autoScroll:true,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: ' admin rolenotificationhist',

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
		
		{xtype:'hidden',
             name:'t',
			 value:'admin_rolenotificationhist'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'rolenotificationhist_name',
			
			value:'',
            fieldLabel: 'Rolenotificationhist Name ',
            allowBlank: false,
            minLength: 1
        
		},
   {
    xtype: 'combobox',
	name:'rolenotificationevent_id',
	forceSelection:true,
    fieldLabel: 'Rolenotificationevent Id ',
    store: admin_rolenotificationeventdata,
    queryMode: 'remote',
    displayField: 'rolenotificationevent_name',
    valueField: 'rolenotificationevent_id'
	},{
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'notification_details',
			
			value:'',
            fieldLabel: 'Notification Details ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'actioned_by',
			
			value:'',
            fieldLabel: 'Actioned By ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'action',
			
			value:'',
            fieldLabel: 'Action ',
            allowBlank: false,
            minLength: 1
        
		},
   {
    xtype: 'combobox',
	name:'primary_tablelist',
	forceSelection:true,
    fieldLabel: 'Primary Tablelist ',
    store: primary_tablelistdata,
    queryMode: 'remote',
    displayField: 'table_caption',
    valueField: 'table_name'
	},{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'recordid',
			
			value:'',
            fieldLabel: 'Recordid ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'status',
			
			value:'',
            fieldLabel: 'Status ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'comment',
			
			value:'',
            fieldLabel: 'Comment ',
            allowBlank: false,
            minLength: 1
        
		},{xtype:'fieldset',
		   title:'More Attachments',
		   collapsible:true,
		   id:'mysuser',
		   items:[{
            xtype: 'button',
			margin: '5 5 5 5',
			text:'Add item',
			handler: function() {
			
								var container = this.up('fieldset');
								var itemnum=0;
								var config = Ext.apply({}, container.initialConfig.items[1]);
								config.fieldName = container.items.length + 1;
								var fieldnamed=container.items.length + 1;
								itemnum=fieldnamed-2;
								
										container.add({
												xtype: 'filefield',
												name: 'comment',
												width:400,
												fieldLabel: 'Comment  '+ fieldnamed/*,
												allowBlank: false,
												minLength: 1*/
											
											});
										
								}}
		]}], dockedItems: [{
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
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=><li><span class="field-name">{name}</span>: <span class="error">{error}</span></li></tpl></ul>'),

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
                       // Ext.Msg.alert('Success', '' + o.result.savemsg + '"');
					   eval(o.result.savemsg);
                    }
                });
            }
        }
    }
	
		]
        }]
    });
	
	
if(loadtype=='updateload'){
loadadmin_rolenotificationhistinfo(formPanel,rid);
}

});



}/*launchForm()*/
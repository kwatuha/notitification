function admin_rolenotificationRevisedForm(){
var displayhere='detailinfo',loadtype='Save',rid='NOID';
var obj=document.getElementById(displayhere);

var objchild=document.getElementById('dynamicchild');

objchild.innerHTML='';

obj.innerHTML='';



Ext.define('cmbAdmin_role', {
    extend: 'Ext.data.Model',
	fields:['role_id','role_name']
	});

var admin_roledata = Ext.create('Ext.data.Store', {
    model: 'cmbAdmin_role',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_role',
        reader: {
            type: 'json'
        }
    }
});

admin_roledata.load();


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
									createFormGrid('Save','NOID','admin_rolenotification','g')
									}
                }],
		resizable:true,
		closable:true,
		  frame: true,
		url:'bodysave.php',
        width: 800,
		
	
		autoScroll:true,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: ' admin rolenotification',

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
			 value:'admin_rolenotification'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },
   {xtype: 'fieldcontainer',
                fieldLabel:'Notification Type',
				combineErrors: true,
				msgTarget : 'side',
                layout: 'hbox',
						items:[{
								xtype: 'radiofield',
								margin: '0 5 0 0',
								name: 'notificationtype',
								boxLabel: 'Sequential',
								inputValue:'Sequential'
							
							},{
								xtype: 'radiofield',
								margin: '0 5 0 0',
								name: 'notificationtype',
								boxLabel: 'Random',
								inputValue:'Random'
							
							}]},
						  {
								xtype: 'textfield',
								name: 'awaits_activity',
								fieldLabel: 'Awaits Action',
								anchor:'50%',
								value:''
							
							}
							,
						   {
							xtype: 'combobox',
							name:'primary_tablelist',
							forceSelection:true,
							fieldLabel: 'Task',
							store: primary_tablelistdata,
							queryMode: 'remote',
							anchor:'60%',
							displayField: 'table_caption',
							valueField: 'table_name'
							},
						{xtype: 'fieldcontainer',
						fieldLabel:'Notification',
						combineErrors: true,
						msgTarget : 'side',
						layout: 'hbox',
						items:[
								{
								xtype: 'combobox',
								name:'rolenotificationevent_id',
								margin: '0 5 0 0',
								forceSelection:true,
								fieldLabel: false,//'Rolenotificationevent Id ',
								store: admin_rolenotificationeventdata,
								queryMode: 'remote',
								displayField: 'rolenotificationevent_name',
								valueField: 'rolenotificationevent_id'
								},{
								xtype: 'combobox',
								name:'role_id',
								labelWidth:50,
								margin: '0 5 0 0',
								forceSelection:true,
								fieldLabel: 'Role',
								store: admin_roledata,
								queryMode: 'remote',
								displayField: 'role_name',
								valueField: 'role_id'
								},{
								xtype: 'numberfield',
								labelWidth:90,
								
								margin: '0 5 0 0',
								msgTarget : 'side',
								name: 'notification_order',
								fieldLabel: 'Order ',
								allowBlank: false,
								minLength: 1
							
							}
						]},
   
	                   {xtype: 'fieldcontainer',
						fieldLabel:'Success',
						combineErrors: true,
						msgTarget : 'side',
						layout: 'hbox',
						items:[{
								xtype: 'textfield',
								msgTarget : 'side',
								margin: '0 5 0 0',
								name: 'success',
								value:'',
								fieldLabel:false,// 'Success ',
								allowBlank: false,
								minLength: 1
							
							},{
								xtype: 'textfield',
								msgTarget : 'side',
								labelWidth:50,
								margin: '0 5 0 0',
								name: 'failure',
								fieldLabel: 'Failure',
								allowBlank: false,
								minLength: 1
							
							},{
								xtype: 'textfield',
								msgTarget : 'side',
								labelWidth:90,
								margin: '0 5 0 0',
								name: 'undetermined',
								fieldLabel: 'Undetermined',
								allowBlank: false,
								minLength: 1
							
							}]},
			
		   {
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'comments',
			value:'',
            fieldLabel: 'Comments'
        
		}], dockedItems: [{
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
loadadmin_rolenotificationinfo(formPanel,rid);
}

});



}/*launchForm()*/
	

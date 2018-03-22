
function ChangeRequestForm(displayhere){


Ext.define('cmbAdmin_usergroup', {
    extend: 'Ext.data.Model',
	fields:['usergroup_id','usergroup_name']
	});

var admin_usergroupdata = Ext.create('Ext.data.Store', {
    model: 'cmbAdmin_usergroup',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_usergroup',
        reader: {
            type: 'json'
        }
    }
});

admin_usergroupdata.load();


Ext.define('cmbAdmin_alert', {
    extend: 'Ext.data.Model',
	fields:['alert_id','alert_name']
	});

var admin_alertdata = Ext.create('Ext.data.Store', {
    model: 'cmbAdmin_alert',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_alert',
        reader: {
            type: 'json'
        }
    }
});

admin_alertdata.load();

var obj=document.getElementById(displayhere);
obj.innerHTML='';



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
									createFormGrid('Save','NOID','admin_rights','g')
									}
                }],
		resizable:true,
        frame: true,
		url:'bodysave.php',
        width: 600,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: 'Change Request',

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
						xtype: 'fieldset',
						
						
						title: 'Change Request',
						iconCls:'usergroup',
						items: [
   {
    xtype: 'combobox',
	name:'usergroup_id',
	forceSelection:true,
    fieldLabel: 'Usergroup Id ',
    store: admin_usergroupdata,
    queryMode: 'local',
    displayField: 'usergroup_name',
    valueField: 'usergroup_id'
	},
   {
    xtype: 'combobox',
	name:'alert_id',
	forceSelection:true,
    fieldLabel: 'Alert Id ',
    store: admin_alertdata,
    queryMode: 'local',
    displayField: 'alert_name',
    valueField: 'alert_id'
	},{
            xtype: 'textfield',
            name: 'tablename',
            fieldLabel: 'Tablename ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'status',
            fieldLabel: 'Status ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
            name: 'comments',
            fieldLabel: 'Comments ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
            name: 'effective_date',
            fieldLabel: 'Effective Date ',
            allowBlank: false,
            minLength: 1
        
		}]
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
                        Ext.Msg.alert('Success', '' + o.result.savemsg + '"');
                    }
                });
            }
        }
    }
	
		]
        }]
    });
	
	
if(loadtype=='updateload'){
loadadmin_rightsinfo(formPanel,rid);
}

});



}/*launchForm()*/
ChangeRequestForm('detailinfo');

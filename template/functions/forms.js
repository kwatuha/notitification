
	Ext.require([
    'Ext.form.*',
    'Ext.Img',
    'Ext.tip.QuickTipManager'
]);
function launchForm(displayhere){

var emailval='kwatuha@yahoo.com';	
var obj=document.getElementById(displayhere);
obj.innerHTML='';	


Ext.define('Admin_adminuser', {
    extend: 'Ext.data.Model',
	fields:['alert_id','alert_name']
	});

var alertdata = Ext.create('Ext.data.Store', {
    model: 'Admin_adminuser',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/cmb.php?t=admin_alert',
        reader: {
            type: 'json'
        }
    }
});
 alertdata.load();
////
Ext.onReady(function() {
					 
	var usernameinfo;

    Ext.tip.QuickTipManager.init();
        var formPanel = Ext.widget('form', {
        renderTo: displayhere,
        frame: true,
		url:'../sview/fileupload/index.php',
        width: 550,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: 'Admin Instrumentation',

        defaults: {
            anchor: '100%'
        },
        fieldDefaults: {
            labelAlign: 'left',
            msgTarget: 'none',
            //invalidCls: '' 
			//unset the invalidCls so individual fields do not get styled as invalid
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

        items: [{
            xtype: 'textfield',
            name: 'username',
            fieldLabel: 'User name',
            allowBlank: false,
            minLength: 1
        },{xtype: 'textfield',
            name: 'stateCord',
            fieldLabel: 'State entry',
            allowBlank: false,
            minLength: 1
        },
		{xtype: 'numberfield',
            name: 'comments',
            fieldLabel: 'Age',
            allowBlank: false,
            minLength: 1
        },
		{xtype: 'hidden',
            name: 'tablename',
            allowBlank: false,
            value:'admin_alert'
        },{xtype: 'datefield',
            name: 'regdate',
            fieldLabel: 'State entry',
            allowBlank: false,
            minLength: 1
        }, 
		{
            xtype: 'textfield',
            
			store: alertdata,
			name: 'email',
			width:20,
			value:emailval,
            fieldLabel: 'alert_name',
            vtype: 'email',
            allowBlank: false
        },
		{
            xtype: 'filefield',
            
			store: alertdata,
			name: 'resume',
			width:20,
			value:emailval,
            fieldLabel: 'attach doc',
         
            allowBlank: false
        },
	{
		
	xtype: 'combobox',
	name:'city',
    fieldLabel: 'select notifications',
    store: alertdata,
    queryMode: 'local',
    displayField: 'alert_name',
    valueField: 'alert_id'
}],

        dockedItems: [{
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
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for="."><li><span class="field-name">{name}</span>: <span class="error">{error}</span></li></tpl></ul>'),

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
                    url: '../sview/fileupload/index.php',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                        Ext.Msg.alert('Success', 'Your photo "' + o.result.username + '" has been saved.');
                    }
                });
            }
        }
    }
	///end of cols
		]
        }]
    });
	
	var win = Ext.create('Ext.Window', {
					 
        title: 'User Registration',
       // height: 700,
       //width: 800,
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
	

});



}//launchForm()
//////

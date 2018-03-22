function admin_generaviewFormRevised(){
/*alert('admin_generaview');*/

var displayhere='detailinfo';var loadtype='Save';var rid='NOID';
var obj=document.getElementById(displayhere);

var objchild=document.getElementById('dynamicchild');

objchild.innerHTML='';

obj.innerHTML='';



Ext.define('cmbDesigner_sview', {
    extend: 'Ext.data.Model',
	fields:['sview_id','sview_name']
	});

var designer_sviewdata = Ext.create('Ext.data.Store', {
    model: 'cmbDesigner_sview',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=designer_sview&cvif=2',
        reader: {
            type: 'json'
        }
    }
});

designer_sviewdata.load();


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


Ext.define('cmbDesigner_tblgroup', {
    extend: 'Ext.data.Model',
	fields:['tblgroup_id','tblgroup_name']
	});

var designer_tblgroupdata = Ext.create('Ext.data.Store', {
    model: 'cmbDesigner_tblgroup',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=designer_tblgroup',
        reader: {
            type: 'json'
        }
    }
});

designer_tblgroupdata.load();


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
									createFormGrid('Save','NOID','admin_generaview','g')
									}
                }],
		resizable:true,
		closable:true,
		  frame: true,
		url:'bodysave.php',
        width: 550,
		
	
		autoScroll:true,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: ' admin generaview',

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
			 value:'admin_generaview'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },
   {
    xtype: 'combobox',
	name:'sview_id',
	forceSelection:true,
    fieldLabel: 'Sview Id ',
    store: designer_sviewdata,
    queryMode: 'remote',
    displayField: 'sview_name',
    valueField: 'sview_id'
	},
   {
    xtype: 'combobox',
	name:'role_id',
	forceSelection:true,
    fieldLabel: 'Role Id ',
    store: admin_roledata,
    queryMode: 'remote',
    displayField: 'role_name',
    valueField: 'role_id'
	},
   {
    xtype: 'combobox',
	name:'tblgroup_id',
	forceSelection:true,
    fieldLabel: 'Tblgroup Id ',
    store: designer_tblgroupdata,
    queryMode: 'remote',
    displayField: 'tblgroup_name',
    valueField: 'tblgroup_id'
	},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'menu_caption',
			
			value:'',
            fieldLabel: 'Menu Caption ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'checkbox',
			value:'Active',
			
			inputValue:'Active',
            name: 'status',
            fieldLabel: 'Visible'
            
        
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
												name: 'status',
												width:400,
												fieldLabel: 'Status  '+ fieldnamed,
												allowBlank: false,
												minLength: 1
											
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
loadadmin_generaviewinfo(formPanel,rid);
}

});



}/*launchForm()*/

function admin_roleFormRSD(){
var displayhere='detailinfo';
var loadtype='Save';
var rid='NOID';
var obj=document.getElementById(displayhere);

var objchild=document.getElementById('dynamicchild');

objchild.innerHTML='';

obj.innerHTML='';

Ext.require([
    'Ext.Editor',
    'Ext.form.Panel',
    'Ext.form.field.ComboBox',
    'Ext.form.field.Date',
    'Ext.data.Store',
    'Ext.data.proxy.Ajax',
    'Ext.data.reader.Json',
    'Ext.data.writer.Json'
]);

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
									createFormGrid('Save','NOID','admin_role','g')
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
        title: ' admin role',

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
			 value:'admin_role'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'role_name',
			
			value:'',
            fieldLabel: 'Role Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'description',
			
			value:'',
            fieldLabel: 'Description ',
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
												name: 'description',
												width:400,
												fieldLabel: 'Description  '+ fieldnamed/*,
												allowBlank: false,
												minLength: 1*/
											
											});

										
								}}
		]}],listeners: {
            afterrender: function(form){
                var cfg = {
                    shadow: false,
                    completeOnEnter: true,
                    cancelOnEsc: true,
                    updateEl: true,
                    ignoreNoChange: true
                }, height = form.child('textfield').getHeight();

                var labelEditor = Ext.create('Ext.Editor', Ext.apply({
                    width: 100,
                    height: height,
                    offsets: [0, 2],
                    alignment: 'l-l',
                    listeners: {
                        beforecomplete: function(ed, value){
							
                            if (value.charAt(value.length - 1) != ':') {
								//alert(ed.getValue());
								
                                ed.setValue(ed.getValue() + ':');
                            }
                            return true;
                        }
                    },
                    field: {
                        name: 'labelfield',
                        allowBlank: false,
                        xtype: 'textfield',
                        width: 90,
                        selectOnFocus: true
                    }
                }, cfg));
                form.body.on('dblclick', function(e, t){
                    labelEditor.startEdit(t);
                    // Manually focus, since clicking on the label will focus the text field
                    labelEditor.field.focus(50, true);
                }, null, {
                    delegate: 'label.x-form-item-label'
                });

                var titleEditor = Ext.create('Ext.Editor', Ext.apply({
                    alignment: 'bl-bl?',
                    offsets: [0, 10],
                    field: {
                        width: 130,
                        xtype: 'combo',
                        editable: false,
                        forceSelection: true,
                        queryMode: 'local',
                        displayField: 'text',
                        valueField: 'text',
                        store: {
                            fields: ['text'],
                            data: [{
                                text: 'User Details'
                            },{
                                text: 'Developer Detail'
                            },{
                                text: 'Manager Details'
                            }]
                        }
                    }
                }, cfg));

                form.header.titleCmp.textEl.on('dblclick', function(e, t){
																	
                    titleEditor.startEdit(t);
                });
            } 
        }
    });
});
}/*launchForm()*/
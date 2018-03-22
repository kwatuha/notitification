<?php
echo "
function reports_inddefinitionForm(displayhere,loadtype,rid){
/*alert('reports_inddefinition');*/
var obj=document.getElementById(displayhere);

var objchild=document.getElementById('dynamicchild');

objchild.innerHTML='';

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
									createFormGrid('Save','NOID','reports_inddefinition','g')
									}
                }],
		resizable:true,
		closable:true,
		  frame: true,
		url:'bodysave.php',
        width: 700,
		autoScroll:true,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: ' reports inddefinition',

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
			 value:'reports_inddefinition'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },
			 {xtype: 'fieldcontainer',
							fieldLabel:'Report Code',
							msgTarget : 'side',
							layout: 'hbox',
							items:[{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'report_code',
			value:'',
            fieldLabel: false,
            allowBlank: false,
			margin:'0 5 5 0',
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'inddefinition_name',
			value:'',
            fieldLabel: 'Rpt Name ',
            allowBlank: false,
            minLength: 1
        
		}]},{xtype: 'fieldcontainer',
							fieldLabel:'Query Code',
							msgTarget : 'side',
							layout: 'hbox',
							items:[{
            xtype: 'textfield',
			msgTarget : 'side',
			margin:'0 5 5 0',
            name: 'query_code',
			id: 'query_code',
			value:'',
            fieldLabel: false,
            allowBlank: false,
            minLength: 1,
			listeners: {'render': function(cmp) { 
          cmp.getEl().on('keyup', function( event, el ) {
     	  var ke= event.getKey();
		 
					if(ke==13){
					var pass = Ext.getCmp('query_code').getValue();
					fillMyRptCtls(pass);
					}
	
          });            
    }}
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'report_caption',
			
			value:'',
            fieldLabel: 'Report Caption ',
            allowBlank: false,
            minLength: 1
        
		}]},{
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'query_show',
			id: 'query_show',
			value:'',
            fieldLabel: 'Query Show ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'query_hide',
			id: 'query_hide',
			value:'',
            fieldLabel: 'Query Hide ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'pdf_column',
			id: 'pdf_column',
			value:'',
            fieldLabel: 'Pdf Column ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'buid_grid',
			
			value:'',
            fieldLabel: 'Buid Grid ',
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
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'grouped',
			
			value:'',
            fieldLabel: 'Grouped ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'grouped_by',
			
			value:'',
            fieldLabel: 'Grouped By ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'summary',
			
			value:'',
            fieldLabel: 'Summary ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'show_div',
			
			value:'',
            fieldLabel: 'Show Div ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'file',
			
			value:'',
            fieldLabel: 'File ',
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
												name: 'file',
												width:400,
												fieldLabel: 'File  '+ fieldnamed/*,
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
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=><li><span class=\"field-name\">{name}</span>: <span class=\"error\">{error}</span></li></tpl></ul>'),

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
                       // Ext.Msg.alert('Success', '' + o.result.savemsg + '\"');
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
loadreports_inddefinitioninfo(formPanel,rid);
}

});



}/*launchForm()*/
reports_inddefinitionForm('detailinfo','Save','NOID');;
";
?>

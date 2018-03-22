function medicallab_papsmearFormRevised(hospitalnum,queuid,labnum,personname,displayhere){
var loadtype='Save',rid='NOID';
/*alert('medicallab_papsmear');*/
var obj=document.getElementById(displayhere);

var objchild=document.getElementById('dynamicchild');

objchild.innerHTML='';

obj.innerHTML='';





Ext.onReady(function() {
Ext.tip.QuickTipManager.init();
Ext.define('cmbAdmin_person', {
    extend: 'Ext.data.Model',
	fields:['person_id','person_name']
	});

var admin_persondata = Ext.create('Ext.data.Store', {
    model: 'cmbAdmin_person',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?sydocprsn=1',
        reader: {
            type: 'json'
        }
    }
});

admin_persondata.load();
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
									createFormGrid('Save','NOID','medicallab_papsmear','g')
									}
                }],
		resizable:true,
		closable:true,
		  frame: true,
		url:'bodysave.php',
         width: 600,
	
		autoScroll:true,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: ' medicallab papsmear',

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
			 value:'medicallab_papsmear'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },
   {
    xtype: 'hidden',
	name:'queue_id',
	value:queuid
	},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'patiename',
			fieldLabel: 'Patient Name ',
            value:personname
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'patiennumb',
			fieldLabel: 'Hospital Number ',
            value:hospitalnum
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'labnum',
            value:labnum,
            fieldLabel: 'Lab Number '
        
		}, {
    xtype: 'multiselect',
	name:'physician',
	height:50,
	forceSelection:true,
    fieldLabel: 'Physician',
    store: admin_persondata,
    queryMode: 'remote',
    displayField: 'person_name',
    valueField: 'person_id'
	},{xtype: 'fieldcontainer',
							fieldLabel:'Reporting Date',
							msgTarget : 'side',
							layout: 'hbox',
							items:[{
            xtype: 'datefield',
			msgTarget : 'side',
            name: 'reporting_date',
			value:'',
			margin: '0 5 0 0',
            fieldLabel:false,
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
			msgTarget : 'side',
            name: 'sample_collection_date',
			margin: '0 5 0 0',
			value:'',
            fieldLabel: 'Sample Collection Date ',
            allowBlank: false,
            minLength: 1
        
		}]},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'adequacy',
			
			value:'',
            fieldLabel: 'Adequacy ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'within_normal',
			
			value:'',
            fieldLabel: 'Within Normal ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'squamous_cell_abnormalities',
			
			value:'',
            fieldLabel: 'Squamous Cell Abnormalities ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'non_neoplastic_conditions',
			
			value:'',
            fieldLabel: 'Non Neoplastic Conditions ',
            allowBlank: false,
            minLength: 1
        
		},	//margin(top,right,botton,left)
		{
                    region: 'center',
					margin: '5 0 0 100',
                    xtype: 'tabpanel',
                    items: [{
                        title: 'Comments',
                        items:[{
								xtype: 'textareafield',
								msgTarget : 'side',
								name: 'comments',
								value:'',
								anchor: '100%',
								width:500,
								fieldLabel: false,
								allowBlank: false,
								minLength: 1
								}]
                    }, {
                        title: 'Diagnosis',
							items:[{
							xtype: 'textareafield',
							msgTarget : 'side',
							name: 'diagnosis',
							width:500,
							anchor: '100%',
							value:'',
							fieldLabel: false,
							allowBlank: false,
							minLength: 1
						
						}]
                    }]
                },{xtype:'fieldset',
		   title:'Attachments',
		   hidden:true,
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
												name: 'attachments',
												width:400,
												fieldLabel: 'Attachments  '+ fieldnamed/*,
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
        text: 'Save',
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
loadmedicallab_papsmearinfo(formPanel,rid);
}

});



}/*launchForm()*/
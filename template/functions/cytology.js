function showCytologyForm(hospitalnum,queuid,labnum,personname,displayhere){
var loadtype='Save',rid='NOID';
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
        url : 'cmb.php?tbp=admin_person',
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
                    text:'View it',
                    tooltip:'View table Grid'
                    iconCls:'grid',
					handler:function(buttonObj, eventObj) { 
									createFormGrid('Save','NOID','medicallab_labresult','g')
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
        title: ' medicallab labresult',

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
			 value:'medicallab_labresult'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },
   {
    xtype: 'hidden',
	name:'queue_id',
	id: 'idqueue_id',
	value:queuid
	},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'patiename',
			fieldLabel: 'Patient Name ',
            value:personname
			id: 'idpatiename',
        
		},{xtype: 'fieldcontainer',
							fieldLabel:'Hospital Number ',
							msgTarget : 'side',
							layout: 'hbox',
							items:[{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'patiennumb',
			id: 'idpatiennumb',
			margin: '0 5 0 0',
            fieldLabel:false
        
		},{
            xtype: 'textfield',
			margin: '0 5 0 0',
			msgTarget : 'side',
            name: 'labnum',
			id: 'idlabnum',
            value:labnum,
            fieldLabel: 'Lab Number '
        
		}]},{xtype: 'fieldcontainer',
							fieldLabel:'Reporting Date',
							msgTarget : 'side',
							layout: 'hbox',
							items:[{
            xtype: 'datefield',
			msgTarget : 'side',
            name: 'reporting_date',
			id: 'idreporting_date',
			value:'',
			margin: '0 5 0 0',
            fieldLabel:false,
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
			msgTarget : 'side',
            name: 'sample_collection_date',
			id: 'idsample_collection_date',
			margin: '0 5 0 0',
			value:'',
            fieldLabel: 'Sample Collection Date ',
            allowBlank: false,
            minLength: 1
        
		}]}, {
    xtype: 'multiselect',
	name:'physician',
	height:50,
	id: 'idphysician',
	forceSelection:true,
    fieldLabel: 'Person Id ',
    store: admin_persondata,
    queryMode: 'remote',
    displayField: 'person_name',
    valueField: 'person_id'
	},{
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'biopsy',
			id: 'idbiopsy',
			value:'',
            fieldLabel: 'Biopsy ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'clinical_history',
			id: 'idclinical_history',

			value:'',
            fieldLabel: 'Clinical History ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'gross_description',
			id: 'idgross_description',
			value:'',
            fieldLabel: 'Gross Description ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'microscopy',
			id: 'idmicroscopy',
			value:'',
            fieldLabel: 'Microscopy ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'diagnosis',
			id: 'iddiagnosis',
			value:'',
            fieldLabel: 'Diagnosis ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'comments',
			id: 'idcomments',
			value:'',
            fieldLabel: 'Comments ',
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
												name: 'sample_collection_date',
												width:400,
												fieldLabel: 'Sample Collection Date  '+ fieldnamed/*,
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
loadmedicallab_labresultinfo(formPanel,rid);
}

});



}/*launchForm()*/
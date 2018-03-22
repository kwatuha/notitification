
function customizedRemoteDSForm(displayhere,loadtype,rid){
/*alert('sms_smsremotesource');*/

var dated=new Date();
var displayhere='detailinfo';
var loadtype='Save';
var rid='NOID';
var obj=document.getElementById(displayhere);

var objchild=document.getElementById('dynamicchild');

objchild.innerHTML='';

obj.innerHTML='';



Ext.define('cmbSms_datasourcetemp', {
    extend: 'Ext.data.Model',
	fields:['datasourcetemp_id','datasourcetemp_name']
	});

var sms_datasourcetempdata = Ext.create('Ext.data.Store', {
    model: 'cmbSms_datasourcetemp',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=sms_datasourcetemp',
        reader: {
            type: 'json'
        }
    }
});

sms_datasourcetempdata.load();





Ext.define('cmbSms_yearfilter', {
    extend: 'Ext.data.Model',
	fields:['yearfilter_id','yearfilter_name']
	});

var sms_yearfilterdata = Ext.create('Ext.data.Store', {
    model: 'cmbSms_yearfilter',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=sms_yearfilter',
        reader: {
            type: 'json'
        }
    }
});

sms_yearfilterdata.load();

Ext.define('cmbSms_monthfilter', {
    extend: 'Ext.data.Model',
	fields:['monthfilter_id','monthfilter_name']
	});

var sms_monthfilterdata = Ext.create('Ext.data.Store', {
    model: 'cmbSms_monthfilter',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=sms_monthfilter',
        reader: {
            type: 'json'
        }
    }
});

sms_monthfilterdata.load();

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
									createFormGrid('Save','NOID','sms_smsremotesource','g')
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
        title: 'Sent to External Data Source',

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
			 value:'sms_smsremotesource'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },
		    {xtype:'textfield',
             name:'smsremotesource_name',
                 fieldLabel: 'Schedule',
                  labelWidth:120,
			      value:''
			 },
			
   {
    xtype: 'combobox',
	name:'datasourcetemp_id',
	forceSelection:true,
     allowBlank: false,
    fieldLabel: 'Data Source',
    labelWidth:120,
    store: sms_datasourcetempdata,
    queryMode: 'remote',
    displayField: 'datasourcetemp_name',
    valueField: 'datasourcetemp_id',

        listeners: {
             select: function(combo,  record,  index ) {
            // var selVal = Ext.getCmp('datasourcetemp_id').getValue();
            var selVal = this.getValue();
            //var selValtx = Ext.getCmp('searchfield').getValue();
            // var me=this;
            resetParams();
           getRemoteSourceParams(selVal);
          
            
        }}

    ///////////////////
	},
                {
                    xtype: 'fieldcontainer',
                     id:'monthyearcontainer',
                    msgTarget: 'side',
                    layout: 'hbox',
                    items: [
                           {
                                xtype: 'combobox',
                                name:'monthfilter_id',
                                id:'monthfilter',
                                forceSelection:true,
                                hidden:true,
                                allowBlank: false,
                                fieldLabel: 'Month',
                                value:Ext.Date.dateFormat(dated,'m'),
                                margin: '0 10 0 0',
                                labelWidth:120,
                                width: 250,
                                store: sms_monthfilterdata,
                                queryMode: 'remote',
                                displayField: 'monthfilter_name',
                                valueField: 'monthfilter_id'
                          },
                        {
                            xtype: 'combobox',
                            name:'yearfilter_id',
                            value:Ext.Date.dateFormat(dated,'Y'),
                            id:'yearfilter',
                             hidden:true,
                             allowBlank: false,
                            fieldLabel: 'Year',
                            width: 250,
                            labelWidth:120,
                            store: sms_yearfilterdata,
                            queryMode: 'remote',
                            displayField: 'yearfilter_name',
                            valueField: 'yearfilter_id'
                         }
                    ]
                },

    //////////////////
                {
                    xtype: 'fieldcontainer',
                    msgTarget: 'side',
                    id:'fieldcontainer1',
                    layout: 'hbox',
                    items: [
                        {
                            xtype: 'label',
                            text: 'Parameters ',
                             width: 120,
                            msgTarget: 'side',
                             margin: '0 2 0 0',
                             hidden:true,
                            id:'label1',
                            minLength: 1
                        },
                        {
                            xtype: 'textfield',
                            msgTarget: 'side',
                            width: 400,
                            id:'param1',
                            name:'param1',
                            hidden:true,
                            value:'ALL',
                            allowBlank: false,
                            minLength: 1
                        }
                    ]
                },

                 {
                    xtype: 'fieldcontainer',
                    msgTarget: 'side',
                    id:'fieldcontainer2',
                    layout: 'hbox',
                    items: [
                        {
                            xtype: 'label',
                            text: 'Parameters ',
                             width: 120,
                            msgTarget: 'side',
                             margin: '0 2 0 0',
                              hidden:true,
                            id:'label2',
                            allowBlank: false,
                            minLength: 1
                        },
                        {
                            xtype: 'textfield',
                            msgTarget: 'side',
                            width: 400,
                            id:'param2',
                            name:'param2',
                            hidden:true,
                            value:'ALL',
                            allowBlank: false,
                            minLength: 1
                        }
                    ]
                },
                 {
                    xtype: 'fieldcontainer',
                     id:'fieldcontainer3',
                    msgTarget: 'side',
                    layout: 'hbox',
                    items: [
                        {
                            xtype: 'label',
                            text: 'Parameters ',
                             width: 120,
                            msgTarget: 'side',
                             margin: '0 2 0 0',
                            id:'label3',
                             hidden:true,
                            allowBlank: false,
                            minLength: 1
                        },
                        {
                            xtype: 'textfield',
                            msgTarget: 'side',
                            width: 400,
                            id:'param3',
                            name:'param3',
                            hidden:true,
                             value:'ALL',
                            allowBlank: false,
                            minLength: 1
                        }
                    ]
                },
                                 {
                    xtype: 'fieldcontainer',
                    msgTarget: 'side',
                     id:'fieldcontainer4',
                    layout: 'hbox',
                    items: [
                        {
                            xtype: 'label',
                            text: 'Parameters ',
                             width: 120,
                            msgTarget: 'side',
                             margin: '0 2 0 0',
                             hidden:true,
                            id:'label4',
                            allowBlank: false,
                            minLength: 1
                        },
                        {
                            xtype: 'textfield',
                            msgTarget: 'side',
                            width: 400,
                            hidden:true,
                            id:'param4',
                            name:'param4',
                            value:'ALL',
                            allowBlank: false,
                            minLength: 1
                        }
                    ]
                },
                
                {
                    xtype: 'fieldcontainer',
                     id:'fieldcontainer5',
                    msgTarget: 'side',
                    layout: 'hbox',
                    items: [
                        {
                            xtype: 'label',
                            text: 'Parameters ',
                            width: 120,
                            msgTarget: 'side',
							hidden:true,
                             margin: '0 2 0 0',
                            id:'label5',
                            allowBlank: false,
                            minLength: 1
                        },
                        {
                            xtype: 'textfield',
                            msgTarget: 'side',
                            width: 400,
							hidden:true,
                            id:'param5',
                            name:'param5',
                            value:'ALL',
                            allowBlank: false,
                            minLength: 1
                        }
                    ]
                },
                
                {
                    xtype: 'fieldcontainer',
                     id:'fieldcontainer6',
                    msgTarget: 'side',
                    layout: 'hbox',
                    items: [
                        {
                            xtype: 'label',
                            text: 'Parameters ',
                            width: 120,
                            msgTarget: 'side',
							hidden:true,
                             margin: '0 2 0 0',
                            id:'label6',
                            allowBlank: false,
                            minLength: 1
                        },
                        {
                            xtype: 'textfield',
                            msgTarget: 'side',
                            width: 400,
							hidden:true,
                            id:'param6',
                            name:'param6',
                            value:'ALL',
                            allowBlank: false,
                            minLength: 1
                        }
                    ]
                },
                
                {
                    xtype: 'fieldcontainer',
                     id:'fieldcontainer7',
                    msgTarget: 'side',
                    layout: 'hbox',
                    items: [
                        {
                            xtype: 'label',
                            text: 'Parameters ',
                            width: 120,
                            msgTarget: 'side',
							hidden:true,
                             margin: '0 2 0 0',
                            id:'label7',
                            allowBlank: false,
                            minLength: 1
                        },
                        {
                            xtype: 'textfield',
                            msgTarget: 'side',
                            width: 400,
							hidden:true,
                            id:'param7',
                            name:'param7',
                            value:'ALL',
                            allowBlank: false,
                            minLength: 1
                        }
                    ]
                },                
                {
                    xtype: 'fieldcontainer',
                    msgTarget: 'side',
                    id:'fieldcontainer8',
                    layout: 'hbox',
                    items: [
                        {
                            xtype: 'label',
                            text: 'Parameters ',
                            width: 120,
                            msgTarget: 'side',
							hidden:true,
                             margin: '0 2 0 0',
                            id:'label8',
                            allowBlank: false,
                            minLength: 1
                        },
                        {
                            xtype: 'textfield',
                            msgTarget: 'side',
                            width: 400,
							hidden:true,
                            id:'param8',
                            name:'param8',
                            value:'ALL',
                            allowBlank: false,
                            minLength: 1
                        }
                    ]
                },

                     

    {
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'parameters',			
            id: 'parameters',	
            hidden:true,		
			value:'ALL',
            fieldLabel: 'Parameters ',
            labelWidth:120,
            allowBlank: false,
            minLength: 1

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
loadsms_smsremotesourceinfo(formPanel,rid);
}

});



}



function getRemoteSourceParams(pid){

 Ext.Ajax.request({
  loadMask: true,
  url: 'cmb.php?remotedtid='+pid,
  params: {id: "1"},
  success: function(resp) {
    var mydata =resp.responseText;
    var options = Ext.decode(mydata).data;
    var ctn=1;

     Ext.each(options, function(op) {


    //    Ext.getCmp('param'+ctn).setValue("");
       if(op.param=='monthfilter'||op.param=='yearfilter'){
            if(op.param=='monthfilter'){
                    Ext.getCmp('monthfilter').show(); 
                }

                if(op.param=='yearfilter'){
                    Ext.getCmp('yearfilter').show(); 
                }

       }else{

       Ext.getCmp('parameters').setValue(mydata);
       Ext.getCmp('label'+ctn).setText(op.param);
       Ext.getCmp('label'+ctn).show();
       Ext.getCmp('param'+ctn).show();
       ctn++;

       }
       
    //    alert(op.param);

       
    });


      }
    });
   
}

function resetParams(){
    Ext.getCmp('yearfilter').hide(); 
    Ext.getCmp('monthfilter').hide(); 
    Ext.getCmp('parameters').setValue("ALL");
    for(var i=1;i<9;i++){
       Ext.getCmp('label'+i).setText('label'+i);
       Ext.getCmp('label'+i).hide();
       Ext.getCmp('param'+i).hide();
    }
}
/*launchForm()*/


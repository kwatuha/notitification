function selectUnderwriter(tenantfullname,personname,tpid){
//alert(tenantfullname+personname+tenantid+tpid);
Ext.onReady(function() {
Ext.define('cmbInsurance_underwriter', {
    extend: 'Ext.data.Model',
	fields:['underwriter_id','underwriter_name']
	});

var insurance_underwriterdata = Ext.create('Ext.data.Store', {
    model: 'cmbInsurance_underwriter',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=insurance_underwriter&rptp=2',
        reader: {
            type: 'json'
        }
    }
});

insurance_underwriterdata.load();

    var form = Ext.create('Ext.form.Panel', {
        border: true,
		frame:true,
		maximizable:true,
        fieldDefaults: {
            labelWidth: 55
        },
        url: 'bodysave.php',
        defaultType: 'textfield',
        bodyPadding: 5,

        items: [
		{
            xtype: 'textfield',
            fieldLabel: 'Insured ID',
			labelWidth:80,
            name: 'tenantid',
            value:personname
        },{
            xtype: 'textfield',
            fieldLabel: 'Insured',
			labelWidth:80,
			anchor:'60%',
            name: 'tenantname',
            value:tenantfullname
        },{xtype:'hidden',
             name:'t',
			 value:'insurance_insurancedbnunderwriter'
			 },{
            xtype: 'hidden',
            fieldLabel: 'syownerid',
            name: 'insurancedebitnote_id',
            value:tpid 
        },
		
		
		{
    xtype: 'combobox',
	name:'underwriter_id',
	id:'underwriter_id',
	forceSelection:true,
    fieldLabel: 'Underwriter',
	labelWidth:80,
	anchor:'75%',
    store: insurance_underwriterdata,
    queryMode: 'remote',
    displayField: 'underwriter_name',
    valueField: 'underwriter_id',
	listeners: { select: function(combo, record, index ) { 
	//var secelVallid = Ext.getCmp('liperson_id').getValue();
	//createFillLandlordDetails(secelVallid,tenantid);
	}}
	},{html:'Insurance Class:'}, {
            xtype: 'textarea',
			readOnly:true,
            hideLabel: true,
            name: 'debitnoteclases',
			id:'debitnoteclases',
            anchor: '100% -47'  // anchor width by percentage and height by raw adjustment
        }]
    });

    var win = Ext.create('Ext.window.Window', {
        title: 'Select Client Underwriter',
        width: 600,
        height:400,
        minWidth: 300,
		bodyPadding:10,
        minHeight: 200,
        layout: 'fit',
		id:'frmselectlandlord',
        plain: true,
        items: form,

        buttons: [{
            text: 'Finish',
			handler:function(){
			//tenantfullname,personname,tenantid,tpid
			
			var lnameid = Ext.getCmp('liperson_id').getValue();
			var lname = Ext.getCmp('lipersonname').getValue();
			
			var lunilid = Ext.getCmp('landlordid').getValue();
			//tenantid tpid
//housing_housingtenantFormRevised('detailinfo','Save','NOID',tenantfullname,tpid,personname,lnameid,lname,lunilid,tenantid);
			
			Ext.getCmp('insurancedebitnoteform').close();
			}
        },{
            text: 'Cancel'
			
        }]
    });

    win.show();
});
}
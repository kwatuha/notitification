function selectLandLord(tenantfullname,personname,tenantid,tpid){
//alert(tenantfullname+personname+tenantid+tpid);
Ext.onReady(function() {
Ext.define('cmbAdmin_person', {
    extend: 'Ext.data.Model',
	fields:['person_id','person_name']
	});

var admin_persondata = Ext.create('Ext.data.Store', {
    model: 'cmbAdmin_person',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_person&rptp=2',
        reader: {
            type: 'json'
        }
    }
});

admin_persondata.load();

    var form = Ext.create('Ext.form.Panel', {
        border: true,
		frame:true,
		maximizable:true,
        fieldDefaults: {
            labelWidth: 80
        },
        url: 'save-form.php',
        defaultType: 'textfield',
        bodyPadding: 5,

        items: [
		{
            xtype: 'textfield',
			readOnly:true,
            fieldLabel: 'Tenant ID',
            name: 'tenantid',
            value:personname
        },{
            xtype: 'textfield',
            fieldLabel: 'Tenant Name',
			readOnly:true,
			anchor:'60%',
            name: 'tenantname',
            value:tenantfullname
        },{
            xtype: 'hidden',
            fieldLabel: 'syowner',
            name: 'syowner',
            value:tenantid
        },{
            xtype: 'hidden',
            fieldLabel: 'syownerid',
            name: 'syownerid',
            value:tpid 
        },
		
		{
            xtype: 'hidden',
            fieldLabel: 'LandLordPID',
            name: 'lipersonname',
			id: 'lipersonname'
          
        },
		{
            xtype: 'textfield',
			readOnly:true,
            fieldLabel: 'LandLord #',
            name: 'landlordid',
			id: 'landlordid'
          
        },
		{
    xtype: 'combobox',
	name:'liperson_id',
	id:'liperson_id',
	forceSelection:true,
    fieldLabel: 'Landlord',
	anchor:'75%',
    store: admin_persondata,
    queryMode: 'remote',
    displayField: 'person_name',
    valueField: 'person_id',
	listeners: { select: function(combo, record, index ) { 
	var secelVallid = Ext.getCmp('liperson_id').getValue();
	
	createFillLandlordDetails(secelVallid,tenantid);
	}}
	},{html:'Property'}, {
            xtype: 'textarea',
			readOnly:true,
            hideLabel: true,
            name: 'landlordproperty',
			id:'landlordproperty',
            anchor: '100% -47'  // anchor width by percentage and height by raw adjustment
        }]
    });

    var win = Ext.create('Ext.window.Window', {
        title: 'Select Tenant Landlord',
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
            text: 'Create Contract',
			handler:function(){
			//tenantfullname,personname,tenantid,tpid
			var landlordid = Ext.getCmp('landlordid').getValue();
			var lname = Ext.getCmp('lipersonname').getValue();
			var lunilid = Ext.getCmp('liperson_id').getValue();
			var lnameid='NOT Used';
housing_housingtenantFormRevised('detailinfo','Save','NOID',tenantfullname,tpid,personname,lnameid,lname,landlordid,tenantid);
			Ext.getCmp('frmselectlandlord').close();
			}
        },{
            text: 'Cancel'
			
        }]
    });

    win.show();
});
}
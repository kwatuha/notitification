There is no automatic, bidirectional updating from Model < - > Form. You need to use loadRecord to load a record (model instance) into the form and then when you save the form, you will need to update the record that you loaded via basicForm.updateRecord(rec)


/**
* Persists the values in this form into the passed {@link Ext.data.Model} object in a beginEdit/endEdit block.
* @param {Ext.data.Record} record The record to edit
* @return {Ext.form.Basic} this
*/
updateRecord: function(record) {
//record.beginEdit();
var fields = record.fields,
values = this.getValues(),
name,
obj = {};
fields.each(function(f) {
name = f.name;
if (name in values) {
obj[name] = values[name];
}
});
record.set(obj);
//record.endEdit();
return this;
},

As for validations, that is for if you try to update/create a record. If it passes the validation, it will return no errors. If there are errors, it will return an Ext.data.Errors object. Love this approach. More robust than just using vtypes and allowBlank.


So on saving you can do this:


var basicForm = this.getForm(),
rec = this.rec;

basicForm.updateRecord(rec);
var success = rec.validate().isValid();
if (success) {
//handle success
} else {
//handle failure
}

////basic form... markInvalid(..)
Anyway, the API docs for Ext.data.Errors has a pretty good example:


var errors = myModel.validate();

errors.isValid(); //false

errors.length; //2
errors.getByField('name'); // [{field: 'name', error: 'must be present'}]
errors.getByField('title'); // [{field: 'title', error: 'is too short'}]

All the Ext.data.Errors is is an instance of MixedCollection. Notice that when you getByField("..."), it returns an array. This tripped me up.

/////////////
mitchellsimoens
10 Mar 2011, 9:26 AM
I haven't tried it but your code could be cleaned up a bit, don't take this the wrong way...



var me = this,
form = me.deviceCoverage,
basic = form.getForm(),
rec = me.deviceCoverageRecord;

basic.updateRecord(rec);
var errors = rec.validate();
if (!errors.isValid()) {
basic.markInvalid(errors);
return;
}
/////////////////////
Sure there are other reasons. I have talked to Jay Garcia and Ed Spencer about it one day and this is what we decided. It's agreed that we don't like it. Only reason I don't is because the IDE (BBEdit) I use highlights 'this' as blue. May be able to do it with 'me' but I'm too lazy.

You don't always need to do


var me = this;

On listeners, you can do it.


listeners: {
afterrender: function(grid) {
var me = grid;
}
}
/////
I know this got a little off-topic but back to the "me" code style. Is what I did below:

var nextButton = me.nextButton = <object> taking it too far for object creation?



index: function(options) {

var me = this,
app = me.application;

if (!options.back) {
me.deviceCoverage = Ext.create('Prepaid.views.DeviceCoverage', {});
me.deviceCoverageRecord = Ext.ModelMgr.create({}, 'DeviceCoverage');
me.deviceCoverage.getForm().loadRecord(me.deviceCoverageRecord);

me.wizard = Ext.create('CsgPrepaid.views.Wizard', {
items: me.deviceCoverage
});

app.viewport.add(me.wizard);

var nextButton = me.nextButton = me.wizard.wizardButtons.nextButton;
me.backButton = me.wizard.wizardButtons.backButton;

nextButton.setDisabled(true);

nextButton.on('click', me.nextHandler, me);
me.backButton.on('click', me.backHandler, me);

me.deviceCoverage.viewCoverageButton.on('click', me.viewCoverageHandler, me);
}

me.backButton.setDisabled(true);
nextButton.setText('[View Products]');

},
////////////////////////
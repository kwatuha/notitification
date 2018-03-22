<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>FieldContainer Example</title>

    <!-- ExtJS -->
    <link rel="stylesheet" type="text/css" href="http://dev.sencha.com/deploy/ext-4.0.7-gpl/resources/css/ext-all.css" />
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-4.0.7-gpl/bootstrap.js"></script>
    <!-- Shared -->
    <link rel="stylesheet" type="text/css" href="http://dev.sencha.com/deploy/ext-4.0.7-gpl/examples/shared/example.css" />
    <!-- Example -->
    <script type="text/javascript" >
  /*

This file is part of Ext JS 4

Copyright (c) 2011 Sencha Inc

Contact:  http://www.sencha.com/contact

Commercial Usage
Licensees holding valid commercial licenses may use this file in accordance with the Commercial Software License Agreement provided with the Software or, alternatively, in accordance with the terms contained in a written agreement between you and Sencha.

If you are unsure which license is appropriate for your use, please contact the sales department at http://www.sencha.com/contact.

*/
Ext.require([
    'Ext.form.*',
    'Ext.data.*',
    'Ext.tip.QuickTipManager'
]);
 
Ext.onReady(function() {
    Ext.QuickTips.init();
 
    Ext.define('Employee', {
        extend: 'Ext.data.Model',
        fields: [
            {name: 'email',     type: 'string'},
            {name: 'title',     type: 'string'},
            {name: 'firstName', type: 'string'},
            {name: 'lastName',  type: 'string'},
            {name: 'phone-1',   type: 'string'},
            {name: 'phone-2',   type: 'string'},
            {name: 'phone-3',   type: 'string'},
            {name: 'hours',     type: 'number'},
            {name: 'minutes',   type: 'number'},
            {name: 'startDate', type: 'date'},
            {name: 'endDate',   type: 'date'}
        ]
    });
 
    var form = Ext.create('Ext.form.Panel', {
        renderTo: 'docbody',
        title   : 'FieldContainers',
        autoHeight: true,
        width   : 600,
        bodyPadding: 10,
        defaults: {
            anchor: '100%',
            labelWidth: 100
        },
        items   : [
            {
                xtype     : 'textfield',
                name      : 'email',
                fieldLabel: 'Email Address',
                vtype: 'email',
                msgTarget: 'side',
                allowBlank: false
            },
            {
                xtype: 'fieldcontainer',
                fieldLabel: 'Date Range',
                combineErrors: true,
                msgTarget : 'side',
                layout: 'hbox',
                defaults: {
                    flex: 1,
                    hideLabel: true
                },
                items: [
                    {
                        xtype     : 'datefield',
                        name      : 'startDate',
                        fieldLabel: 'Start',
                        margin: '0 5 0 0',
                        allowBlank: false
                    },
                    {
                        xtype     : 'datefield',
                        name      : 'endDate',
                        fieldLabel: 'End',
                        allowBlank: false
                    }
                ]
            },
            {
                xtype: 'fieldset',
                title: 'Details',
                collapsible: true,
                defaults: {
                    labelWidth: 89,
                    anchor: '100%',
                    layout: {
                        type: 'hbox',
                        defaultMargins: {top: 0, right: 5, bottom: 0, left: 0}
                    }
                },
                items: [
                    {
                        xtype: 'fieldcontainer',
                        fieldLabel: 'Phone',
                        combineErrors: true,
                        msgTarget: 'under',
                        defaults: {
                            hideLabel: true
                        },
                        items: [
                            {xtype: 'displayfield', value: '('},
                            {xtype: 'textfield',    fieldLabel: 'Phone 1', name: 'phone-1', width: 29, allowBlank: false},
                            {xtype: 'displayfield', value: ')'},
                            {xtype: 'textfield',    fieldLabel: 'Phone 2', name: 'phone-2', width: 29, allowBlank: false, margins: '0 5 0 0'},
                            {xtype: 'displayfield', value: '-'},
                            {xtype: 'textfield',    fieldLabel: 'Phone 3', name: 'phone-3', width: 48, allowBlank: false}
                        ]
                    },
                    {
                        xtype: 'fieldcontainer',
                        fieldLabel: 'Time worked',
                        combineErrors: false,
                        defaults: {
                            hideLabel: true
                        },
                        items: [
                           {
                               name : 'hours',
                               xtype: 'numberfield',
                               width: 48,
                               allowBlank: false
                           },
                           {
                               xtype: 'displayfield',
                               value: 'hours'
                           },
                           {
                               name : 'minutes',
                               xtype: 'numberfield',
                               width: 48,
                               allowBlank: false
                           },
                           {
                               xtype: 'displayfield',
                               value: 'mins'
                           }
                        ]
                    },
                    {
                        xtype : 'fieldcontainer',
                        combineErrors: true,
                        msgTarget: 'side',
                        fieldLabel: 'Full Name',
                        defaults: {
                            hideLabel: true
                        },
                        items : [
                            {
                                //the width of this field in the HBox layout is set directly
                                //the other 2 items are given flex: 1, so will share the rest of the space
                                width:          50,
 
                                xtype:          'combo',
                                mode:           'local',
                                value:          'mrs',
                                triggerAction:  'all',
                                forceSelection: true,
                                editable:       false,
                                fieldLabel:     'Title',
                                name:           'title',
                                displayField:   'name',
                                valueField:     'value',
                                queryMode: 'local',
                                store:          Ext.create('Ext.data.Store', {
                                    fields : ['name', 'value'],
                                    data   : [
                                        {name : 'Mr',   value: 'mr'},
                                        {name : 'Mrs',  value: 'mrs'},
                                        {name : 'Miss', value: 'miss'}
                                    ]
                                })
                            },
                            {
                                xtype: 'textfield',
                                flex : 1,
                                name : 'firstName',
                                fieldLabel: 'First',
                                allowBlank: false
                            },
                            {
                                xtype: 'textfield',
                                flex : 1,
                                name : 'lastName',
                                fieldLabel: 'Last',
                                allowBlank: false,
                                margins: '0'
                            }
                        ]
                    }
                ]
            }
            ,{
                xtype: 'fieldset',
                title: 'Funds',
                defaults: {
                    labelWidth: 89,
                    anchor: '100%',
                    layout: {
                        type: 'hbox',
                        defaultMargins: {top: 0, right: 5, bottom: 0, left: 0}
                    }
                },
              itemTemplate: {
                        xtype : 'fieldcontainer',
                        combineErrors: true,
                        msgTarget: 'side',
                        fieldLabel: '1',
                        defaults: {
                            hideLabel: true
                        },
                        items : [
                            {
                                width:          100,
 
                                xtype:          'combo',
                                mode:           'local',
                                triggerAction:  'all',
                                forceSelection: true,
                                editable:       false,
                                fieldLabel:     'Title',
                                name:           'choicefund1',
                                displayField:   'name',
                                valueField:     'value',
                                queryMode: 'local',
                                store:          Ext.create('Ext.data.Store', {
                                    fields : ['name', 'value'],
                                    data   : [
                                        {name : 'Growth Fund',   value: 'growth'},
                                        {name : 'Bond Fund',  value: 'bond'},
                                        {name : 'Managed Fund',  value: 'managed'},
                                        {name : 'Income Fund', value: 'income'}
                                    ]
                                })
                            },
                            {

                                xtype: 'textfield',

                                flex : 1,
                                emptyText: 'Enter percentage',
                                name : 'percentfund1',
                                allowBlank: false,
                                margins: '0'
                            }
 
                        ]
                    },
                items: [
                    {
                        xtype : 'fieldcontainer',
                        combineErrors: true,
                        msgTarget: 'side',
                        fieldLabel: '1',
                        defaults: {
                            hideLabel: true
                        },
                        items : [
                            {
                                width:          100,
 
                                xtype:          'combo',
                                mode:           'local',
                                triggerAction:  'all',
                                forceSelection: true,
                                editable:       false,
                                fieldLabel:     'Title',
                                name:           'choicefund1',
                                displayField:   'name',
                                valueField:     'value',
                                queryMode: 'local',
                                store:          Ext.create('Ext.data.Store', {
                                    fields : ['name', 'value'],
                                    data   : [
                                        {name : 'Growth Fund',   value: 'growth'},
                                        {name : 'Bond Fund',  value: 'bond'},
                                        {name : 'Managed Fund',  value: 'managed'},
                                        {name : 'Income Fund', value: 'income'}
                                    ]
                                })
                            },
                            {

                                xtype: 'textfield',

                                flex : 1,
                                emptyText: 'Enter percentage',
                                name : 'percentfund1',
                                allowBlank: false,
                                margins: '0'
                            },            {
                                xtype: 'button',
                                text   : 'Add another',
                                handler: function() {
                                  var container = this.up('fieldset');
                                  var config = Ext.apply({}, container.initialConfig.items[0]);
                                  config.fieldLabel = container.items.length + 1;
                                  container.add(config);
                                }
                            }
 
                        ]
                    }
                ]
            },{
                xtype: 'fieldset',
                title: 'Dependents',
                defaults: {
                    labelWidth: 89,
                    anchor: '100%',
                    layout: {
                        type: 'hbox',
                        defaultMargins: {top: 0, right: 5, bottom: 0, left: 0}
                    }
                },
                items: [
                    {
                        xtype : 'fieldcontainer',
                        combineErrors: true,
                        msgTarget: 'side',
                        fieldLabel: '1',
                        defaults: {
                            hideLabel: true
                        },
                        items : [
                            {
                                //the width of this field in the HBox layout is set directly
                                //the other 2 items are given flex: 1, so will share the rest of the space
                                width:          50,
 
                                xtype:          'combo',
                                mode:           'local',
                                value:          'mrs',
                                triggerAction:  'all',
                                forceSelection: true,
                                editable:       false,
                                fieldLabel:     'Title',
                                name:           'titledep1',
                                displayField:   'name',
                                valueField:     'value',
                                queryMode: 'local',
                                store:          Ext.create('Ext.data.Store', {
                                    fields : ['name', 'value'],
                                    data   : [
                                        {name : 'Mr',   value: 'mr'},
                                        {name : 'Mrs',  value: 'mrs'},
                                        {name : 'Miss', value: 'miss'}
                                    ]
                                })
                            },
                            {
                                xtype: 'textfield',
                                flex : 1,
                                name : 'firstdep1',
                                emptyText: 'first name',
                                fieldLabel: 'First',
                                allowBlank: false
                            },
                            {
                                xtype: 'textfield',
                                flex : 1,
                                name : 'lastdep1',
                                emptyText: 'last name',
                                fieldLabel: 'Last',
                                allowBlank: false,
                                margins: '0'
                            },            {
                                xtype: 'button',
                                text   : 'Add another',
                                handler: function() {
                                  var container = this.up('fieldset');
                                  var config = Ext.apply({}, container.initialConfig.items[0]);
                                  config.fieldLabel = container.items.length + 1;
                                  container.add(config);
                                }
                            }
 
                        ]
                    }
                ]
            }
 
        ],
        buttons: [
            {
                text   : 'Load test data',
                handler: function() {
                    this.up('form').getForm().loadRecord(Ext.ModelManager.create({
                        'email'    : 'abe@sencha.com',
                        'title'    : 'mr',
                        'firstName': 'Abraham',
                        'lastName' : 'Elias',
                        'startDate': '01/10/2003',
                        'endDate'  : '12/11/2009',
                        'phone-1'  : '555',
                        'phone-2'  : '123',
                        'phone-3'  : '4567',
                        'hours'    : 7,
                        'minutes'  : 15
                    }, 'Employee'));
                }
            },
            {
                text   : 'Save',
                handler: function() {
                    var form = this.up('form').getForm(),
                        s = '';
                    if (form.isValid()) {
                        Ext.iterate(form.getValues(), function(key, value) {
                            s += Ext.util.Format.format("{0} = {1}<br />", key, value);
                        }, this);

                        Ext.Msg.alert('Form Values', s);
                    }
                }
            },

            {
                text   : 'Reset',
                handler: function() {
                    this.up('form').getForm().reset();
                }
            }
        ]
    });
});


  
  </script>
</head>
<body id="docbody">

  <h1>FieldContainer Example</h1>

  <p>Several form fields can be placed onto the same row with a FieldContainer.</p>
  
  <p>The FieldContainer's child items are arranged like in any other container, using the
      <code>layout</code> configuration property. In this example, each FieldContainer
      is set to use an HBox layout - <a href="http://www.sencha.com/deploy/dev/docs/?class=Ext.layout.HBoxLayout">see
      the HBox docs for details</a> or the <a href="../layout/hbox.html">HBox layout example</a>.</p>
  
  <p>FieldContainers can be configured with the combineErrors option, which combines errors from
      the sub fields and presents them at the container level.</p>

  <p>In this example the Date Range, Phone and Full Name items have this option enabled, and
      the Time worked item does not. The <a href="http://www.sencha.com/deploy/dev/docs/?class=Ext.form.Labelable&member=msgTarget">msgTarget</a>
      config option is fully supported, so errors can be rendered to any of the supported locations.</p>

  <p>The js is not minified so it is readable. See <a href="fieldcontainer.js">fieldcontainer.js</a>.</p>
</body>
</html>

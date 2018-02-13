Ext.define('Melisa.billing.view.desktop.customers.add.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.billingCustomersAddForm',
    
    requires: [
        'Melisa.billing.view.desktop.repositories.Combo',
        'Melisa.people.view.desktop.settlements.PostalCode',
        'Melisa.people.view.desktop.countries.ComboDefault',
        'Melisa.people.view.desktop.states.ComboDefault',
        'Melisa.people.view.desktop.municipalities.ComboDefault'
    ],
    
    defaults: {
        xtype: 'container',
        layout: 'hbox',
        defaults: {
            allowBlank: false,
            flex: 1
        }
    },
    items: [
        {
            xtype: 'billingRepositoriesCombo',
            anchor: '100%'
        },
        {
            items: [
                {
                    xtype: 'textfield',
                    fieldLabel: 'Razón social',
                    name: 'name',
                    itemId: 'txtBusinessName',
                    margin: '0 10 0 0'
                },
                {
                    xtype: 'textfield',
                    fieldLabel: 'R. F. C.',
                    name: 'rfc',
                    width: 150,
                    maxLength: 13,
                    flex: null
                }
            ]
        },
        {
            items: [
                {
                    xtype: 'combodefault',
                    fieldLabel: 'Forma de pago',
                    name: 'idWaytopay',
                    margin: '0 10 0 0',
                    pageSize: 25,
                    bind: {
                        store: '{waytopay}'
                    }
                },
                {
                    xtype: 'textfield',
                    fieldLabel: 'Correo electrónico',
                    name: 'email',
                    vtype: 'email',
                    allowBlank: true
                }
            ]
        },
        {
            items: [
                {
                    xtype: 'numberfield',
                    name: 'expirationDays',
                    fieldLabel: 'Días de vencimiento',
                    allowBlank: true
                },
                {
                    xtype: 'peopleCountriesCombo',
                    margin: '0 0 0 10'
                }
            ]
        },
        {
            items: [
                {
                    xtype: 'peopleSettlementsPostalCode',
                    listeners: {
                        select: 'onSelectPostalCode'
                    }
                },
                {
                    xtype: 'peopleStatesCombo',
                    itemId: 'cmbStates',
                    margin: '0 0 0 10'
                }              
            ]
        },
        {
            items: [
                {
                    xtype: 'peopleMunicipalitiesCombo',
                    itemId: 'cmbMunicipalities'
                },
                {
                    xtype: 'textfield',
                    fieldLabel: 'Colonia',
                    name: 'colony',
                    itemId: 'txtColony',
                    margin: '0 0 0 10'
                }
            ]
        },
        {
            items: [
                {
                    xtype: 'textfield',
                    fieldLabel: 'Domicilio',
                    name: 'address',
                    itemId: 'txtAddress'
                }
            ]
        },
        {
            items: [
                {
                    xtype: 'textfield',
                    fieldLabel: 'Número exterior',
                    name: 'exteriorNumber'
                },                
                {
                    xtype: 'textfield',
                    fieldLabel: 'Número interior',
                    name: 'interiorNumber',
                    margin: '0 10',
                    allowBlank: true
                },
                {
                    xtype: 'numberfield',
                    name: 'quota',
                    fieldLabel: 'Quota',
                    margin: '0 10 0 0',
                    minValue: 0,
                    allowBlank: true
                },
                {
                    xtype: 'checkbox',
                    name: 'active',
                    fieldLabel: 'Activo',
                    checked: true
                }
            ]
        }
    ]    
});

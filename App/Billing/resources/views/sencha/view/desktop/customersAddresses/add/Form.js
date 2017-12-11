Ext.define('Melisa.billing.view.desktop.customersAddresses.add.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.billingCustomersAddressesAddForm',
    
    requires: [
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
            items: [
                {
                    xtype: 'peopleCountriesCombo'
                },
                {
                    xtype: 'peopleSettlementsPostalCode',
                    margin: '0 0 0 10',
                    listeners: {
                        select: 'onSelectPostalCode'
                    }
                }
            ]
        },
        {
            items: [
                {
                    xtype: 'peopleStatesCombo',
                    itemId: 'cmbStates'
                },
                {
                    xtype: 'peopleMunicipalitiesCombo',
                    itemId: 'cmbMunicipalities',
                    margin: '0 0 0 10'
                }
            ]
        },
        {
            items: [                
                {
                    xtype: 'textfield',
                    fieldLabel: 'Colonia',
                    name: 'colony',
                    itemId: 'txtColony'
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
                    xtype: 'numberfield',
                    fieldLabel: 'Número exterior',
                    name: 'exteriorNumber',
                    margin: '0 10 0 0'
                },                
                {
                    xtype: 'numberfield',
                    fieldLabel: 'Número interior',
                    name: 'interiorNumber',
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
                }
            ]
        },
        {
            items: [
                {
                    xtype: 'checkbox',
                    name: 'active',
                    fieldLabel: 'Activo',
                    checked: true
                },
                {
                    xtype: 'checkbox',
                    name: 'isDefault',
                    fieldLabel: 'Default',
                    margin: '0 0 0 10'
                }
            ]
        }
    ]    
});

Ext.define('Melisa.billing.view.desktop.my.customers.add.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.billingMyCustomersAddForm',
    
    requires: [
        'Melisa.people.view.desktop.settlements.PostalCode',
        'Melisa.people.view.desktop.countries.ComboDefault',
        'Melisa.people.view.desktop.states.ComboDefault',
        'Melisa.people.view.desktop.municipalities.ComboDefault',
        'Melisa.ux.ComboAutoSelect'
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
                    xtype: 'textfield',
                    fieldLabel: 'Nombre',
                    name: 'name',
                    itemId: 'txtBusinessName'
                }
            ]
        },
        {
            items: [
                {
                    xtype: 'textfield',
                    fieldLabel: 'R. F. C.',
                    name: 'rfc',
                    margin: '0 10 0 0',
                    flex: null,
                    maxLength: 13,
                    width: 140
                },
                {
                    xtype: 'peopleCountriesCombo'
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
                    xtype: 'checkbox',
                    name: 'active',
                    fieldLabel: 'Activo',
                    checked: true
                }
            ]
        }
    ]    
});

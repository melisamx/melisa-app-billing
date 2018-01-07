Ext.define('Melisa.billing.view.desktop.customers.update.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.billingCustomersUpdateForm',
    
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
                    allowBlank: true,
                    margin: '0 10 0 0'
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

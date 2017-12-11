Ext.define('Melisa.billing.view.desktop.customers.add.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.billingCustomersAddForm',
    
    requires: [
        'Melisa.billing.view.desktop.repositories.Combo'
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
                    xtype: 'checkbox',
                    name: 'active',
                    fieldLabel: 'Activo',
                    margin: '0 10',
                    checked: true
                }
            ]
        }
    ]    
});

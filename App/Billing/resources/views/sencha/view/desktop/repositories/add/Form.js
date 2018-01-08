Ext.define('Melisa.billing.view.desktop.repositories.add.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.billingRepositoriesAddForm',
    
    defaults: {
        allowBlank: false,
        anchor: '100%'
    },
    items: [
        {
            xtype: 'textfield',
            name: 'name',
            fieldLabel: 'Nombre',
            itemId: 'txtName'
        },
        {
            xtype: 'numberfield',
            name: 'expirationDays',
            fieldLabel: 'Días de vencimiento'
        },
        {
            xtype: 'container',
            layout: 'hbox',
            defaults: {
                flex: 1
            },
            items: [
                {
                    xtype: 'checkbox',
                    name: 'active',
                    fieldLabel: 'Activo',
                    maring: '0 10 0 0',
                    checked: true
                },
                {
                    xtype: 'checkbox',
                    name: 'allowChangeQuota',
                    fieldLabel: 'Permitir cambiar cuota',
                    checked: false
                }
            ]
        },
        {
            xtype: 'numberfield',
            name: 'quota',
            fieldLabel: 'Couta',
            allowDecimals: true
        }
    ]
});

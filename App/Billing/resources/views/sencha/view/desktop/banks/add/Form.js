Ext.define('Melisa.billing.view.desktop.banks.add.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.billingBanksAddForm',
    
    defaults: {
        allowBlank: false,
        anchor: '100%'
    },
    items: [
        {
            xtype: 'numberfield',
            name: 'key',
            fieldLabel: 'Clave',
            itemId: 'txtKey'
        },
        {
            xtype: 'textfield',
            name: 'shortname',
            fieldLabel: 'Nombre corto'
        },
        {
            xtype: 'textfield',
            name: 'name',
            fieldLabel: 'Nombre'
        },
        {
            xtype: 'checkbox',
            name: 'active',
            fieldLabel: 'Activo',
            checked: true
        }
    ]
});

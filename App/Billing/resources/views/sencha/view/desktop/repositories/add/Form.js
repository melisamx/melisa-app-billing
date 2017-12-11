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
            xtype: 'checkbox',
            name: 'active',
            fieldLabel: 'Activo',
            checked: true
        }
    ]
});

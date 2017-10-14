Ext.define('Melisa.billing.view.desktop.customersContacts.add.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.billingCustomersContactsAddForm',
    
    defaults: {
        anchor: '100%'
    },
    items: [
        {
            xtype: 'combodefault',
            fieldLabel: 'Contacto a asociar',
            name: 'idPeople',
            bind: {
                store: '{contacts}'
            }
        },
        {
            xtype: 'checkbox',
            name: 'active',
            fieldLabel: 'Activo',
            checked: true
        }
    ]    
});

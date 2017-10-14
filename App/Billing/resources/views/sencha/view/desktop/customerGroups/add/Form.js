Ext.define('Melisa.billing.view.desktop.customerGroups.add.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.billingCustomerGroupsAddForm',
    
    defaults: {
        anchor: '100%'
    },
    items: [
        {
            xtype: 'textfield',
            fieldLabel: 'Nombre',
            name: 'name',
            itemId: 'txtName',
            allowBlank: false
        },
        {
            xtype: 'checkbox',
            name: 'active',
            fieldLabel: 'Activo',
            checked: true
        }
    ]    
});

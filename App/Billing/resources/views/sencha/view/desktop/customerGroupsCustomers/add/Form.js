Ext.define('Melisa.billing.view.desktop.customerGroupsCustomers.add.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.billingCustomerGroupsCustomersAddForm',
    
    defaults: {
        anchor: '100%',
        allowBlank: false
    },
    items: [
        {
            xtype: 'combodefault',
            fieldLabel: 'Cliente a incluir en el grupo',
            name: 'idCustomer',
            itemId: 'cmbCustomers',
            pageSize: 25,
            listConfig: {
                emptyText: 'No hay clientes',
                deferEmptyText: false
            },
            bind: {
                store: '{customers}'
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

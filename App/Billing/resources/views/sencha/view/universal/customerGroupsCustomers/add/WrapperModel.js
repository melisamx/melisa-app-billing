Ext.define('Melisa.billing.view.universal.customerGroupsCustomers.add.WrapperModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.billingCustomerGroupsCustomersAdd',
        
    data: {
        fieldsHidden: [
            'idCustomerGroup'
        ]
    },
    stores: {
        customers: {
            proxy: {
                type: 'ajax',
                url: '{modules.customers}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        }
    }    
});

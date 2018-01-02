Ext.define('Melisa.billing.view.universal.my.customers.view.WrapperModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.billingMyCustomerView',
    
    stores: {
        customers: {
            autoLoad: true,
            remoteFilter: true,
            proxy: {
                type: 'ajax',
                url: '{modules.customers}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        },
        customersAddresses: {
            remoteFilter: true,
            groupField: 'bank',
            filters: [
                {
                    property: 'idCustomer',
                    value: '{idCustomer}',
                    operator: '='
                }
            ],
            proxy: {
                type: 'ajax',
                url: '{modules.customersAddresses}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        }
    }
    
});

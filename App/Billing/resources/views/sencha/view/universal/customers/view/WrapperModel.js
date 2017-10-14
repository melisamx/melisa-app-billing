Ext.define('Melisa.billing.view.universal.customers.view.WrapperModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.billingCustomerView',
    
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
        customersCommissionAgents: {
            remoteFilter: true,
            filters: [
                {
                    property: 'idCustomer',
                    value: '{idCustomer}',
                    operator: '='
                }
            ],
            proxy: {
                type: 'ajax',
                url: '{modules.customersCommissionAgents}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        },
        customersDealers: {
            remoteFilter: true,
            filters: [
                {
                    property: 'idCustomer',
                    value: '{idCustomer}',
                    operator: '='
                }
            ],
            proxy: {
                type: 'ajax',
                url: '{modules.customersDealers}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        },
        customersContacts: {
            remoteFilter: true,
            filters: [
                {
                    property: 'idCustomer',
                    value: '{idCustomer}',
                    operator: '='
                }
            ],
            proxy: {
                type: 'ajax',
                url: '{modules.customersContacts}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        },
        customersBanksAccounts: {
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
                url: '{modules.customersBanksAccounts}',
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

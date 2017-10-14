Ext.define('Melisa.billing.view.universal.customerGroups.view.WrapperModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.billingCustomerGroupsView',
    
    stores: {
        customerGroups: {
            autoLoad: true,
            remoteFilter: true,
            proxy: {
                type: 'ajax',
                url: '{modules.customerGroups}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        },
        customers: {
            remoteFilter: true,
            filters: [
                {
                    property: 'idCustomerGroup',
                    value: '{idCustomerGroup}',
                    operator: '='
                }
            ],
            proxy: {
                type: 'ajax',
                url: '{modules.customers}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        },
        identities: {
            remoteFilter: true,
            filters: [
                {
                    property: 'idCustomerGroup',
                    value: '{idCustomerGroup}',
                    operator: '='
                }
            ],
            proxy: {
                type: 'ajax',
                url: '{modules.identities}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        }
    }
    
});

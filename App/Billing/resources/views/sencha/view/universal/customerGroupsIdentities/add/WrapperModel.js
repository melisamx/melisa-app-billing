Ext.define('Melisa.billing.view.universal.customerGroupsIdentities.add.WrapperModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.billingCustomerGroupsIdentitiesAdd',
        
    data: {
        fieldsHidden: [
            'idCustomerGroup'
        ]
    },
    stores: {
        identities: {
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

Ext.define('Melisa.billing.view.universal.customers.add.WrapperModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.billingCustomersAdd',
        
    stores: {
        repositories: {
            proxy: {
                type: 'ajax',
                url: '{modules.repositories}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        },
        waytopay: {
            proxy: {
                type: 'ajax',
                url: '{modules.waytopay}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        }
    }    
});

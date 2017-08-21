Ext.define('Melisa.billing.view.universal.debtsToPay.add.WrapperModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.billingDebtsToPayAdd',
    
    stores: {
        accounts: {
            remoteFilter: true,
            proxy: {
                type: 'ajax',
                url: '{modules.accounts}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        }
    }
    
});

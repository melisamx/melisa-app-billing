Ext.define('Melisa.billing.view.universal.accountingAccounts.view.WrapperModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.billingAccountingAccountsView',
    
    stores: {
        accountingAccounts: {
            autoLoad: true,
            remoteFilter: true,
            proxy: {
                type: 'ajax',
                url: '{modules.accountingAccounts}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        }
    }
    
});

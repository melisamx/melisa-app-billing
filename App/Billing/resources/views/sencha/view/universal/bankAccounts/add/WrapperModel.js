Ext.define('Melisa.billing.view.universal.bankAccounts.add.WrapperModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.billingBankAccountsAdd',
    
    stores: {
        banks: {
            autoLoad: false,
            remoteFilter: true,
            proxy: {
                type: 'ajax',
                url: '{modules.banks}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        }
    }
    
});

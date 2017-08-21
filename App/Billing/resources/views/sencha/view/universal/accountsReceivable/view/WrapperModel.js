Ext.define('Melisa.billing.view.universal.accountsReceivable.view.WrapperModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.billingAccountsReceivableView',
    
    stores: {
        accountsReceivable: {
            autoLoad: true,
            remoteFilter: true,
            proxy: {
                type: 'ajax',
                url: '{modules.accountsReceivable}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            },
            listeners: {
                datachanged: 'onDataChangedAccountsReceivable'
            }
        }
    }
    
});

Ext.define('Melisa.billing.view.universal.debtsToPay.view.WrapperModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.billingDebtsToPayView',
    
    stores: {
        debtsToPay: {
            autoLoad: true,
            remoteFilter: true,
            proxy: {
                type: 'ajax',
                url: '{modules.debtsToPay}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            },
            listeners: {
                datachanged: 'onDataChangedDebtsToPay'
            }
        }
    }
    
});

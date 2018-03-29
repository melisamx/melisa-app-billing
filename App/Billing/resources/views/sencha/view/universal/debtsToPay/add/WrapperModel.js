Ext.define('Melisa.billing.view.universal.debtsToPay.add.WrapperModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.billingDebtsToPayAdd',
    
    stores: {
        providers: {
            remoteFilter: true,
            proxy: {
                type: 'ajax',
                url: '{modules.providers}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        }
    }
    
});

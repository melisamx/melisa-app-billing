Ext.define('Melisa.billing.view.universal.banks.view.WrapperModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.billingBanksView',
    
    stores: {
        banks: {
            autoLoad: true,
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

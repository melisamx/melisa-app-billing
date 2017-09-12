Ext.define('Melisa.billing.view.universal.exchangeRates.view.WrapperModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.billingExchangeRatesView',
        
    stores: {
        exchangeRates: {
            groupField: 'date',
            groupDir: 'desc',
            autoLoad: true,
            remoteFilter: true,
            proxy: {
                type: 'ajax',
                url: '{modules.exchangeRates}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        }
    }
    
});

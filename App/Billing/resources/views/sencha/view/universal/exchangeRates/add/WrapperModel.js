Ext.define('Melisa.billing.view.universal.exchangeRates.add.WrapperModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.billingExchangeRatesAdd',
    
    stores: {
        coins: {
            proxy: {
                type: 'ajax',
                url: '{modules.coins}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        }
    }    
});

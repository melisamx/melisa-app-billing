Ext.define('Melisa.billing.view.desktop.exchangeRates.view.WrapperController', {
    extend: 'Melisa.controller.View',
    alias: 'controller.billingExchangeRatesView',
    
    requires: [
        'Melisa.controller.View'
    ],
    
    listen: {
        global: {
            'app.billing.exchangeRates.update.success': 'onUpdatedRecord',
            'app.billing.exchangeRates.create.success': 'onUpdatedRecord'
        }
    },
    
    storeReload: 'exchangeRates',
    windowReportConfig: {
        title: 'Tipo de cambio'
    }
    
});

Ext.define('Melisa.billing.view.desktop.banks.view.WrapperController', {
    extend: 'Melisa.controller.View',
    alias: 'controller.billingBanksView',
    
    requires: [
        'Melisa.controller.View'
    ],
    
    listen: {
        global: {
            'event.billing.banks.update.success': 'onUpdatedRecord',
            'event.billing.banks.create.success': 'onUpdatedRecord'
        }
    },
    
    storeReload: 'banks',
    windowReportConfig: {
        title: 'Banco'
    }
    
});

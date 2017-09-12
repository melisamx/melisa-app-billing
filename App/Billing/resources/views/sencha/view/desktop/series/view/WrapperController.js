Ext.define('Melisa.billing.view.desktop.series.view.WrapperController', {
    extend: 'Melisa.controller.View',
    alias: 'controller.billingSeriesView',
    
    requires: [
        'Melisa.controller.View'
    ],
    
    listen: {
        global: {
            'event.billing.series.update.success': 'onUpdatedRecord',
            'event.billing.series.delete.success': 'onUpdatedRecord'
        }
    },
    
    storeReload: 'series',
    windowReportConfig: {
        title: 'Serie'
    }
    
});
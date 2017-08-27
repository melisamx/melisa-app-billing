Ext.define('Melisa.billing.view.desktop.csd.view.WrapperController', {
    extend: 'Melisa.controller.View',
    alias: 'controller.billingCsdView',
    
    requires: [
        'Melisa.controller.View'
    ],
    
    listen: {
        global: {
            'event.billing.csd.create.success': 'onUpdatedRecord',
            'event.billing.csd.update.success': 'onUpdatedRecord',
            'event.billing.csd.delete.success': 'onUpdatedRecord'
        }
    },
    
    storeReload: 'csd',
    windowReportConfig: {
        title: 'Certificado de sello digital'
    }
    
});

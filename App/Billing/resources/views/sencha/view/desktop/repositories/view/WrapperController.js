Ext.define('Melisa.billing.view.desktop.repositories.view.WrapperController', {
    extend: 'Melisa.controller.View',
    alias: 'controller.billingRepositoriesView',
    
    requires: [
        'Melisa.controller.View'
    ],
    
    listen: {
        global: {
            'event.billing.repositories.update.success': 'onUpdatedRecord',
            'event.billing.repositories.create.success': 'onUpdatedRecord'
        }
    },
    
    storeReload: 'repositories',
    windowReportConfig: {
        title: 'Repositorio'
    }
    
});

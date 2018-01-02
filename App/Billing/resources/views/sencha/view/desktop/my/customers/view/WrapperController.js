Ext.define('Melisa.billing.view.desktop.my.customers.view.WrapperController', {
    extend: 'Melisa.controller.View',
    alias: 'controller.billingMyCustomersView',
    
    requires: [
        'Melisa.controller.View'
    ],
    
    listen: {
        global: {
            'event.billing.my.customers.update.success': 'onUpdatedRecord',
            'event.billing.my.customers.create.success': 'onUpdatedRecord',
            'event.billing.my.customers.addresses.create.success': 'onUpdatedStoreAddresses'
        }
    },
    
    storeReload: 'customers',
    windowReportConfig: {
        title: 'Mi razón social'
    },
    
    onUpdatedStoreAddresses: function() {
        this.getViewModel().getStore('customersAddresses').load();
    }
    
});

Ext.define('Melisa.billing.view.desktop.accountsReceivable.view.WrapperController', {
    extend: 'Melisa.controller.View',
    alias: 'controller.billingAccountsReceivableView',
    
    requires: [
        'Melisa.controller.View'
    ],
    
    listen: {
        global: {
            'event.billing.accountsReceivable.cancel.success': 'onUpdatedRecord',
            'event.billing.accountsReceivable.create.success': 'onUpdatedRecord'
        }
    },
    
    storeReload: 'accountsReceivable',
    windowReportConfig: {
        title: 'Cuenta por cobrar'
    },
    
    onDataChangedAccountsReceivable: function(store) {
        var me = this,
            vm = me.getViewModel(),
            firstRecord = store.first(),
            total = firstRecord ? firstRecord.get('totalCharged') : 0,
            totalExpired = firstRecord ? firstRecord.get('totalChargedExpired') : 0;
        
        vm.set({
            total: total,
            totalExpired: totalExpired
        });
    }
    
});

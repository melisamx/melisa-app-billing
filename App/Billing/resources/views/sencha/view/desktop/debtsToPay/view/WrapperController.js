Ext.define('Melisa.billing.view.desktop.debtsToPay.view.WrapperController', {
    extend: 'Melisa.controller.View',
    alias: 'controller.billingDebtsToPayView',
    
    requires: [
        'Melisa.controller.View'
    ],
    
    listen: {
        global: {
            'event.billing.debtsToPay.cancel.success': 'onUpdatedRecord',
            'event.billing.debtsToPay.create.success': 'onUpdatedRecord'
        }
    },
    
    storeReload: 'debtsToPay',
    windowReportConfig: {
        title: 'Cuenta por pagar'
    },
    
    onDataChangedDebtsToPay: function(store) {
        var me = this,
            vm = me.getViewModel(),
            firstRecord = store.first(),
            total = firstRecord ? firstRecord.get('totalPayable') : 0,
            totalExpired = firstRecord ? firstRecord.get('totalPayableExpired') : 0;
        
        vm.set({
            total: total,
            totalExpired: totalExpired
        });
    }
    
});

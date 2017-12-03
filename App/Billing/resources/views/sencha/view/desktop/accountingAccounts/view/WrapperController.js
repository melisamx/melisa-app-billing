Ext.define('Melisa.billing.view.desktop.accountingAccounts.view.WrapperController', {
    extend: 'Melisa.controller.View',
    alias: 'controller.billingAccountingAccountsView',
    
    requires: [
        'Melisa.controller.View'
    ],
    
    listen: {
        global: {
            'event.billing.accountingAccounts.update.success': 'onUpdatedRecord',
            'event.billing.accountingAccounts.create.success': 'onUpdatedRecord'
        }
    },
    
    storeReload: 'accountingAccounts',
    windowReportConfig: {
        title: 'Cuenta bancaria'
    }
    
});

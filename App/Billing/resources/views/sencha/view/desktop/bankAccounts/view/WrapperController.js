Ext.define('Melisa.billing.view.desktop.bankAccounts.view.WrapperController', {
    extend: 'Melisa.controller.View',
    alias: 'controller.billingBankAccountsView',
    
    requires: [
        'Melisa.controller.View'
    ],
    
    listen: {
        global: {
            'event.billing.bankAccounts.update.success': 'onUpdatedRecord',
            'event.billing.bankAccounts.create.success': 'onUpdatedRecord'
        }
    },
    
    storeReload: 'bankAccounts',
    windowReportConfig: {
        title: 'Cuenta bancaria'
    }
    
});

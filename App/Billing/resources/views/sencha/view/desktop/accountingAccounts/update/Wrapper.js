Ext.define('Melisa.billing.view.desktop.accountingAccounts.update.Wrapper', {
    extend: 'Melisa.billing.view.desktop.accountingAccounts.add.Wrapper',
    
    requires: [
        'Melisa.billing.view.desktop.accountingAccounts.add.Wrapper',
        'Melisa.billing.view.desktop.accountingAccounts.update.WrapperController'
    ],
    
    controller: 'billingAccountingAccountsUpdate',
    
    listeners: {
        loaddata: 'onLoadData',
        successloadremotedata: 'onSuccessLoadData',
        beforeloaddata: 'onBeforeLoadData'
    }
    
});

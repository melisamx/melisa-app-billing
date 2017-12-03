Ext.define('Melisa.billing.view.desktop.bankAccounts.update.Wrapper', {
    extend: 'Melisa.billing.view.desktop.bankAccounts.add.Wrapper',
    
    requires: [
        'Melisa.billing.view.desktop.bankAccounts.add.Wrapper',
        'Melisa.billing.view.desktop.bankAccounts.update.WrapperController'
    ],
    
    controller: 'billingBankAccountsUpdate',
    
    listeners: {
        loaddata: 'onLoadData',
        successloadremotedata: 'onSuccessLoadData',
        beforeloaddata: 'onBeforeLoadData'
    }
    
});

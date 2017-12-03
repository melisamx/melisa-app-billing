Ext.define('Melisa.billing.view.desktop.accountingAccounts.update.WrapperController', {
    extend: 'Melisa.billing.view.desktop.accountingAccounts.add.WrapperController',
    alias: 'controller.billingAccountingAccountsUpdate',
    
    requires: [
        'Melisa.billing.view.desktop.accountingAccounts.add.WrapperController',
        'Melisa.controller.AppendFields',
        'Melisa.controller.LoadData',
        'Melisa.controller.Update'
    ],
    
    mixins: {
        appendfields: 'Melisa.controller.AppendFields',
        loaddata: 'Melisa.controller.LoadData',
        update: 'Melisa.controller.Update'
    },
    
    eventSuccess: 'event.billing.accountingAccounts.update.success'
    
});

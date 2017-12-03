Ext.define('Melisa.billing.view.desktop.bankAccounts.update.WrapperController', {
    extend: 'Melisa.billing.view.desktop.bankAccounts.add.WrapperController',
    alias: 'controller.billingBankAccountsUpdate',
    
    requires: [
        'Melisa.billing.view.desktop.bankAccounts.add.WrapperController',
        'Melisa.controller.AppendFields',
        'Melisa.controller.LoadData',
        'Melisa.controller.Update'
    ],
    
    mixins: {
        appendfields: 'Melisa.controller.AppendFields',
        loaddata: 'Melisa.controller.LoadData',
        update: 'Melisa.controller.Update'
    },
    
    eventSuccess: 'event.billing.bankAccounts.update.success',
    
    onSuccessLoadData: function (data) {        
        var me = this,
            vm = me.getViewModel(),
            banks = vm.getStore('banks');
        
        banks.add(data.bank);
        
        me.mixins.update.onSuccessLoadData.call(me, data);      
    }
    
});

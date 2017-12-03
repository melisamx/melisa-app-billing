Ext.define('Melisa.billing.view.desktop.customersAddresses.update.WrapperController', {
    extend: 'Melisa.billing.view.desktop.customersAddresses.add.WrapperController',
    alias: 'controller.billingCustomersAddressesUpdate',
    
    requires: [
        'Melisa.billing.view.desktop.customersAddresses.add.WrapperController'
    ],
    
    eventSuccess: 'event.billing.customersAddresses.update.success',
    
    onBeforeLoadData: function() {},
    
    onSuccessLoadData: function (data) {        
        var me = this,
            vm = me.getViewModel(),
            states = vm.getStore('states'),
            countries = vm.getStore('countries'),
            municipalities = vm.getStore('municipalities'),
            accountingAccounts = vm.getStore('accountingAccounts');
        
        countries.add(data.country);
        states.add(data.state);
        municipalities.add(data.municipality);
        
        if( !Ext.isEmpty(data.accounting_account)) {
            accountingAccounts.add(data.accounting_account);
        }
        
        me.mixins.update.onSuccessLoadData.call(me, data);      
    },
    
    /* cancel parent action */
    onReadyModule: function(){}
    
});

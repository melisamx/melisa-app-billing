Ext.define('Melisa.billing.view.desktop.my.customersAddresses.update.WrapperController', {
    extend: 'Melisa.billing.view.desktop.customersAddresses.update.WrapperController',
    alias: 'controller.billingMyCustomersAddressesUpdate',
    
    requires: [
        'Melisa.billing.view.desktop.customersAddresses.update.WrapperController'
    ],
    
    eventSuccess: 'event.billing.my.customersAddresses.update.success'
    
});

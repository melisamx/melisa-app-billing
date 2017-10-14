Ext.define('Melisa.billing.view.desktop.customers.view.WrapperController', {
    extend: 'Melisa.controller.View',
    alias: 'controller.billingCustomersView',
    
    requires: [
        'Melisa.controller.View'
    ],
    
    listen: {
        global: {
            'event.billing.customers.update.success': 'onUpdatedRecord',
            'event.billing.customers.create.success': 'onUpdatedRecord',
            'event.billing.customersContacts.create.success': 'onUpdatedStoreContacts',
            'event.billing.customersCommissionAgents.create.success': 'onUpdatedStoreCommissionAgents',
            'event.billing.customersDealers.create.success': 'onUpdatedStoreCustomersDealers',
            'event.billing.customersBanksAccounts.create.success': 'onUpdatedStoreBanksAccounts'
        }
    },
    
    storeReload: 'customers',
    windowReportConfig: {
        title: 'Cliente'
    },
    
    onUpdatedStoreCustomersDealers: function() {
        this.getViewModel().getStore('customersDealers').load();
    },
    
    onUpdatedStoreCommissionAgents: function() {
        this.getViewModel().getStore('customersCommissionAgents').load();
    },
    
    onUpdatedStoreBanksAccounts: function() {
        this.getViewModel().getStore('customersBanksAccounts').load();
    },
    
    onUpdatedStoreContacts: function() {
        this.getViewModel().getStore('customersContacts').load();
    },
    
    onSelectionChangeCustomers: function(sm, selection) {
        var me = this,
            vm = me.getViewModel(),
            view = me.getView();
    
        if( Ext.isEmpty(selection)) {
            vm.set('hiddenColumns', false);
            vm.getStore('customersCommissionAgents').removeAll();
            vm.getStore('customersDealers').removeAll();
            vm.getStore('customersContacts').removeAll();
            vm.getStore('customersBanksAccounts').removeAll();
            view.down('#panDetails').collapse();
            return;
        }
        
        view.down('#panDetails').expand();
        vm.set('hiddenColumns', true);
        vm.set('idCustomer', selection[0].get('id'));
        vm.notify();
        Ext.defer(function() {
            vm.getStore('customersCommissionAgents').load();
            vm.getStore('customersDealers').load();
            vm.getStore('customersContacts').load();
            vm.getStore('customersBanksAccounts').load();
        }, 500);
    },
    
    onLoadedModuleAsociate: function(module, options) {
        var me = this,
            griCustomers = me.lookup('griCustomers');
    
        module.fireEvent('loaddata', {
            id: griCustomers.getSelection()[0].get('id')
        }, options.launcher);
    },
    
    onAfterRenderDetails: function(cmp) {
        cmp.collapse();
    }
    
});

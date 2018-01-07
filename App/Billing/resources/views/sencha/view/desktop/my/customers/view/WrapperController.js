Ext.define('Melisa.billing.view.desktop.my.customers.view.WrapperController', {
    extend: 'Melisa.controller.View',
    alias: 'controller.billingMyCustomersView',
    
    requires: [
        'Melisa.controller.View'
    ],
    
    listen: {
        global: {
            'event.billing.my.customers.update.success': 'onUpdatedRecord',
            'event.billing.my.customers.create.success': 'onUpdatedRecord',
            'event.billing.my.customersAddresses.create.success': 'onUpdatedStoreAddresses',
            'event.billing.my.customersAddresses.update.success': 'onUpdatedStoreAddresses'
        }
    },
    
    storeReload: 'customers',
    windowReportConfig: {
        title: 'Mi razón social'
    },
    
    onUpdatedStoreAddresses: function() {
        this.getViewModel().getStore('customersAddresses').load();
    },
    
    onSelectionChangeCustomers: function(sm, selection) {
        var me = this,
            griCustomers = me.lookup('griCustomers');
    
        if( Ext.isEmpty(selection)) {
            griCustomers.getAction('viewAddresses').disable();
        } else {
            griCustomers.getAction('viewAddresses').enable();
        }
    },
    
    onClicBtnViewAddresses: function() {
        var me = this,
            vm = me.getViewModel(),
            view = me.getView(),
            selection = me.lookup('griCustomers').getSelection();
        
        if( Ext.isEmpty(selection)) {
            return;
        }
        
        vm.set('customer', selection[0]);
        vm.notify();
        vm.getStore('customersAddresses').load();
        view.setActiveItem(view.down('billingMyCustomersAddressesGrid'));
        view.setTitle('Direcciónes del cliente');
        view.setIconCls('x-fa fa-map-marker');
    },
    
    onClicBtnReturn: function() {
        var me = this,
            vm = me.getViewModel(),
            view = me.getView();
        view.setTitle(vm.get('wrapper').title);
        view.setIconCls(view.getInitialConfig().iconCls);
        view.setActiveItem(me.lookup('griCustomers'));
    },
    
    onLoadedModuleAsociate: function(module, options) {
        var me = this,
            griCustomers = me.lookup('griCustomers'),
            selection = griCustomers.getSelection()[0];
    
        module.fireEvent('loaddata', {
            id: selection.get('id'),
            idContributor: selection.get('idContributor')
        }, options.launcher);
    },
    
    onLoadedModuleAsociateUpdate: function(module, options) {
        var record = options.launcher.getViewModel().get('record');
    
        module.fireEvent('loaddata', {
            id: record.get('id'),
            idCustomer: record.get('idCustomer')
        }, options.launcher);
    }
    
});

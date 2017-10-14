Ext.define('Melisa.billing.view.desktop.customerGroups.view.WrapperController', {
    extend: 'Melisa.controller.View',
    alias: 'controller.billingCustomerGroupsView',
    
    requires: [
        'Melisa.controller.View'
    ],
    
    listen: {
        global: {
            'app.billing.customerGroups.update.success': 'onUpdatedRecord',
            'app.billing.customerGroups.create.success': 'onUpdatedRecord',
            'app.billing.customerGroupsCustomers.create.success': 'onReloadCustomers',
            'app.billing.customerGroupsIdentities.create.success': 'onReloadIdentities'
        }
    },
    
    storeReload: 'customerGroups',
    windowReportConfig: {
        title: 'Grupo de clientes'
    },
    
    onReloadCustomers: function() {
        this.getViewModel().getStore('customers').load();
    },
    
    onReloadIdentities: function() {
        this.getViewModel().getStore('identities').load();
    },
    
    onSelectionChangeCustomers: function(sm, selection) {
        var me = this,
            vm = me.getViewModel(),
            view = me.getView();
    
        if( Ext.isEmpty(selection)) {
            vm.set('hiddenColumns', false);
            vm.getStore('customers').removeAll();
            vm.getStore('identities').removeAll();
            view.down('#panDetails').collapse();
            return;
        }
        
        view.down('#panDetails').expand();
        vm.set('hiddenColumns', true);
        vm.set('idCustomerGroup', selection[0].get('id'));
        vm.notify();
        Ext.defer(function() {
            vm.getStore('customers').load();
            vm.getStore('identities').load();
        }, 500);
    },
    
    onLoadedModuleAsociate: function(module, options) {
        var me = this,
            griCustomerGroups = me.lookup('griCustomerGroups');
        console.log(griCustomerGroups);
        module.fireEvent('loaddata', {
            id: griCustomerGroups.getSelection()[0].get('id')
        }, options.launcher);
    },
    
    onAfterRenderDetails: function(cmp) {
        cmp.collapse();
    }
    
});

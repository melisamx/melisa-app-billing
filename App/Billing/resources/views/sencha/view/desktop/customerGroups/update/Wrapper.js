Ext.define('Melisa.billing.view.desktop.customerGroups.update.Wrapper', {
    extend: 'Melisa.billing.view.desktop.customerGroups.add.Wrapper',
    
    requires: [
        'Melisa.billing.view.desktop.customerGroups.add.Wrapper',        
        'Melisa.billing.view.desktop.customerGroups.update.WrapperController'        
    ],
    
    iconCls: 'x-fa fa-pencil',
    controller: 'billingCustomerGroupsUpdate',
    viewModel: {
        data: {
            mode: 'update'
        }
    },
    
    listeners: {
        loaddata: 'onLoadData',
        successloadremotedata: 'onSuccessLoadData',
        beforeloaddata: 'onBeforeLoadData'
    }
    
});

Ext.define('Melisa.billing.view.desktop.customers.update.Wrapper', {
    extend: 'Melisa.billing.view.desktop.customers.add.Wrapper',
    
    requires: [
        'Melisa.billing.view.desktop.customers.add.Wrapper',
        'Melisa.billing.view.desktop.customers.update.WrapperController'
    ],
    
    controller: 'billingCustomersUpdate',
    iconCls: 'x-fa fa-pencil',
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

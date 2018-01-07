Ext.define('Melisa.billing.view.desktop.customers.update.Wrapper', {
    extend: 'Melisa.billing.view.desktop.customers.add.Wrapper',
    
    requires: [
        'Melisa.billing.view.desktop.customers.add.Wrapper',
        'Melisa.billing.view.desktop.customers.update.WrapperController',
        'Melisa.billing.view.desktop.customers.update.Form'
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
    },
    items: [
        {
            xtype: 'billingCustomersUpdateForm'
        }
    ]
    
});

Ext.define('Melisa.billing.view.desktop.my.customers.update.Wrapper', {
    extend: 'Melisa.billing.view.desktop.my.customers.add.Wrapper',
    
    requires: [
        'Melisa.billing.view.desktop.my.customers.add.Wrapper',
        'Melisa.billing.view.desktop.my.customers.update.WrapperController',
        'Melisa.billing.view.desktop.my.customers.update.Form'
    ],
    
    controller: 'billingMyCustomersUpdate',
    iconCls: 'x-fa fa-pencil',
    plugins: 'responsive',
    responsiveConfig: {
        'width < 1200': {
            width: '100%',
            height: '100%'
        },
        'width >= 1201': {
            width: 1200,
            height: 480
        }
    },
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
            xtype: 'billingMyCustomersUpdateForm'
        }
    ]
    
});

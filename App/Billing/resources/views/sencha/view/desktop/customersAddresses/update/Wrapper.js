Ext.define('Melisa.billing.view.desktop.customersAddresses.update.Wrapper', {
    extend: 'Melisa.billing.view.desktop.customersAddresses.add.Wrapper',
    
    requires: [
        'Melisa.billing.view.desktop.customersAddresses.add.Wrapper',
        'Melisa.billing.view.desktop.customersAddresses.update.WrapperController'
    ],
    
    controller: 'billingCustomersAddressesUpdate',
    iconCls: 'x-fa fa-pencil',
    viewModel: {
        data: {
            mode: 'update',
            fieldsHidden: [
                'id',
                'idContributor'
            ]
        }
    },
    
    listeners: {
        loaddata: 'onLoadData',
        successloadremotedata: 'onSuccessLoadData',
        beforeloaddata: 'onBeforeLoadData'
    }
    
});

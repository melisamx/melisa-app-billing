Ext.define('Melisa.billing.view.desktop.repositories.update.Wrapper', {
    extend: 'Melisa.billing.view.desktop.repositories.add.Wrapper',
    
    requires: [
        'Melisa.billing.view.desktop.repositories.add.Wrapper',
        'Melisa.billing.view.desktop.repositories.update.WrapperController'
    ],
    
    controller: 'billingRepositoriesUpdate',
    
    listeners: {
        loaddata: 'onLoadData',
        successloadremotedata: 'onSuccessLoadData',
        beforeloaddata: 'onBeforeLoadData'
    }
    
});

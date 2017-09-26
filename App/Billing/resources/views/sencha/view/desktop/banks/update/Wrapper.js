Ext.define('Melisa.billing.view.desktop.banks.update.Wrapper', {
    extend: 'Melisa.billing.view.desktop.banks.add.Wrapper',
    
    requires: [
        'Melisa.billing.view.desktop.banks.add.Wrapper',
        'Melisa.billing.view.desktop.banks.update.WrapperController'
    ],
    
    controller: 'reserveEventsUpdate',
    
    listeners: {
        loaddata: 'onLoadData',
        successloadremotedata: 'onSuccessLoadData',
        beforeloaddata: 'onBeforeLoadData'
    }
    
});

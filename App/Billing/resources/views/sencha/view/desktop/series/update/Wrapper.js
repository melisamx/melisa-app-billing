Ext.define('Melisa.billing.view.desktop.series.update.Wrapper', {
    extend: 'Melisa.billing.view.desktop.series.add.Wrapper',
    
    requires: [
        'Melisa.billing.view.desktop.series.add.Wrapper',
        'Melisa.billing.view.desktop.series.update.WrapperController'
    ],
    
    controller: 'billingSeriesUpdate',
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
Ext.define('Melisa.billing.view.desktop.series.update.WrapperController', {
    extend: 'Melisa.billing.view.desktop.series.add.WrapperController',
    alias: 'controller.billingSeriesUpdate',
    
    requires: [
        'Melisa.controller.AppendFields',
        'Melisa.controller.LoadData',
        'Melisa.controller.Update'
    ],
    
    mixins: {
        appendfields: 'Melisa.controller.AppendFields',
        loaddata: 'Melisa.controller.LoadData',
        update: 'Melisa.controller.Update'
    },
    
    eventSuccess: 'event.billing.series.update.success'
});

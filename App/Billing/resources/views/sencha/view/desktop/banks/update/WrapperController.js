Ext.define('Melisa.billing.view.desktop.banks.update.WrapperController', {
    extend: 'Melisa.billing.view.desktop.banks.add.WrapperController',
    alias: 'controller.billingBanksUpdate',
    
    requires: [
        'Melisa.billing.view.desktop.banks.add.WrapperController',
        'Melisa.controller.AppendFields',
        'Melisa.controller.LoadData',
        'Melisa.controller.Update'
    ],
    
    mixins: {
        appendfields: 'Melisa.controller.AppendFields',
        loaddata: 'Melisa.controller.LoadData',
        update: 'Melisa.controller.Update'
    },
    
    eventSuccess: 'event.billing.banks.update.success'
    
});

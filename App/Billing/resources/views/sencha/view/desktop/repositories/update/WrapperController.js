Ext.define('Melisa.billing.view.desktop.repositories.update.WrapperController', {
    extend: 'Melisa.billing.view.desktop.repositories.add.WrapperController',
    alias: 'controller.billingRepositoriesUpdate',
    
    requires: [
        'Melisa.billing.view.desktop.repositories.add.WrapperController',
        'Melisa.controller.AppendFields',
        'Melisa.controller.LoadData',
        'Melisa.controller.Update'
    ],
    
    mixins: {
        appendfields: 'Melisa.controller.AppendFields',
        loaddata: 'Melisa.controller.LoadData',
        update: 'Melisa.controller.Update'
    },
    
    eventSuccess: 'event.billing.repositories.update.success'
    
});

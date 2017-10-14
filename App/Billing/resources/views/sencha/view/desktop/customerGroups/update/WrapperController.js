Ext.define('Melisa.billing.view.desktop.customerGroups.update.WrapperController', {
    extend: 'Melisa.controller.Create',
    alias: 'controller.billingCustomerGroupsUpdate',
    
    requires: [
        'Melisa.controller.Create',
        'Melisa.controller.AppendFields',
        'Melisa.controller.LoadData',
        'Melisa.controller.Update'
    ],
    
    mixins: {
        appendfields: 'Melisa.controller.AppendFields',
        loaddata: 'Melisa.controller.LoadData',
        update: 'Melisa.controller.Update'
    },
    
    eventSuccess: 'app.billing.customerGroups.create.success'
    
});

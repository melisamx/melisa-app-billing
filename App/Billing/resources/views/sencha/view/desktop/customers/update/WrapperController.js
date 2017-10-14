Ext.define('Melisa.billing.view.desktop.customers.update.WrapperController', {
    extend: 'Melisa.billing.view.desktop.customers.add.WrapperController',
    alias: 'controller.billingCustomersUpdate',
    
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
    
    eventSuccess: 'event.billing.customers.create.success',
    
    onSuccessLoadData: function (data) {        
        var me = this,
            vm = me.getViewModel(),
            repositories = vm.getStore('repositories'),
            waytopay = vm.getStore('waytopay');
        
        waytopay.add(data.waytopay);
        repositories.add(data.repository);
        me.getView().down('form').getForm().setValues(data.contributor);
        
        me.mixins.update.onSuccessLoadData.call(me, data);      
    }
});

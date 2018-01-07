Ext.define('Melisa.billing.view.desktop.my.customers.update.WrapperController', {
    extend: 'Melisa.billing.view.desktop.my.customers.add.WrapperController',
    alias: 'controller.billingMyCustomersUpdate',
    
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
    
    eventSuccess: 'event.billing.my.customers.update.success',
    
    onSuccessLoadData: function (data) {        
        var me = this,
            vm = me.getViewModel(),
            waytopay = vm.getStore('waytopay'),
            form = me.getView().down('form').getForm();
        
        waytopay.add(data.waytopay);
        form.setValues(data.contributor);       
        me.mixins.update.onSuccessLoadData.call(me, data);
    }
});

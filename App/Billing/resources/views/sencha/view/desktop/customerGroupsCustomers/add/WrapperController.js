Ext.define('Melisa.billing.view.desktop.customerGroupsCustomers.add.WrapperController', {
    extend: 'Melisa.controller.Create',
    alias: 'controller.billingCustomerGroupsCustomersAdd',
    
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
    
    control: {
        '#': {
            loaddata: 'onLoadData',
            successloadremotedata: 'onSuccessLoadData',
            beforeloaddata: 'onBeforeLoadData'
        }
    },
    
    eventSuccess: 'app.billing.customerGroupsCustomers.create.success',
    
    onBeforeLoadData: function(data) {
        var me = this;console.log(data);
        me.getViewModel().set('idCustomerGroup', data.id);
        me.mixins.update.onSuccessLoadData.call(me, {
            idCustomerGroup: data.id
        });
        return false;
    }
    
});

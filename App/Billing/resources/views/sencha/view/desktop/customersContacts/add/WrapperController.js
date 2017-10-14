Ext.define('Melisa.billing.view.desktop.customersContacts.add.WrapperController', {
    extend: 'Melisa.controller.Create',
    alias: 'controller.billingCustomersContactsAdd',
    
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
    
    eventSuccess: 'event.billing.customersContacts.create.success',
    
    onBeforeLoadData: function(data) {
        var me = this;console.log(data);
        me.getViewModel().set('idCustomer', data.id);
        me.mixins.update.onSuccessLoadData.call(me, {
            idCustomer: data.id
        });
        return false;
    }
    
});

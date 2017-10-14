Ext.define('Melisa.billing.view.desktop.customersAddresses.add.WrapperController', {
    extend: 'Melisa.controller.Create',
    alias: 'controller.billingCustomersAddressesAdd',
    
    requires: [
        'Melisa.controller.AppendFields',
        'Melisa.controller.LoadData',
        'Melisa.controller.Update',
        'Melisa.people.view.desktop.settlements.AutoSelectMixin',
        'Melisa.people.view.desktop.countries.AutoSelectMixin'
    ],
    
    mixins: {
        settlements: 'Melisa.people.view.desktop.settlements.AutoSelectMixin',
        countries: 'Melisa.people.view.desktop.countries.AutoSelectMixin',
        appendfields: 'Melisa.controller.AppendFields',
        loaddata: 'Melisa.controller.LoadData',
        update: 'Melisa.controller.Update'
    },
    
    eventSuccess: 'event.billing.customersAddresses.create.success',
    
    control: {
        '#': {
            ready: 'onReadyModule',
            loaddata: 'onLoadData',
            beforeloaddata: 'onBeforeLoadData'
        }
    },
    
    onBeforeLoadData: function(data) {
        var me = this;
        
        me.getViewModel().set('idContributor', data.idContributor);
        me.mixins.update.onSuccessLoadData.call(me, {
            idContributor: data.idContributor,
            idCustomer: data.id
        });
        return false;
    },
    
    autoSelectSettlement: function() {
        var me = this,
            view = me.getView(),
            txtAddress = view.down('#txtAddress');
        
        me.mixins.settlements.autoSelectSettlement.apply(me, arguments);
        txtAddress.focus();
    },
    
    onReadyModule: function() {
        var me = this;
        me.mixins.countries.autoSelectCountry.apply(me);
    }
    
});

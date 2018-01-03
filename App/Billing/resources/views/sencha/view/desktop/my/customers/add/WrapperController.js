Ext.define('Melisa.billing.view.desktop.my.customers.add.WrapperController', {
    extend: 'Melisa.controller.Create',
    alias: 'controller.billingMyCustomersAdd',
    
    requires: [
        'Melisa.people.view.desktop.settlements.AutoSelectMixin',
        'Melisa.people.view.desktop.countries.AutoSelectMixin'
    ],
    
    mixins: {
        settlements: 'Melisa.people.view.desktop.settlements.AutoSelectMixin',
        countries: 'Melisa.people.view.desktop.countries.AutoSelectMixin'
    },
    
    eventSuccess: 'event.billing.my.customers.create.success',
    
    control: {
        '#': {
            ready: 'onLoadedModule'
        }
    },
    
    autoSelectSettlement: function() {
        var me = this,
            view = me.getView(),
            txtAddress = view.down('#txtAddress');
        
        txtAddress.focus();
        me.mixins.settlements.autoSelectSettlement.apply(me, arguments);
    },
    
    onLoadedModule: function() {
        var me = this;
        me.mixins.countries.autoSelectCountry.apply(me);
    }
    
});

Ext.define('Melisa.billing.view.desktop.customers.add.WrapperController', {
    extend: 'Melisa.controller.Create',
    alias: 'controller.billingCustomersAdd',
    
    requires: [
        'Melisa.people.view.desktop.settlements.AutoSelectMixin',
        'Melisa.people.view.desktop.countries.AutoSelectMixin'
    ],
    
    mixins: {
        settlements: 'Melisa.people.view.desktop.settlements.AutoSelectMixin',
        countries: 'Melisa.people.view.desktop.countries.AutoSelectMixin'
    },
    
    eventSuccess: 'event.billing.customers.create.success',
    
    control: {
        '#': {
            ready: 'onLoadedModule',
            loadRepository: 'onLoadRepository'
        }
    },
    
    onLoadRepository: function(repository) {
        var me = this,
            vm = me.getViewModel(),
            view = me.getView(),
            repositories;
        vm.notify();
        repositories = vm.getStore('repositories');
        
        if( !repositories) {
            return;
        }
        
        repositories.add(repository.data);
        view.down('billingRepositoriesCombo').select(repository.get('id'));
        view.down('#txtBusinessName').on('render', function() {
            view.down('#txtBusinessName').focus();
        }, {
            single: true
        });
    },
    
    onSelectPostalCode: function(cmb, record) {
        var me = this,
            view = me.getView(),
            txtAddress = view.down('#txtAddress');
        /* necesario dar foco primero o seleccionara otro elemento */
        txtAddress.focus();
        me.mixins.settlements.autoSelectSettlement.apply(me, [record, true]);
    },
    
    onLoadedModule: function() {
        var me = this;
        me.mixins.countries.autoSelectCountry.apply(me);
    }
    
});

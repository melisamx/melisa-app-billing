Ext.define('Melisa.billing.view.desktop.exchangeRates.update.WrapperController', {
    extend: 'Melisa.billing.view.desktop.exchangeRates.add.WrapperController',
    alias: 'controller.billingExchangeRatesUpdate',
    
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
    
    onSuccessLoadData: function (data) {        
        var me = this,
            vm = me.getViewModel(),
            coins = vm.getStore('coins');
        
        coins.add(data.coin);
        me.mixins.update.onSuccessLoadData.call(me, data);     
    },
    
    onSuccesssubmit: function(event, response, action) {            
        Ext.GlobalEvents.fireEvent('app.billing.exchangeRates.update.success', action.result);
    }
    
});

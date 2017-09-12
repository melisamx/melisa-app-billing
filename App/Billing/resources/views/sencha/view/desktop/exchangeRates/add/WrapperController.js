Ext.define('Melisa.billing.view.desktop.exchangeRates.add.WrapperController', {
    extend: 'Melisa.controller.Create',
    alias: 'controller.billingExchangeRatesAdd',
    
    requires: [
        'Melisa.billing.view.universal.exchangeRates.add.WrapperController'
    ],
    
    mixins: {
        universal: 'Melisa.billing.view.universal.exchangeRates.add.WrapperController'
    },
    
    control: {
        '#': {
            successsubmit: 'onSuccesssubmit'
        }
    },
    
    save: function() {        
        var me = this;        
        me.mixins.universal.beforeSave.call(me);
        me.callParent();        
    },
    
    onSuccesssubmit: function(event, response, action) {            
        Ext.GlobalEvents.fireEvent('app.billing.exchangeRates.create.success', action.result);
    },
    
    onChangeDate: function() {
        var me = this,
            view = me.getView(),
            dfDate = me.lookup('dfDate').getValue(),
            date = Ext.util.Format.date(dfDate, 'd/m/Y');
        
        view.down('#conLinkDOF').setData({
            dates: Ext.Object.toQueryString({
                dfecha: date,
                hfecha: date
            })
        });
    }
    
});

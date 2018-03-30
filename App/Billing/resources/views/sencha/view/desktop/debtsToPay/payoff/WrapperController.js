Ext.define('Melisa.billing.view.desktop.debtsToPay.payoff.WrapperController', {
    extend: 'Melisa.controller.Create',
    alias: 'controller.billingDebtsToPayPayoff',
    
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
    
    eventSuccess: 'event.billing.debtsToPay.payoff.success',
    
    listeners: {
        selectedfile: 'onSelectedFile'
    },
    
    onSuccessLoadData: function(data) {
        var me = this,
            view = me.getView();
        view.setTitle([
            view.getTitle(),
            ' de ',
            data.provider.name
        ].join(''));
        data.paymentDate = new Date();
        me.mixins.update.onSuccessLoadData.call(me, data);
    },
    
    onSelectedFile: function(sel) {
        var me = this,
            txtFilePayment = me.getView().down('#txtFilePayment');
    
        txtFilePayment.setValue(sel[0].get('id'));
    },
    
    onLoadedModuleSelectFile: function(module, options) {        
        module.fireEvent('loaddata', this, 'selectedfile', {}, options.launcher);        
    }
    
});

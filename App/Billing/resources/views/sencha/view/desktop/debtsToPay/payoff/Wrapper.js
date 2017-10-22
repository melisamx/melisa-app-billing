Ext.define('Melisa.billing.view.desktop.debtsToPay.payoff.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.window.Add',
    
    requires: [
        'Melisa.billing.view.desktop.debtsToPay.payoff.Form',
        'Melisa.billing.view.desktop.debtsToPay.payoff.WrapperController'
    ],
    
    iconCls: 'x-fa fa-hand-paper-o',
    defaultFocus: 'txtFilePayment',
    controller: 'billingDebtsToPayPayoff',
    width: 700,
    height: 400,
    viewModel: {
        data: {
            mode: 'update'
        }
    },
    items: [
        {
            xtype: 'billingDebtsToPayPayoffForm'
        }
    ],
    
    listeners: {
        loaddata: 'onLoadData',
        successloadremotedata: 'onSuccessLoadData',
        beforeloaddata: 'onBeforeLoadData'
    }
});

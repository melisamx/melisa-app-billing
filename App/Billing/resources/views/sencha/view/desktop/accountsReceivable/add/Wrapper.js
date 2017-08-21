Ext.define('Melisa.billing.view.desktop.debtsToPay.add.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.window.Add',
    
    requires: [
        'Melisa.billing.view.desktop.debtsToPay.add.Form',
        'Melisa.billing.view.desktop.debtsToPay.add.WrapperController',
        'Melisa.billing.view.universal.debtsToPay.add.WrapperModel'
    ],
    
    iconCls: 'x-fa fa-hand-paper-o',
    defaultFocus: 'cmbAccounts',
    controller: 'billingDebtsToPayAdd',
    width: 500,
    height: 600,
    scrollable: true,
    viewModel: {
        type: 'billingDebtsToPayAdd'
    },
    items: [
        {
            xtype: 'billingDebtsToPayAddForm'
        }
    ]
});

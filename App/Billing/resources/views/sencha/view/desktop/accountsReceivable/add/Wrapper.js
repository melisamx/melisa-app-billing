Ext.define('Melisa.billing.view.desktop.accountsReceivable.add.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.window.Add',
    
    requires: [
        'Melisa.billing.view.desktop.accountsReceivable.add.Form',
        'Melisa.billing.view.desktop.accountsReceivable.add.WrapperController',
        'Melisa.billing.view.universal.accountsReceivable.add.WrapperModel'
    ],
    
    iconCls: 'x-fa fa-hand-paper-o',
    defaultFocus: 'cmbCustomers',
    controller: 'billingAccountsReceivableAdd',
    width: 500,
    height: 600,
    scrollable: true,
    viewModel: {
        type: 'billingAccountsReceivableAdd'
    },
    items: [
        {
            xtype: 'billingAccountsReceivableAddForm'
        }
    ]
});

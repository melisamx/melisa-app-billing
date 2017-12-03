Ext.define('Melisa.billing.view.desktop.accountingAccounts.add.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.window.Add',
    
    requires: [
        'Melisa.billing.view.desktop.accountingAccounts.add.Form',
        'Melisa.billing.view.desktop.accountingAccounts.add.WrapperController'
    ],
    
    iconCls: 'x-fa fa-users',
    defaultFocus: 'txtKey',
    controller: 'billingAccountingAccountsAdd',
    width: 400,
    height: 500,
    viewModel: {},
    items: [
        {
            xtype: 'billingAccountingAccountsAddForm'
        }
    ]
});

Ext.define('Melisa.billing.view.desktop.bankAccounts.add.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.window.Add',
    
    requires: [
        'Melisa.billing.view.desktop.bankAccounts.add.Form',
        'Melisa.billing.view.desktop.bankAccounts.add.WrapperController',
        'Melisa.billing.view.universal.bankAccounts.add.WrapperModel'
    ],
    
    iconCls: 'x-fa fa-credit-card',
    defaultFocus: 'cmbBanks',
    controller: 'billingBankAccountsAdd',
    width: 600,
    height: 520,
    viewModel: {
        type: 'billingBankAccountsAdd'
    },
    items: [
        {
            xtype: 'billingBankAccountsAddForm'
        }
    ]
});

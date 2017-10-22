Ext.define('Melisa.billing.view.desktop.customersBanksAccounts.add.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.window.Add',
    
    requires: [
        'Melisa.billing.view.desktop.customersBanksAccounts.add.Form',
        'Melisa.billing.view.desktop.customersBanksAccounts.add.WrapperController',
        'Melisa.billing.view.universal.customersBanksAccounts.add.WrapperModel'
    ],
    
    iconCls: 'x-fa fa-university',
    defaultFocus: 'txtBank',
    controller: 'billingCustomersBanksAccountsAdd',
    plugins: 'responsive',
    height: 480,
    responsiveConfig: {
        'width < 1200': {
            width: '100%'
        },
        'width >= 1200': {
            width: 1200
        }
    },
    viewModel: {
        type: 'billingCustomersBanksAccountsAdd'
    },
    items: [
        {
            xtype: 'billingCustomersBanksAccountsAddForm'
        }
    ],
    bbar: {
        xtype: 'toolbardefault'
    }
});

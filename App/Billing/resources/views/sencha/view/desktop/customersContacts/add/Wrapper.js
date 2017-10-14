Ext.define('Melisa.billing.view.desktop.customersContacts.add.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.window.Add',
    
    requires: [
        'Melisa.view.desktop.wrapper.window.Add',
        'Melisa.billing.view.desktop.customersContacts.add.Form',
        'Melisa.billing.view.desktop.customersContacts.add.WrapperController',
        'Melisa.billing.view.universal.customersContacts.add.WrapperModel'
    ],
    
    iconCls: 'x-fa fa-male',
    defaultFocus: 'tagDealers',
    controller: 'billingCustomersContactsAdd',
    height: '50%',
    plugins: 'responsive',
    minWidth: 600,
    responsiveConfig: {
        'width < 1200': {
            width: '100%'
        },
        'width >= 1400': {
            width: 1200
        }
    },
    viewModel: {
        type: 'billingCustomersContactsAdd'
    },
    items: [
        {
            xtype: 'billingCustomersContactsAddForm'
        }
    ],
    bbar: {
        xtype: 'toolbardefault'
    }
});

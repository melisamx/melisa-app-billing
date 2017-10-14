Ext.define('Melisa.billing.view.desktop.customerGroupsCustomers.add.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.window.Add',
    
    requires: [
        'Melisa.billing.view.desktop.customerGroupsCustomers.add.Form',
        'Melisa.billing.view.desktop.customerGroupsCustomers.add.WrapperController',
        'Melisa.billing.view.universal.customerGroupsCustomers.add.WrapperModel'
    ],
    
    iconCls: 'x-fa fa-users',
    defaultFocus: 'cmbCustomers',
    controller: 'billingCustomerGroupsCustomersAdd',
    layout: 'fit',
    width: 400,
    height: 380,
    modal: true,
    viewModel: {
        type: 'billingCustomerGroupsCustomersAdd'
    },
    items: [
        {
            xtype: 'billingCustomerGroupsCustomersAddForm'
        }
    ],
    bbar: {
        xtype: 'toolbardefault'
    }
});

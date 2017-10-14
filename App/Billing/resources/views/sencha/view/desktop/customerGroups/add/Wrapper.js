Ext.define('Melisa.billing.view.desktop.customerGroups.add.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.window.Add',
    
    requires: [
        'Melisa.controller.Create',
        'Melisa.view.desktop.wrapper.window.Add',
        'Melisa.billing.view.desktop.customerGroups.add.Form'
    ],
    
    iconCls: 'x-fa fa-users',
    defaultFocus: 'txtName',
    width: 350,
    height: 400,
    controller: {
        type: 'create',
        eventSuccess: 'app.billing.customerGroups.create.success'
    },
    viewModel: {},
    items: [
        {
            xtype: 'billingCustomerGroupsAddForm'
        }
    ],
    bbar: {
        xtype: 'toolbardefault'
    }
});

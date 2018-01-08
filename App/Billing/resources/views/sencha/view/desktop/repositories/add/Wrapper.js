Ext.define('Melisa.billing.view.desktop.repositories.add.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.window.Add',
    
    requires: [
        'Melisa.billing.view.desktop.repositories.add.Form',
        'Melisa.billing.view.desktop.repositories.add.WrapperController'
    ],
    
    iconCls: 'x-fa fa-database',
    defaultFocus: 'txtName',
    controller: 'billingRepositoriesAdd',
    width: 400,
    height: 480,
    viewModel: {},
    items: [
        {
            xtype: 'billingRepositoriesAddForm'
        }
    ]
});

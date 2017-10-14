Ext.define('Melisa.billing.view.desktop.customerGroupsIdentities.add.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.window.Add',
    
    requires: [
        'Melisa.billing.view.desktop.customerGroupsIdentities.add.Form',
        'Melisa.billing.view.desktop.customerGroupsIdentities.add.WrapperController',
        'Melisa.billing.view.universal.customerGroupsIdentities.add.WrapperModel'
    ],
    
    iconCls: 'x-fa fa-male',
    defaultFocus: 'cmbIdentities',
    controller: 'billingCustomerGroupsIdentitiesAdd',
    layout: 'fit',
    width: 400,
    height: 380,
    modal: true,
    viewModel: {
        type: 'billingCustomerGroupsIdentitiesAdd'
    },
    items: [
        {
            xtype: 'billingCustomerGroupsIdentitiesAddForm'
        }
    ],
    bbar: {
        xtype: 'toolbardefault'
    }
});

Ext.define('Melisa.billing.view.desktop.customerGroups.view.Wrapper', {
    extend: 'Ext.panel.Panel',
    
    requires: [
        'Melisa.core.Module',
        'Melisa.ux.grid.Filters',
        'Melisa.ux.FloatingButton',
        'Melisa.ux.confirmation.Button',
        'Melisa.billing.view.desktop.customerGroups.view.Grid',
        'Melisa.billing.view.desktop.customerGroups.view.Customers',
        'Melisa.billing.view.desktop.customerGroups.view.Identities',
        'Melisa.billing.view.desktop.customerGroups.view.WrapperController',
        'Melisa.billing.view.universal.customerGroups.view.WrapperModel'
    ],
    
    mixins: [
        'Melisa.core.Module'
    ],
    
    iconCls: 'x-fa fa-object-group',
    cls: 'billing-customerGroups-view',
    layout: 'border',
    controller: 'billingCustomerGroupsView',
    viewModel: {
        type: 'billingCustomerGroupsView'
    },
    items: [
        {
            xtype: 'billingCustomerGroupsViewGrid',
            region: 'center',
            reference: 'griCustomerGroups',
            listeners: {
                itemdblclick: 'onShowItemReport',
                selectionchange: 'onSelectionChangeCustomers'
            },
            plugins: [
                {
                    ptype: 'autofilters',
                    filters: {
                        name: {
                            operator: 'like'
                        },
                        rfc: {
                            operator: 'like'
                        },
                        email: {
                            operator: 'like'
                        }
                    }
                },
                {
                    ptype: 'floatingbutton',
                    configButton: {
                        handler: 'moduleRun',
                        iconCls: 'x-fa fa-users',
                        scale: 'large',
                        tooltip: 'Agregar grupo de clientes',
                        bind: {
                            melisa: '{modules.add}',
                            hidden: '{!modules.add.allowed}'
                        }
                    }
                }
            ]
        },
        {
            xtype: 'tabpanel',
            region: 'east',
            width: '80%',
            itemId: 'panDetails',
            split: true,
            listeners: {
                afterrender: 'onAfterRenderDetails'
            },
            items: [
                {
                    iconCls: 'x-fa fa-users',
                    xtype: 'billingCustomerGroupsViewCustomers',
                    title: 'Clientes en el grupo'
                },
                {
                    iconCls: 'x-fa fa-male',
                    xtype: 'billingCustomerGroupsViewIdentities',
                    title: 'Perfiles en el grupo'
                }
            ]
        }
    ]
});

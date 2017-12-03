Ext.define('Melisa.billing.view.desktop.accountingAccounts.view.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.panel.View',
    
    requires: [
        'Melisa.view.desktop.wrapper.panel.View',
        'Melisa.billing.view.desktop.accountingAccounts.view.Grid',
        'Melisa.billing.view.desktop.accountingAccounts.view.WrapperController',
        'Melisa.billing.view.universal.accountingAccounts.view.WrapperModel'
    ],
    
    iconCls: 'x-fa fa-copyright',
    cls: 'billing-accountingAccounts-view',
    controller: 'billingAccountingAccountsView',
    viewModel: {
        type: 'billingAccountingAccountsView'
    },
    items: [
        {
            xtype: 'billingAccountingAccountsViewGrid',
            region: 'center',
            listeners: {
                itemdblclick: 'onShowItemReport'
            },
            plugins: [
                {
                    ptype: 'autofilters',
                    filters: {
                        key: {
                            operator: 'like',
                            minChars: 1
                        },
                        shortname: {
                            operator: 'like'
                        },
                        name: {
                            operator: 'like'
                        }
                    }
                },
                {
                    ptype: 'floatingbutton',
                    configButton: {
                        handler: 'moduleRun',
                        iconCls: 'x-fa fa-plus',
                        scale: 'large',
                        tooltip: 'Agregar cuenta contable',
                        bind: {
                            melisa: '{modules.add}',
                            hidden: '{!modules.add.allowed}'
                        }
                    }
                }
            ]
        }
    ]
});

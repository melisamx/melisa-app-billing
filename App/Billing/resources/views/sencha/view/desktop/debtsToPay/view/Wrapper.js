Ext.define('Melisa.billing.view.desktop.debtsToPay.view.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.panel.View',
    
    requires: [
        'Melisa.view.desktop.wrapper.panel.View',
        'Melisa.billing.view.desktop.debtsToPay.view.Grid',
        'Melisa.billing.view.desktop.debtsToPay.view.WrapperController',
        'Melisa.billing.view.universal.debtsToPay.view.WrapperModel'
    ],
    
    iconCls: 'x-fa fa-hand-paper-o',
    cls: 'billing-debtsToPay-view',
    controller: 'billingDebtsToPayView',
    viewModel: {
        type: 'billingDebtsToPayView'
    },
    items: [
        {
            xtype: 'billingDebtsToPayViewGrid',
            region: 'center',
            listeners: {
                itemdblclick: 'onShowItemReport'
            },
            plugins: [
                {
                    ptype: 'autofilters',
                    filters: {
                        account: {
                            operator: 'like',
                            minChars: 1
                        }
                    }
                },
                {
                    ptype: 'floatingbutton',
                    configButton: {
                        handler: 'moduleRun',
                        iconCls: 'x-fa fa-plus',
                        scale: 'large',
                        tooltip: 'Agregar cuenta por pagar',
                        bind: {
                            melisa: '{modules.add}',
                            hidden: '{!modules.add.allowed}'
                        }
                    }
                }
            ]
        }
    ],
    tbar: [
        '->',
        {
            xtype: 'label',
            text: 'Total vencido:'
        },
        {
            xtype: 'label',
            style: 'font-weight: bold; color: #E53935',
            bind: {
                text: '{totalExpired:usMoney}'
            }
        },
        {
            xtype: 'label',
            text: 'Total por pagar:'
        },
        {
            xtype: 'label',
            style: 'font-weight: bold;',
            bind: {
                text: '{total:usMoney}'
            }
        }
    ]
});

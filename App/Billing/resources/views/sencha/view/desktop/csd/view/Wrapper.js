Ext.define('Melisa.billing.view.desktop.csd.view.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.panel.View',
    
    requires: [
        'Melisa.view.desktop.wrapper.panel.View',
        'Melisa.billing.view.desktop.csd.view.Grid',
        'Melisa.billing.view.desktop.csd.view.WrapperController',
        'Melisa.billing.view.universal.csd.view.WrapperModel'
    ],
    
    iconCls: 'x-fa fa-key',
    cls: 'billing-csd-view',
    controller: 'billingCsdView',
    viewModel: {
        type: 'billingCsdView'
    },
    items: [
        {
            xtype: 'billingCsdViewGrid',
            region: 'center',
            listeners: {
                itemdblclick: 'onShowItemReport'
            },
            plugins: [
                {
                    ptype: 'autofilters',
                    filters: {
                        number: {
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
                        tooltip: 'Agregar certificado de sello digital',
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

Ext.define('Melisa.billing.view.desktop.exchangeRates.view.Grid', {
    extend: 'Ext.grid.Panel',    
    alias: 'widget.billingExchangeRatesViewGrid',
    
    emptyText: 'No hay tipos de cambio registrados',
    deferEmptyText: true,
    bind: {
        store: '{exchangeRates}'
    },
    columns: [
        {
            dataIndex: 'id',
            text: 'Id',
            hidden: true
        },
        {
            dataIndex: 'coin',
            text: 'Moneda',
            width: 220,
            renderer: function(v, a, record) {
                return '(<b>' + record.data.shortName + '</b>) ' + v;
            }
        },
        {
            dataIndex: 'date',
            text: 'Fecha',
            align: 'center',
            width: 150
        },
        {
            xtype: 'numbercolumn',
            dataIndex: 'rate',
            text: 'Valor',
            align: 'center',
            format:'$ 0,000.0000',
            width: 180
        },
        {
            xtype: 'datecolumn',
            dataIndex: 'createdAt',
            text: 'Fecha creación',
            flex: 1,
            hidden: true,
            format:'d/m/Y h:i:s a'
        },
        {
            xtype: 'datecolumn',
            dataIndex: 'updatedAt',
            text: 'Fecha modificación',
            flex: 1,
            format:'d/m/Y h:i:s a',
            hidden: true,
            bind: {
                hidden: '{hiddenColumns}'
            }
        },
        {
            xtype: 'widgetcolumn',
            width: 30,
            widget: {
                xtype: 'button',
                iconCls: 'x-fa fa-pencil',
                tooltip: 'Modificar tipo de cambio',
                bind: {
                    melisa: '{modules.update}',
                    hidden: '{!modules.update.allowed}'
                },
                listeners: {
                    click: 'moduleRun',
                    loaded: 'onLoadedModuleUpdate'
                }
            }
        },
        {
            xtype: 'widgetcolumn',
            width: 30,
            widget: {
                xtype: 'button',
                iconCls: 'x-fa fa-trash',
                tooltip: 'Eliminar tipo de cambio',
                bind: {
                    melisa: '{modules.delete}',
                    hidden: '{!modules.delete.allowed}'
                },
                plugins: {
                    ptype: 'buttonconfirmation',
                    messageSuccess: 'Tipo de cambio eliminado'
                }
            }
        }
    ],
    selModel: {
        selType: 'checkboxmodel'
    },
    bbar: {
        xtype: 'pagingtoolbar',
        displayInfo: true
    },
    features: [
        {
            ftype:'grouping'
        }
    ]
});

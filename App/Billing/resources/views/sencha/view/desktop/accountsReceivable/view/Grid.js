Ext.define('Melisa.billing.view.desktop.accountsReceivable.view.Grid', {
    extend: 'Ext.grid.Panel',    
    alias: 'widget.billingAccountsReceivableToPayViewGrid',
    
    emptyText: 'No hay cuentas por cobrar registradas',
    deferEmptyText: true,
    bind: {
        store: '{accountsReceivable}'
    },
    columns: [
        {
            dataIndex: 'id',
            text: 'Id',
            hidden: true
        },
        {
            dataIndex: 'account',
            text: 'Cuenta',
            flex: 1
        },
        {
            dataIndex: 'dateVoucher',
            text: 'Diás para vencer',
            align: 'center',
            width: 170,
            renderer: function(value, a, record) {
                var date1 = new Date(value),
                    date2 = new Date(record.get('dueDate')),
                    timeDiff = Math.abs(date2.getTime() - date1.getTime()),
                    diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                return diffDays;
            }
        },
        {
            xtype: 'datecolumn',
            dataIndex: 'dueDate',
            text: 'Fecha de vencimiento',
            format: 'd/m/Y',
            align: 'center',
            width: 170
        },
        {
            dataIndex: 'amountCharged',
            text: 'Monto a cobrar',
            formatter: 'usMoney',
            align: 'center',
            width: 130
        },
        {
            dataIndex: 'balance',
            text: 'Saldo',
            formatter: 'usMoney',
            align: 'center',
            width: 130
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
                iconCls: 'x-fa fa-ban',
                tooltip: 'Saldar cuenta',
                bind: {
                    melisa: '{modules.payoff}',
                    hidden: '{!modules.payoff.allowed}'
                },
                plugins: {
                    ptype: 'buttonconfirmation',
                    messageConfirmation: '¿Realmente desea saldar la cuenta?',
                    messageSuccess: 'Cuenta saldada'
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
    }
});

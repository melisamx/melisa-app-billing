Ext.define('Melisa.billing.view.desktop.customersBanksAccounts.Grid', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.billingCustomersBanksAccountsGrid',
    
    requires: [
        'Melisa.ux.grid.Filters',
        'Melisa.ux.confirmation.Button'
    ],
    
    emptyText: 'No hay cuentas bancarías asociadas',
    deferEmptyText: true,
    bind: {
        store: '{customersBanksAccounts}'
    },
    columns: [
        {
            dataIndex: 'id',
            text: 'Id',
            hidden: true
        },
        {
            dataIndex: 'bank',
            text: 'Banco',
            flex: 1
        },
        {
            dataIndex: 'account',
            text: 'Cuenta',
            flex: 1
        },
        {
            dataIndex: 'coin',
            text: 'Moneda',
            flex: 1
        },
        {
            xtype: 'booleancolumn',
            text: 'Activo',
            dataIndex: 'active',
            trueText: 'Si',
            falseText: 'No',
            align: 'center',
            width: 180
        },
        {
            dataIndex: 'createdAt',
            text: 'Fecha creación',
            flex: 1
        },
        {
            dataIndex: 'updatedAt',
            text: 'Fecha modificación',
            flex: 1,
            hidden: true
        },
        {
            xtype: 'widgetcolumn',
            width: 30,
            widget: {
                xtype: 'button',
                iconCls: 'x-fa fa-trash',
                tooltip: 'Eliminar cuenta bancaría',
                bind: {
                    melisa: '{record.active ? modules.customersBanksAccountsDeactivate : modules.customersBanksAccountsActivate}',
                    hidden: '{record.active ? !modules.customersBanksAccountsDeactivate.allowed : !modules.customersBanksAccountsActivate.allowed}',
                    iconCls: '{record.active ? "x-fa fa-thumbs-down" : "x-fa fa-thumbs-up" }',
                    tooltip: '{record.active ? "Desactivar" : "Activar"}'
                },
                plugins: {
                    ptype: 'buttonconfirmation',
                    getMessageConfirmation: function() {
                        var me = this,
                            button = me.getCmp(),
                            record = button.getViewModel().get('record'),
                            message = '¿Realmente desea ';
                        
                        return message + (
                            record.get('active') ? 'desactivar' : 'activar'
                        ) + ' la cuenta bancaría?';
                    },
                    getMessageSuccess: function() {
                        var me = this,
                            button = me.getCmp(),
                            record = button.getViewModel().get('record');
                    
                        return 'Cuenta bancaría ' + 
                            (record.get('active') ? 'desactivada' : 'activada');
                    }
                }
            }
        },
        {
            xtype: 'widgetcolumn',
            width: 30,
            widget: {
                xtype: 'button',
                iconCls: 'x-fa fa-trash',
                tooltip: 'Eliminar cuenta bancaría',
                bind: {
                    melisa: '{modules.customersBanksAccountsDelete}',
                    hidden: '{!modules.customersBanksAccountsDelete.allowed}'
                },
                plugins: {
                    ptype: 'buttonconfirmation',
                    messageSuccess: 'Cuenta bancaría eliminada'
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
    plugins: [
        {
            ptype: 'autofilters',
            filters: {
                bank: {
                    operator: 'like'
                },
                coin: {
                    operator: 'like'
                }
            },
            filtersIgnore: [
                'id',
                'cratedAt',
                'updatedAt'
            ]
        }
    ],
    features: [
        {
            ftype:'grouping'
        }
    ]
    
});

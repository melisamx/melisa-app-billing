Ext.define('Melisa.billing.view.desktop.customerGroups.view.Customers', {
    extend: 'Ext.grid.Panel',    
    alias: 'widget.billingCustomerGroupsViewCustomers',
    
    emptyText: 'No hay clientes en este grupo',
    deferEmptyText: true,
    bind: {
        store: '{customers}'
    },
    columns: [
        {
            dataIndex: 'id',
            text: 'Id',
            hidden: true
        },
        {
            dataIndex: 'name',
            text: 'Nombre',
            flex: 1
        },
        {
            dataIndex: 'rfc',
            text: 'RFC',
            width: 150,
            bind: {
                hidden: '{hiddenColumns}'
            }
        },
        {
            dataIndex: 'paymentMethod',
            text: 'Método de pago',
            width: 160,
            bind: {
                hidden: '{hiddenColumns}'
            }
        },
        {
            xtype: 'booleancolumn',
            dataIndex: 'active',
            text: 'Activo',
            aling: 'center',
            width: 90,
            bind: {
                hidden: '{hiddenColumns}'
            }
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
                iconCls: 'x-fa fa-trash',
                tooltip: 'Eliminar cliente del grupo',
                bind: {
                    melisa: '{modules.customersDelete}',
                    hidden: '{!modules.customersDelete.allowed}'
                },
                plugins: {
                    ptype: 'buttonconfirmation',
                    messageSuccess: 'Cliente eliminado del grupo'
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
            ptype: 'floatingbutton',
            configButton: {
                iconCls: 'x-fa fa-plus',
                scale: 'large',
                tooltip: 'Agregar cliente al grupo',
                bind: {
                    melisa: '{modules.customersAdd}',
                    hidden: '{!modules.customersAdd.allowed}'
                },
                listeners: {
                    click: 'moduleRun',
                    loaded: 'onLoadedModuleAsociate'
                }
            }
        }
    ]
});

Ext.define('Melisa.billing.view.desktop.customerGroups.view.Grid', {
    extend: 'Ext.grid.Panel',    
    alias: 'widget.billingCustomerGroupsViewGrid',
    
    emptyText: 'No hay grupos de clientes',
    deferEmptyText: true,
    bind: {
        store: '{customerGroups}'
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
                iconCls: 'x-fa fa-pencil',
                tooltip: 'Modificar grupo de clientes',
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
                tooltip: 'Eliminar grupo de clientes',
                bind: {
                    melisa: '{modules.delete}',
                    hidden: '{!modules.delete.allowed}'
                },
                plugins: {
                    ptype: 'buttonconfirmation',
                    messageSuccess: 'Grupo de clientes eliminado'
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

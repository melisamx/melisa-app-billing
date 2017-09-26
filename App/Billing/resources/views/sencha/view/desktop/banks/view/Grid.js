Ext.define('Melisa.billing.view.desktop.banks.view.Grid', {
    extend: 'Ext.grid.Panel',    
    alias: 'widget.billingBanksViewGrid',
    
    emptyText: 'No hay repositorios registrados',
    deferEmptyText: true,
    bind: {
        store: '{banks}'
    },
    columns: [
        {
            dataIndex: 'id',
            text: 'Id',
            hidden: true
        },
        {
            dataIndex: 'key',
            text: 'Clave',
            width: 80
        },
        {
            dataIndex: 'shortname',
            text: 'Nombre Corto',
            flex: 1
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
            width: 100
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
                tooltip: 'Modificar banco',
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
                tooltip: 'Eliminar banco',
                bind: {
                    melisa: '{modules.delete}',
                    hidden: '{!modules.delete.allowed}'
                },
                plugins: {
                    ptype: 'buttonconfirmation',
                    messageSuccess: 'Banco eliminado'
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

Ext.define('Melisa.billing.view.desktop.customerGroups.view.Identities', {
    extend: 'Ext.grid.Panel',    
    alias: 'widget.billingCustomerGroupsViewIdentities',
    
    emptyText: 'No hay perfiles en este grupo',
    deferEmptyText: true,
    bind: {
        store: '{identities}'
    },
    columns: [
        {
            dataIndex: 'id',
            text: 'Id',
            hidden: true
        },
        {
            dataIndex: 'displayEspecific',
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
                iconCls: 'x-fa fa-trash',
                tooltip: 'Eliminar perfil del grupo',
                bind: {
                    melisa: '{modules.identitiesDelete}',
                    hidden: '{!modules.identitiesDelete.allowed}'
                },
                plugins: {
                    ptype: 'buttonconfirmation',
                    messageSuccess: 'Perfil eliminado del grupo'
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
                iconCls: 'x-fa fa-user',
                scale: 'large',
                tooltip: 'Agregar perfil al grupo',
                bind: {
                    melisa: '{modules.identitiesAdd}',
                    hidden: '{!modules.identitiesAdd.allowed}'
                },
                listeners: {
                    click: 'moduleRun',
                    loaded: 'onLoadedModuleAsociate'
                }
            }
        }
    ]
});

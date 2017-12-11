Ext.define('Melisa.billing.view.desktop.customers.view.Grid', {
    extend: 'Ext.grid.Panel',    
    alias: 'widget.billingCustomerViewGrid',
    
    emptyText: 'No hay clientes registrados',
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
            dataIndex: 'repository',
            text: 'Cliente base',
            flex: 1,
            bind: {
                hidden: '{hiddenColumns}'
            }
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
            dataIndex: 'email',
            text: 'Correo electrónico',
            width: 180,
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
                iconCls: 'x-fa fa-pencil',
                tooltip: 'Modificar cliente',
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
                bind: {
                    melisa: '{record.active ? modules.deactivate : modules.activate}',
                    hidden: '{record.active ? !modules.deactivate.allowed : !modules.activate.allowed}',
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
                        ) + ' el cliente?';
                    },
                    getMessageSuccess: function() {
                        var me = this,
                            button = me.getCmp(),
                            record = button.getViewModel().get('record');
                    
                        return 'Cliente ' + 
                            (record.get('active') ? 'desactivado' : 'activado');
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
                tooltip: 'Eliminar cliente',
                bind: {
                    melisa: '{modules.delete}',
                    hidden: '{!modules.delete.allowed}'
                },
                plugins: {
                    ptype: 'buttonconfirmation',
                    messageSuccess: 'Cliente eliminado',
                    restFull: true
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

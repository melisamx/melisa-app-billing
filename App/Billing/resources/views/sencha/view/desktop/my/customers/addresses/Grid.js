Ext.define('Melisa.billing.view.desktop.my.customers.addresses.Grid', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.billingMyCustomersAddressesGrid',
    
    requires: [
        'Melisa.ux.grid.Filters',
        'Melisa.ux.confirmation.Button'
    ],
    
    emptyText: 'No hay direcciones asociadas al cliente',
    deferEmptyText: true,
    bind: {
        store: '{customersAddresses}'
    },
    columns: [
        {
            dataIndex: 'id',
            text: 'Id',
            hidden: true
        },
        {
            dataIndex: 'country',
            text: 'Páis',
            flex: 1,
            renderer: function(value) {
                console.log(value);
                return value.name;
            }
        },
        {
            dataIndex: 'state',
            text: 'Estado',
            flex: 1,
            renderer: function(value) {
                return value.name;
            }
        },
        {
            dataIndex: 'municipality',
            text: 'Municipio',
            flex: 1,
            renderer: function(value) {
                return value.name;
            }
        },
        {
            xtype: 'booleancolumn',
            text: 'Es default',
            dataIndex: 'isDefault',
            trueText: 'Si',
            falseText: 'No',
            align: 'center',
            width: 180
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
                iconCls: 'x-fa fa-pencil',
                tooltip: 'Modificar cliente',
                bind: {
                    melisa: '{modules.addressesUpdate}',
                    hidden: '{!modules.addressesUpdate.allowed}'
                },
                listeners: {
                    click: 'moduleRun',
                    loaded: 'onLoadedModuleAsociateUpdate'
                }
            }
        },
        {
            xtype: 'widgetcolumn',
            width: 30,
            widget: {
                xtype: 'button',
                iconCls: 'x-fa fa-trash',
                tooltip: 'Eliminar dirección',
                bind: {
                    melisa: '{modules.addressesDelete}',
                    hidden: '{!modules.addressesDelete.allowed}'
                },
                plugins: {
                    ptype: 'buttonconfirmation',
                    messageSuccess: 'Dirección eliminada'
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

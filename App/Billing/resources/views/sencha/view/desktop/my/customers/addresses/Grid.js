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
            dataIndex: 'address',
            text: 'Dirección',
            flex: 1,
            renderer: function(value, meta, record) {
                meta.style = 'line-height: 12px;';
                return [
                    '<h1 style="font-size: 12px">',
                        value,
                        ', ',
                        record.get('exteriorNumber'),
                        ' - ',
                        record.get('interiorNumber'),
                        ', ',
                        record.get('colony'),
                    '</h1>',
                    '<p style="margin: 0">',
                        record.get('postalCode'),
                    '</p>'
                ].join('');
            }
        },
        {
            dataIndex: 'country',
            text: 'Páis',
            flex: 1,
            renderer: function(value) {
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
            flex: 1,
            hidden: true
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

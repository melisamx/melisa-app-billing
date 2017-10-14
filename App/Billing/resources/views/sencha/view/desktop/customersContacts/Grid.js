Ext.define('Melisa.billing.view.desktop.customersContacts.Grid', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.billingCustomersContactsGrid',
    
    requires: [
        'Melisa.ux.grid.Filters',
        'Melisa.ux.confirmation.Button'
    ],
    
    emptyText: 'No hay contactos asociados',
    deferEmptyText: true,
    reference: 'grid',
    bind: {
        store: '{customersContacts}'
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
            dataIndex: 'lastName',
            text: 'Apellidos',
            flex: 1
        },
        {
            dataIndex: 'email',
            text: 'Correo electronico',
            flex: 1
        },
        {
            dataIndex: 'phoneNumber',
            text: 'Numero telefonico',
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
                tooltip: 'Eliminar contacto asociado',
                bind: {
                    melisa: '{modules.contactsDelete}',
                    hidden: '{!modules.contactsDelete.allowed}'
                },
                plugins: {
                    ptype: 'buttonconfirmation',
                    messageSuccess: 'Contacto asociado eliminado'
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
                nombre: {
                    operator: 'like'
                }
            },
            filtersIgnore: [
                'id',
                'cratedAt',
                'updatedAt'
            ]
        }
    ]
    
});

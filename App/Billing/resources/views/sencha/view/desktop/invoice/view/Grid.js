Ext.define('Melisa.billing.view.desktop.invoice.view.Grid', {
    extend: 'Ext.grid.Panel',    
    alias: 'widget.billingInvoiceViewGrid',
    
    requires: [
        'Melisa.view.desktop.ButtonRecord'
    ],
    
    emptyText: 'No hay facturas registradas',
    deferEmptyText: true,
    bind: {
        store: '{invoice}'
    },
    columns: [
        {
            dataIndex: 'id',
            text: 'Id',
            hidden: true
        },
        {
            dataIndex: 'status',
            text: 'Estatus',
            width: 180,
            renderer: function(value) {
                return value.name;
            }
        },
        {
            dataIndex: 'customer',
            text: 'RFC',
            flex: 1,
            renderer: function(value) {
                return [
                    '<p style="line-height: 15px"><b>',
                    value.contributor.rfc,
                    '</b><br>',
                    value.contributor.name,
                    '</p>'
                ].join('');
            }
        },
        {
            dataIndex: 'total',
            text: 'Total',
            align: 'center',
            width: 120,
            renderer: Ext.util.Format.usMoney
        },
        {
            dataIndex: 'uuid',
            text: 'UUID',
            width: 280
        },
        {
            dataIndex: 'folio',
            text: 'Folio',
            width: 80,
            renderer: function(value, a, record) {
                return [
                    record.data.serie.serie,
                    ' - ',
                    value
                ].join('');
            }
        },
        {
            xtype: 'booleancolumn',
            dataIndex: 'active',
            text: 'Activa',
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
                iconCls: 'x-fa fa-file-code-o',
                tooltip: 'Descargar factura XML',
                handler: 'onClickBtnDownloadInvoiceXml',
                bind: {
                    disabled: '{record.uuid ? false : true}'
                }
            }
        },
        {
            xtype: 'widgetcolumn',
            width: 30,
            widget: {
                xtype: 'button',
                iconCls: 'x-fa fa-trash',
                tooltip: 'Eliminar factura',
                bind: {                    
                    melisa: '{modules.delete}',
                    disabled: '{record.uuid ? true : false}'
                },
                plugins: {
                    ptype: 'buttonconfirmation',
                    messageConfirmation: '¿Realmente desea eliminar la factura?',
                    messageSuccess: 'Factura eliminada',
                    restFull: true
                }
            }
        },
        {
            xtype: 'widgetcolumn',
            width: 30,
            widget: {
                xtype: 'button',
                iconCls: 'x-fa fa-file-pdf-o',
                tooltip: 'Descargar factura PDF',
                handler: 'onClickBtnDownloadInvoicePdf',
                bind: {
                    disabled: '{record.uuid ? false : true}'
                }
            }
        },
        {
            xtype: 'widgetcolumn',
            width: 30,
            widget: {
                xtype: 'button',
                iconCls: 'x-fa fa-ban',
                tooltip: 'Cancelar factura',
                bind: {
                    melisa: '{modules.cancel}',
                    disabled: '{record.uuid ? false : true}'
                },
                plugins: {
                    ptype: 'buttonconfirmation',
                    messageConfirmation: '¿Realmente desea cancelar la factura?',
                    messageSuccess: 'Factura cancelada'
                }
            }
        },
        {
            xtype: 'widgetcolumn',
            width: 30,
            widget: {
                xtype: 'button',
                iconCls: 'x-fa fa-money',
                tooltip: 'Generar CFDI',
                bind: {
                    melisa: '{modules.cfdi}',
                    hidden: '{!modules.cfdi.allowed}',
                    disabled: '{record.uuid}'
                },
                plugins: {
                    ptype: 'buttonconfirmation',
                    messageConfirmation: '¿Realmente desea generar CFDI?',
                    messageSuccess: 'CFDI generado'
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
    
    actions: {
        accountReceivable: {
            xtype: 'buttonRecord',
            text: 'Generar cuenta por cobrar',
            disabled: true,
            bind: {
                disabled: '{!griInvoice.selection || !griInvoice.selection.uuid}',
                melisa: '{modules.accountReceivable}',
                record: '{griInvoice.selection}'
            },
            plugins: {
                ptype: 'buttonconfirmation',
                messageConfirmation: '¿Realmente desea generar a cuenta por cobrar?',
                messageSuccess: 'Cuenta por cobrar generada',
                fieldId: 'idInvoice',
                fieldIdRecord: 'id'
            }
        }
    },
    tbar: {
        xtype: 'toolbar',
        defaultActionType: 'buttonRecord',
        items: [
            '@accountReceivable'
        ]
    }
});

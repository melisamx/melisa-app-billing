Ext.define('Melisa.billing.view.desktop.invoice.view.Grid', {
    extend: 'Ext.grid.Panel',    
    alias: 'widget.billingInvoiceViewGrid',
    
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
            width: 130,
            renderer: function(value) {
                return value.name;
            }
        },
        {
            dataIndex: 'customer',
            text: 'RFC',
            width: 130,
            renderer: function(value) {
                return value.contributor.rfc;
            }
        },
        {
            dataIndex: 'customer',
            text: 'Razón social',
            flex: 1,
            renderer: function(value) {
                return value.contributor.name;
            }
        },
        {
            dataIndex: 'uuid',
            text: 'UUID',
            width: 280
        },
        {
            dataIndex: 'folio',
            text: 'Folio',
            width: 80
        },
        {
            dataIndex: 'serie',
            text: 'Serie',
            width: 80,
            renderer: function(value) {
                return value.serie;
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
                    disabled: '{record.idFileXml ? false : true}'
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
                    disabled: '{record.idFilePdf ? false : true}'
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
                    hidden: '{!modules.cancel.allowed}'
                },
                plugins: {
                    ptype: 'buttonconfirmation',
                    messageConfirmation: '¿Realmente desea cancelar la factura?',
                    messageSuccess: 'Factura cancelada'
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

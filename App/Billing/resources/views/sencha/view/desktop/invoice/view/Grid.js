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
            dataIndex: 'folio',
            text: 'Folio',
            width: 80
        },
        {
            dataIndex: 'date',
            text: 'Fecha',
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
                iconCls: 'x-fa fa-file-pdf-o',
                tooltip: 'Descargar PDF',
                handler: 'onClickBtnDownloadPDF',
                bind: {
                    melisa: '{modules.pdf}',
                    hidden: '{!modules.pdf.allowed}'
                }
            }
        },
        {
            xtype: 'widgetcolumn',
            width: 30,
            widget: {
                xtype: 'button',
                iconCls: 'x-fa fa-file-text-o',
                tooltip: 'Descargar XML',
                handler: 'onClickBtnDownloadXML',
                bind: {
                    melisa: '{modules.xml}',
                    hidden: '{!modules.xml.allowed}'
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

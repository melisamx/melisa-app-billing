Ext.define('Melisa.billing.view.desktop.reports.billsPaid.view.Grid', {
    extend: 'Ext.grid.Panel',    
    alias: 'widget.billingReportsBillsPaidGrid',
    
    emptyText: 'No hay facturas registradas',
    deferEmptyText: true,
    bind: {
        store: '{billsPaid}'
    },
    columns: [
        {
            dataIndex: 'name',
            text: 'Razon social',
            flex: 1
        },
        {
            dataIndex: 'rfc',
            text: 'RFC',
            align: 'center',
            width: 180
        },
        {
            dataIndex: 'totalInvoices',
            text: 'Número de facturas',
            align: 'center',
            width: 180
        },
        {
            dataIndex: 'amount',
            text: 'Total',
            align: 'center',
            width: 120,
            renderer: Ext.util.Format.usMoney
        }
    ],
    bbar: {
        xtype: 'pagingtoolbar',
        displayInfo: true
    }
});

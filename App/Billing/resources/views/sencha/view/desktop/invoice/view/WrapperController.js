Ext.define('Melisa.billing.view.desktop.invoice.view.WrapperController', {
    extend: 'Melisa.controller.View',
    alias: 'controller.billingInvoiceView',
    
    requires: [
        'Melisa.controller.View'
    ],
    
    listen: {
        global: {
            'event.billing.invoice.cancel.success': 'onUpdatedRecord'
        }
    },
    
    storeReload: 'billing',
    windowReportConfig: {
        title: 'Factura'
    },
    
    onClickBtnDownloadInvoicePdf: function(button) {
        this.downloadFile(button, 'pdf');
    },
    
    onClickBtnDownloadInvoiceXml: function(button) {
        this.downloadFile(button, 'xml');
    },
    
    downloadFile: function(button, format) {
        var me = this,
            filesView = me.getViewModel().get('modules.filesView.' + format),
            record = button.getViewModel().get('record'),
            url = [
                new Ext.Template(filesView).apply({
                    id: record.get('id')
                }),
                '?nc=',
                new Date().toTimeString()
            ].join('');
        window.open(url, '__blank');
    }
    
});

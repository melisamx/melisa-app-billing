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
            filesView = me.getViewModel().get('modules.filesView'),
            record = button.getViewModel().get('record'),
            url = [
                filesView,
                record.get('id'),
                '/',
                format,
                '?nc=',
                new Date().toTimeString()
            ].join('');console.log(url);return;
        window.open(url, '__blank');
    }
    
});

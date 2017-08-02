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
    
    donwloadFile: function(blob, fileName) {
        var downloadLink = document.createElement('a'),
            URL = window.URL || window.webkitURL,
            downloadUrl = URL.createObjectURL(blob);
    
        downloadLink.target   = '_blank';
        downloadLink.download = fileName;
        // set object URL as the anchor's href
        downloadLink.href = downloadUrl;

        // append the anchor to document body
        document.body.appendChild(downloadLink);

        // fire a click event on the anchor
        downloadLink.click();

        // cleanup: remove element and revoke object URL
        document.body.removeChild(downloadLink);
        URL.revokeObjectURL(downloadUrl);
    },
    
    onClickBtnDownloadXML: function(button) {
        var me = this,
            record = button.getViewModel().get('record'),
            data = record.get('xml'),
            blob = new Blob([ data ], {
                type: 'application/xml'
            });
    
        me.donwloadFile(blob, record.get('uuid') + '.xml');
    },
    
    onClickBtnDownloadPDF: function(button) {
        var me = this,
            record = button.getViewModel().get('record'),
            data = record.get('pdf'),
            blob = new Blob([ Ext.util.Base64.decode(data) ]);
    
        me.donwloadFile(blob, record.get('uuid') + '.pdf');
    }
    
});

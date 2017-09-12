Ext.define('Melisa.billing.view.desktop.referralNotes.view.WrapperController', {
    extend: 'Melisa.controller.View',
    alias: 'controller.billingReferralNotesView',
    
    requires: [
        'Melisa.controller.View'
    ],
    
    listen: {
        global: {
            'event.billing.referralNotes.cancel.success': 'onUpdatedRecord'
        }
    },
    
    storeReload: 'billing',
    windowReportConfig: {
        title: 'Factura'
    },
    
    onClickBtnDownloadInvoicePdf: function(button) {
        this.downloadFile(button, 'idFilePdf');
    },
    
    onClickBtnDownloadInvoiceXml: function(button) {
        this.downloadFile(button, 'idFileXml');
    },
    
    downloadFile: function(button, field) {
        var me = this,
            filesView = me.getViewModel().get('modules.filesView'),
            record = button.getViewModel().get('record');
        window.open([
            filesView,
            record.get(field),
            '/?nc=',
            new Date().toTimeString()
        ].join(''), '__blank');
    }
    
});

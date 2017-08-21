Ext.define('Melisa.billing.view.desktop.debtsToPay.add.WrapperController', {
    extend: 'Melisa.controller.Create',
    alias: 'controller.billingDebtsToPayAdd',
    
    eventSuccess: 'event.billing.debtsToPay.create.success',
    
    listeners: {
        selectedfile: 'onSelectedFile'
    },
    
    control: {
        '#cmbAccounts': {
            select: 'onSelectAccount'
        }
    },
    
    onSelectAccount: function(field, record) {
        var me = this,
            view = me.getView(),
            txtDueDate = view.down('#txtDueDate'),
            dueDate = new Date();
            
        dueDate.setDate(dueDate.getDate() + record.get('expirationDays'));        
        
        txtDueDate.setValue(dueDate);
    },
    
    onSelectedFile: function(sel) {
        var me = this,
            txtFileVoucher = me.getView().down('#txtFileVoucher');
    
        txtFileVoucher.setValue(sel[0].get('id'));
    },
    
    onLoadedModuleSelectFile: function(module, options) {        
        module.fireEvent('loaddata', this, 'selectedfile', {}, options.launcher);        
    }
    
});

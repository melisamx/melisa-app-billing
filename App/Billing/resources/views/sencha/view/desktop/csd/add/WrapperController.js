Ext.define('Melisa.billing.view.desktop.csd.add.WrapperController', {
    extend: 'Melisa.controller.Create',
    alias: 'controller.billingCsdAdd',
    
    eventSuccess: 'event.billing.csd.create.success',
    
    listeners: {
        selectedfilecer: 'onSelectedFileCer',
        selectedfilekey: 'onSelectedFileKey'
    },
    
    onSelectedFileKey: function(sel) {
        var me = this,
            txtFileKey = me.getView().down('#txtFileKey');
    
        txtFileKey.setValue(sel[0].get('id'));
    },
    
    onSelectedFileCer: function(sel) {
        var me = this,
            txtFileCer = me.getView().down('#txtFileCer');
    
        txtFileCer.setValue(sel[0].get('id'));
    },
    
    onLoadedModuleSelectFileCer: function(module, options) {        
        module.fireEvent('loaddata', this, 'selectedfilecer', {}, options.launcher);        
    },
    
    onLoadedModuleSelectFileKey: function(module, options) {        
        module.fireEvent('loaddata', this, 'selectedfilekey', {}, options.launcher);        
    }
    
});

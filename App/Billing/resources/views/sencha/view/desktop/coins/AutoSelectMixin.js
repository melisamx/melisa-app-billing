Ext.define('Melisa.billing.view.desktop.coins.AutoSelectMixin', {
    
    autoSelectCoin: function(coin) {
        var me = this,
            vm = me.getViewModel(),
            store;
        
        vm.notify();
        
        store = vm.getStore('coins');
        store.load({
            scope: me,
            callback: me.onLoadCoin,
            params: {
                query: coin || 'Peso Mexicano'
            }
        });
    },
    
    onLoadCoin: function(records, op, success) {        
        var me = this,
            view = me.getView();console.log(view);
        if( !success || Ext.isEmpty(records)) {
            return;
        }
        
        view.down('billingCoinsCombo').select(records[0]);
    }
});
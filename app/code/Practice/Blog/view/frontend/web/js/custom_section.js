define([
    'uiComponent',
    'Magento_Customer/js/customer-data'
], function (Component, customerData) {
    'use strict';

    return Component.extend({
        initialize: function () {
            this._super();
            this.compareproducts = customerData.get('compare-products');
            this.custominfo = customerData.get('custom_info');
            this.customsection = customerData.get('custom_section');

        }
    });
});

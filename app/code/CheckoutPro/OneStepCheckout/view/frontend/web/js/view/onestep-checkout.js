define([
    'uiComponent',
    'ko',
    'Magento_Customer/js/model/customer'
], function (Component, ko, customer) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'CheckoutPro_OneStepCheckout/onestep-checkout'
        },

        initialize: function () {
            this._super();
            this.checkoutConfig = this.config.checkoutConfig || {};

            return this;
        },

        customer: customer,

        isCustomerLoggedIn: customer.isLoggedIn,

        cartItemsCount: ko.pureComputed(function () {
            var quoteItems = (this.checkoutConfig && this.checkoutConfig.quoteItemData) || [];

            return quoteItems.length;
        }, this)
    });
});

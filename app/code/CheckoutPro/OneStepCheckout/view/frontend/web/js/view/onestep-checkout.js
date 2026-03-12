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
            var componentConfig = this.config || {};

            this._super();
            this.checkoutConfig = componentConfig.checkoutConfig || window.checkoutConfig || {};
            this.cartItemsCount = ko.pureComputed(function () {
                var quoteItems = this.checkoutConfig.quoteItemData || [];

                return quoteItems.length;
            }, this);

            return this;
        },

        customer: customer,
        isCustomerLoggedIn: customer.isLoggedIn
    });
});

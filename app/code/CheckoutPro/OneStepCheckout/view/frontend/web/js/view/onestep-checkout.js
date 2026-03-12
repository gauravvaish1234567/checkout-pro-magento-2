define([
    'uiComponent',
    'ko',
    'Magento_Checkout/js/model/quote',
    'Magento_Customer/js/model/customer'
], function (Component, ko, quote, customer) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'CheckoutPro_OneStepCheckout/onestep-checkout'
        },

        quote: quote,
        customer: customer,

        isCustomerLoggedIn: customer.isLoggedIn,
        cartItemsCount: ko.pureComputed(function () {
            var items = quote.getItems() || [];
            return items.length;
        })
    });
});

# CheckoutPro One-Step Checkout

Magento 2 module that adds a dedicated one-step checkout page at:

- `/onestepcheckout/index/index`

## Features

- Separate one-step checkout page shell for custom UX.
- Admin config to enable/disable module behavior.
- Optional redirect from Magento default `/checkout` route to one-step checkout.

## Install (manual)

1. Place module in `app/code/CheckoutPro/OneStepCheckout`.
2. Run:
   - `bin/magento module:enable CheckoutPro_OneStepCheckout`
   - `bin/magento setup:upgrade`
   - `bin/magento setup:di:compile`
   - `bin/magento cache:flush`

## Configuration

Stores → Configuration → Sales → **One-Step Checkout Pro**

- **Enable One-Step Checkout Pro**
- **Checkout Route Behavior**

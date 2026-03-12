# CheckoutPro Marketplace for Magento 2.4.x

A multi-vendor marketplace foundation module with vendor onboarding, moderation, commission rules, order visibility controls, payouts, ratings, and REST API endpoints.

## Implemented Features

- Vendor registration + approval workflow
  - Customers can register with vendor intent (`is_vendor`) and custom registration metadata (`business_license`, `tax_number`).
  - Admin can approve/disable vendors through repository methods and ACL-protected area.
- Vendor dashboard
  - Responsive dashboard page (`/marketplace/vendor/dashboard`) for operations and payout history.
- Commission setup
  - Global commission, category-based commission mapping, and vendor-specific commission override.
- Product management hooks
  - Vendor product mapping table includes stock/shipping-related extension fields and product custom fields JSON.
- Order isolation
  - Plugin filters order grids by vendor-linked products to keep vendor data isolated.
- Payout management
  - Payout request API + admin approval workflow with transaction reference/history.
- Review + rating persistence schema
  - Review table supports vendor ratings by buyer accounts.
- Admin controls
  - ACL + system config for global marketplace controls.
- Magento compatibility
  - Uses declarative schema, setup patch, DI/webapi conventions compatible with Magento 2.4.x.

## REST API examples

### Register / update vendor

```bash
curl -X POST "https://example.com/rest/V1/marketplace/vendors" \
  -H "Content-Type: application/json" \
  -d '{
    "vendor": {
      "customer_id": 12,
      "shop_name": "Acme Vendor",
      "status": "pending",
      "custom_fields": "{\"business_license\":\"AB-123\"}"
    }
  }'
```

### Commission calculation

```bash
curl -X POST "https://example.com/rest/V1/marketplace/commission/calculate" \
  -H "Authorization: Bearer <token>" \
  -H "Content-Type: application/json" \
  -d '{"vendorId":4,"productId":99,"rowTotal":249.00}'
```

### Request payout

```bash
curl -X POST "https://example.com/rest/V1/marketplace/payout/request" \
  -H "Authorization: Bearer <token>" \
  -H "Content-Type: application/json" \
  -d '{"vendorId":4,"amount":120.55,"notes":"Weekly payout"}'
```

## XML Example: `etc/webapi.xml`

```xml
<route url="/V1/marketplace/commission/calculate" method="POST">
    <service class="CheckoutPro\Marketplace\Api\CommissionManagementInterface" method="calculate"/>
    <resources><resource ref="self"/></resources>
</route>
```

## PHP Extension Points

- `CommissionManagement::resolveCategoryRate()` for alternative rule engines.
- `RegisterVendorFromCustomer` observer for additional KYC fields.
- `MapVendorProduct` observer for shipping providers or ERP metadata.
- `PayoutManagement` for gateway integrations (Stripe Connect, PayPal Payouts, bank files).

## Layout Example

`view/frontend/layout/marketplace_vendor_dashboard.xml` injects a dedicated block/template/css stack for vendor users.

## Future Enhancements

- Dedicated admin grids for vendors/payouts/disputes.
- Vendor-wise invoice/credit memo split.
- Review moderation + fraud checks.
- Dispute lifecycle states and threaded messaging.
- Async settlement queue and accounting exports.
